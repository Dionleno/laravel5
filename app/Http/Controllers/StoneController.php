<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\Stone\CreditAutorization;
use App\Libs\Stone\CraditCaptureTransation;
use App\Http\Requests;
use App\User;
use App\Order;
use App\Cupon;
use Auth;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Mail\Mailer;
use Mail;

class StoneController extends Controller
{

  public function pgpagamento(){
      return view('pagamento');
  }

   public function authstone(Request $request){
      
          $this->validate($request, [          
                'titularCartao' => 'required',
                'parcelas' => 'required' ,
                'ncartao' => 'required',
                'validade' => 'required',
                'cvv' => 'required',
                'valor_curso'=> 'required',
                'total' => 'required'                                           
            ]);

     $user = Auth::user();
           

      $auth = new CreditAutorization;
      $auth->nmCartao = $request->ncartao;
      $auth->titularCartao = $request->titularCartao;
      $auth->validate = $request->validade;
      $auth->cvv = $request->cvv;
      $auth->valorDaCompra = $this->PriceToNumber($request->total);
      $auth->nmParcela = $request->parcelas;
      $auth->referenceID = $user->id.'_'.date('d_m_Y_H_i_s');

     // Enviar requisição
      $auth->createAuth();    

      //status da transação
      if($auth->getStatus())  $this->saveInfoSales($auth,$request);

     // Devolve resposta
     return \Response::json($auth->getResponse(),$auth->getHttpStatusCode());
   
   }

  private function saveInfoSales(CreditAutorization $auth,Request $request){
       $transation = $auth->getResponse();
       $user = Auth::user();

            $order = $user->order()->create([
                'titularCartao' => $request->titularCartao,
                'parcelas' => $request->parcelas,          
                'valor' => $this->PriceToNumber($request->total),
                'valor_desconto' =>$this->PriceToNumber( $request->estudante )+ $this->PriceToNumber( $request->cupom),
                'cupom'  => $request->cupomcode,
            ]);
              $order->status = $transation->CreditCardTransactionResultCollection[0]->CreditCardTransactionStatus;
              $order->OrderKey = $transation->OrderResult->OrderKey;
              $order->TransactionKey = $transation->CreditCardTransactionResultCollection[0]->TransactionKey;
              $order->bandeira = $transation->CreditCardTransactionResultCollection[0]->CreditCard->CreditCardBrand;
              $order->save();

              if($order->status === "AuthorizedPendingCapture" && $request->cupomcode != ''){
                   $cupom = Cupon::where('cupom',$request->cupom);
                   
                   if($cupom->count() == 0) return;

                   $cupom->quantidade += 1;
                   $cupom->save();
              }
  }


  public function stoneCaptureTransation(){
       $authCapture = new CraditCaptureTransation('219d7581-78e2-4aa9-b708-b7c585780bfc');
       $authCapture->createAuth();
       echo ($authCapture->getResponse()['message']);
  }

  public function stoneListTransations(){

  }

 


 
   static function sendemailPagamentoUsers(User $user){

      Mail::send('email', ['user' => $user], function ($m) use ($user) {
             $m->from('dionleno.vidaletti@270graus.com.br', 'Solutions land');

             $m->to($user->email, $user->name)->subject('o seu pagamento está confirmado!');
          });
   
    
     }

     static function sendemailPagamentoUsersEsgotado(User $user){

      Mail::send('emailEsgotado', ['user' => $user], function ($m) use ($user) {
             $m->from('dionleno.vidaletti@270graus.com.br', 'Solutions land');

              $m->to('victor@solutions.land');
              $m->cc('pc@solutions.land');           
              $m->subject('Contato do site!');
          });
   
    
     }
    public function SaveUserEsgotado(Request $request){
        $this->validate($request, [          
                'name' => 'required',
                'email' => 'required',
                'telefone' => 'required' 
            ]);

         //verificar se o usuario ja esta cadastrado
         $user = User::where('email',$request->email)->get(); 
        
         
         if(count($user) > 0){        
             // $this->sendemailPagamentoUsersEsgotado($user[0]);
     
              return $user[0];
         }

         $user = User::create($request->all());         
        
          $this->sendemailPagamentoUsersEsgotado($user);

         return $user;         
    }
     

private function PriceToNumber($valor){
    $valor = str_replace("." , "" , $valor ); // Primeiro tira os pontos
    $valor = str_replace("," , "" , $valor); // Depois tira a vírgula
    return $valor;
}

     public function SendOrderToStone(Request $request){
           
            /**
            * @param ncartao , validade , cvv , titularCartao ,parcelas,bandeira
            *
            *****/
                 
            $this->validate($request, [          
                'titularCartao' => 'required',
                'parcelas' => 'required'                                             
            ]);

            $user = Auth::user();
            
            $order =  $user->order()->create($request->all());
            
            $transation = json_decode($this->transationStoneCredit($order, $request->ncartao ,$request->validade,$request->cvv,$request->parcelas));
  
            if($transation->success == true && $transation->status == 'Captured'){
              $order->status = $transation->status;
              $order->OrderKey = $transation->OrderKey;
              $order->TransactionKey = $transation->TransactionKey;
              $order->bandeira = $transation->bandeira;
              $order->save();

              
              $MsgReturno = ['status'=>1,'message'=>'Pagamento realizado com sucesso!'];
            //  $this->sendemailPagamentoUsers($user);
              Auth::logout();


            }else{
 
                $MsgReturno = ['status'=>0,'message'=>$transation->message];
               
            }

          

          return response($MsgReturno)->header('Content-Type', 'application/json');    
            

     }

 public function transationStoneCredit(Order $order, $numeroCartao,$validade,$cvv,$parcelas){
        try
         { 
             
                 $valor = 299500;
                 //$valor = 100;
              
           // Define a url utilizada
            \Gateway\ApiClient::setBaseUrl("https://transaction.stone.com.br");

            // Define a chave da loja
            \Gateway\ApiClient::setMerchantKey("33a78296-c701-42b4-b6c7-65cf1412a5c5");//33a78296-c701-42b4-b6c7-65cf1412a5c5

            // Cria objeto requisição
            $createSaleRequest = new \Gateway\One\DataContract\Request\CreateSaleRequest();

            // Cria objeto do cartão de crédito
            $creditCard = \Gateway\One\Helper\CreditCardHelper::createCreditCard($numeroCartao, $order->titularCartao, $validade, $cvv);

            // Define dados do pedido
            $createSaleRequest->addCreditCardTransaction()
                ->setPaymentMethodCode(\Gateway\One\DataContract\Enum\PaymentMethodEnum::AUTO)//AUTO
                ->setCreditCardOperation(\Gateway\One\DataContract\Enum\CreditCardOperationEnum::AUTH_AND_CAPTURE)
                ->setAmountInCents($valor)
                ->setInstallmentCount($parcelas)
                ->setCreditCard($creditCard);
            
          $createSaleRequest->getOrder()
           ->setOrderReference($order->id);    

            // Cria um objeto ApiClient
            $apiClient = new \Gateway\ApiClient();

            // Faz a chamada para criação
            $response = $apiClient->createSale($createSaleRequest);

            // Mapeia resposta
            $httpStatusCode = $response->isSuccess() ? 201 : 401;
          
            $dados = $response->getData();
            $response = array( 
                           'success' => $response->isSuccess(), 
                           'TransactionKey' => $response->getData()->CreditCardTransactionResultCollection[0]->TransactionKey,
                           'OrderKey' => $response->getData()->OrderResult->OrderKey,
                           'status' => $response->getData()->CreditCardTransactionResultCollection[0]->CreditCardTransactionStatus,
                           'bandeira'=>$response->getData()->CreditCardTransactionResultCollection[0]->CreditCard->CreditCardBrand,
                           "message" =>  $response->getData()->CreditCardTransactionResultCollection[0]->AcquirerMessage,
                           'data'=>$response->getData());
            //array("message" => $response->getData()->CreditCardTransactionResultCollection[0]->AcquirerMessage);
        }
        catch (\Gateway\One\DataContract\Report\CreditCardError $error)
        {
            $httpStatusCode = 400;
            $response = array('success' =>false, "message" => $error->getMessage());
        }
        catch (\Gateway\One\DataContract\Report\ApiError $error)
        {
            $httpStatusCode = $error->errorCollection->ErrorItemCollection[0]->ErrorCode;
            $response = array('success' =>false,"message" => $error->errorCollection->ErrorItemCollection[0]->Description);
        }
        catch (\Exception $ex)
        {
            $httpStatusCode = 500;
            $response = array('success' =>false,"message" => "Ocorreu um erro inesperado.");
        }
        finally
        {
            // Devolve resposta
            http_response_code($httpStatusCode);
            header('Content-Type: application/json');
           return json_encode($response);
        }
    }




}
