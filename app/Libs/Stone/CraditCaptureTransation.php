<?php
 

namespace App\Libs\Stone;

use \Gateway\ApiClient;

/**
 * 
 */

class CraditCaptureTransation
{		
	
	public $nmCartao;	
	public $titularCartao;	
	public $validate;	
	public $cvv;	
	public $valorDaCompra;	
	public $nmParcela;	
	public $referenceID;
	private $OrderKey , $response, $key;
	
	function __construct($orderKey,$valor,$tokenKey)
	{				
           $this->OrderKey = $orderKey;
		   $this->valorDaCompra = $valor;
		   $this->key  = $tokenKey;


		    //Define a url utilizada
			ApiClient::setBaseUrl("https://transaction.stone.com.br");						
			//Define a chave da loja f2a1f485-cfd4-49f5-8862-0ebc438ae923 real =>33a78296-c701-42b4-b6c7-65cf1412a5c5
			ApiClient::setMerchantKey("33a78296-c701-42b4-b6c7-65cf1412a5c5");				
	}
	
	function createCapture(){
		
		try{
		    // Cria objeto da requisição
            $request = new \Gateway\One\DataContract\Request\CaptureRequest();
            
			    $request->addCreditCardTransaction()
					->setAmountInCents($this->valorDaCompra)
					->setTransactionkey($this->key);
            
			
			// Define dados da requisição
            $request->setOrderKey( $this->OrderKey );

            // Cria novo objeto ApiClient
            $client = new ApiClient();

            // Faz a chamada
            $this->response = $client->capture($request);	
            $this->httpStatusCode = $this->response->isSuccess() ? 201 : 401;
		}
		catch (\Gateway\One\DataContract\Report\ApiError $error)
        {
            $this->httpStatusCode = $error->errorCollection->ErrorItemCollection[0]->ErrorCode;
            $this->response = array("message" => $error->errorCollection->ErrorItemCollection[0]->Description);
        }
        catch (Exception $ex)
        {
            $this->httpStatusCode = 500;
            $this->response = array("message" => "Ocorreu um erro inesperado.");
        } 
						
	}


	public function getHttpStatusCode(){
		return $this->httpStatusCode;
	}			
    
	public function getStatus(){
		return $this->httpStatusCode == 201 || $this->httpStatusCode == 401 ? $this->response->getData()->CreditCardTransactionResultCollection[0]->CreditCardTransactionStatus : false ;
	}

	public function getResponse(){
		if($this->httpStatusCode == 201 || $this->httpStatusCode == 401){
              return $this->response->getData();
		}else{
			return $this->response;
		}
	
	}
}




