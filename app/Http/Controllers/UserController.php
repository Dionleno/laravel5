<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\EmailSend;
use App\Jobs\Ebook;
use App\Jobs\teste;
use App\Http\Requests;
use App\Order;
use App\User;
use Carbon\Carbon;
use App\Cupon;
use App\Curso;
use Auth;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Mail\Mailer;
use Mail;

class UserController extends Controller
{
    public function captura(){
       // $user = Auth::user();   
        $user = User::find(1);
         Mail::send('emails.teste',['user' => $user], function ($m) {
             $m->from('contato@algoritmodosucesso.com.br', 'Algoritmo do sucesso!');

             $m->to('dionleno.vidaletti@270graus.com.br', 'dionleno vidaletti')->subject('teste');
          });
        
    }
    public function paypalsucess(){
          $user = Auth::user(); 

            $order = $user->order()->create([
                'titularCartao' => $user->name,
                'parcelas' => 1,          
                'valor' => 99500,
                'valor_desconto' =>0,
                'cupom'  => 0,
            ]);
              $order->status = 'paypalOK';
              $order->OrderKey = '0';
              $order->TransactionKey = '0';
              $order->bandeira = '0';
              $order->save();
 Auth::logout();
             return view('thanks',compact('user'));
    }
    public function register(){
        return view('cadastro');
    }

    public function thankyou(){
         $user = Auth::user();                  
         //Enviar email 
         $this->dispatch(new EmailSend('pagamento_autorizado', $user,'PAGAMENTO AUTORIZADO!'));
         return view('thanks',compact('user'));
    }
    public function SaveUser(Request $request){
   
 
       $validate = [          
                'name' => 'required',
                'email' => 'required',
                'telefone' => 'required',               
                'ndocumento' => 'required'
            ];
  
          //validar formulario
         if($request->studant == 'true'){
             $validate['file'] = 'required|image|mimes:jpeg,png,jpg,gif,svg';
          }

        $this->validate($request, $validate);

            
        //verificar se o usuario ja esta cadastrado
         $user = User::where('email',$request->email)->get(); 
        
         
         if(count($user) > 0){
              Auth::loginUsingId($user[0]->id);
              return \Response::json($user[0],201);  
         }

         $user = User::create($request->all()); 
         $user->carteira = $request->studant == 'true' ? $this->saveUploadCarteirinha($request) : '';
         $user->studant = $request->studant == 'true' ? 1 : '';
         $user->save();
         
         //criar cupom personalizado
         $cupom = explode(' ',$user->name)[0].'00'.$user->id;

         $user->cupon()->create([
             'cupom' => $cupom,
             'quantidade'=> 0,
             'porcentagem'=>10,
             'maximo' => 5,
             'status' => 'aberto'
         ]);
         
         //Enviar email 
         $this->dispatch(new EmailSend('cadastro_efetuado', $user,'Cadastro efetuado com sucesso!'));

         if($request->studant == 'true'){
          $this->dispatch(new EmailSend('analise_estudante', $user,'Documento estudante em análise!'));
         }

         Auth::loginUsingId($user->id);
        
        return \Response::json($user,201);                

     }

     private function saveUploadCarteirinha( Request $request){
           // this creates the response structure for jquery file upload
      
           $file = $request->file('file');
            $destinationPath = 'uploads/temp/'; // upload path
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension;

            $upload_success =  $file->move($destinationPath, $fileName);
                  
            return "/".$destinationPath.$fileName;
                 
              
    }

    public function getInfoPayment(){
         
         $user = Auth::user();
         $studant = 0;
         $total = Curso::find(1)->valor;
         if($user->studant == 1) $studant = $total / 2 ;

         $response = [
             'valor_curso'=> $this->formata_preco($total),
             'estudante'=> $user->studant == 1 ? $this->formata_preco($studant) : '',
             'cupom'=>'',
             'cupomcode'=>'',
             'total'=> $this->formata_preco(($total - $studant))
         ];

       return \Response::json($response,201);
    }

    public function UseCupom( Request $request ){
             
             $this->validate($request, [
                 'cupom' => 'required'
             ]);

             $cupon = Cupon::where('cupom',$request->cupom)->firstOrFail();   
             
             if($cupon->quantidade <= $cupon->maximo){ 
                $user = Auth::user();
                $studant = 0;
                $total = Curso::find(1)->valor;
                               
                if($user->studant == 1) $studant = $total / 2;
                $desconto = $studant > 0 ? $studant * ($cupon->porcentagem / 100) : $total * ($cupon->porcentagem / 100); 


                $response = [
                        'valor_curso'=> $this->formata_preco($total),
                        'estudante'=> $user->studant == 1 ?  $this->formata_preco($studant) : '',
                        'cupom'=>  $this->formata_preco($desconto),
                        'cupomcode'=>$request->cupom,
                        'total'=> $this->formata_preco(($total -  $desconto - $studant))
                
                    ];
               return \Response::json($response,201);
             }

             return \Response::json(['responseJSON'=>['Cupom não existe ou já foi utilizados!']],422);

    }

  private function formata_preco($valor)
{
     $negativo = false;
     $preco = "";
     $valor = intval(trim($valor));
     if ($valor < 0) {
         $negativo = true;
         $valor = abs($valor);
     }
     $valor = strrev($valor);
     while (strlen($valor) < 3) {
         $valor .= "0";
     }
     for ($i = 0; $i < strlen($valor); $i++)
     {
         if ($i == 2)
         {
             $preco .= ",";
         }
         if (($i <> 2) AND (($i+1)%3 == 0))
         {
             $preco .= ".";
         }
         $preco .= substr($valor, $i , 1);
     }
     $preco = strrev($preco);
     return ($negativo ? "-" : "") . $preco;
}
}
