<?php

namespace App\Libs\Stone;

use \Gateway\ApiClient;

/**
 * 
 */

class CreditAutorization
{		
	
	public $nmCartao;	
	public $titularCartao;	
	public $validate;	
	public $cvv;	
	public $valorDaCompra;	
	public $nmParcela;	
	public $referenceID;
	private $httpStatusCode , $response;
	
	function __construct()
	{				
		    //Define a url utilizada
			ApiClient::setBaseUrl("https://transaction.stone.com.br");						
			//Define a chave da loja f2a1f485-cfd4-49f5-8862-0ebc438ae923 real => 33a78296-c701-42b4-b6c7-65cf1412a5c5
			ApiClient::setMerchantKey("33a78296-c701-42b4-b6c7-65cf1412a5c5");				
	}
	
	function createAuth(){
		
		try{
			
			//Cria objeto requisição
			$createSaleRequest = new \Gateway\One\DataContract\Request\CreateSaleRequest();			
			//Cria objeto do cartão de crédito
			$creditCard = \Gateway\One\Helper\CreditCardHelper::createCreditCard($this->nmCartao,
			                                                                     $this->titularCartao, 
																				 $this->validate, 
																				 $this->cvv);						
			//Define dados da transação
			$createSaleRequest->addCreditCardTransaction()
			->setAmountInCents($this->valorDaCompra)//
			->setPaymentMethodCode(\Gateway\One\DataContract\Enum\PaymentMethodEnum::AUTO)//AUTO
			->setCreditCardOperation(\Gateway\One\DataContract\Enum\CreditCardOperationEnum::AUTH_AND_CAPTURE)
			->setInstallmentCount($this->nmParcela)
			->setCreditCard($creditCard);
			
			//Define dados do pedido
			$createSaleRequest->getOrder()
			->setOrderReference($this->referenceID);
			
			//Cria um objeto ApiClient
			$apiClient = new \Gateway\ApiClient();
						
			//Faz a chamada para criação
			$this->response = $apiClient->createSale($createSaleRequest);
					
			// Mapeia resposta
            $this->httpStatusCode = $this->response->isSuccess() ? 201 : 401;		
		}
		catch (\Gateway\One\DataContract\Report\CreditCardError $error)
		{
			$this->httpStatusCode = 400;
			$this->response = array("message" => $error->getMessage());
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



