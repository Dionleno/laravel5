'use strict';
app.controller('paymentController', function($scope,$rootScope,SistemaService, $window) {
  
	 
	
    $scope.order = {};
    $scope.cupomcode = '';

	$scope.started_payment = function() {
console.log($scope.order);
		 	 SistemaService.OptionGet('/order/info').then(
                    function (response) {      
                       
                       $scope.order = response.data;
                       

                    }, function (jqXhr) {
                       console.log(jqXhr);
					   
					    if( jqXhr.status === 422 ) {
						   $scope.errors = jqXhr.data; 
						   $scope.errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';
						    $.each( $scope.errors, function( key, value ) {
								$scope.errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
							});
							 $scope.errorsHtml += '</ul>';
							toastr.error($scope.errorsHtml, "Erro ao se cadastrar!", $rootScope.opts);
					   }
                    }
            );
	};

    $scope.useCupom = function() {
          if($scope.cupom == ''){
             alert('Preencha o cupom');return false;
          }
          console.log($scope.cupom);

          SistemaService.OptionPost({'cupom':$scope.cupom}, '/order/cupom').then(
                    function (response) {      
                     $scope.cupomcode = response.data.cupomcode;
                     $scope.order = response.data;

                    }, function (jqXhr) {
                       console.log(jqXhr);
					   
					    if( jqXhr.status === 422 ) {
						   $scope.errors = jqXhr.data; 
						   $scope.errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';
						    $.each( $scope.errors, function( key, value ) {
								$scope.errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
							});
							 $scope.errorsHtml += '</ul>';
							toastr.error($scope.errorsHtml, "Erro ao finalizar a compra!", $rootScope.opts);
					 }
                     
                    }
            );
       
    };


    $scope.payment = function() {
             
             $scope.order.cupomcode = $scope.cupomcode; 
		 	 
              SistemaService.OptionPost($scope.order, '/order/payment').then(
                    function (response) {      
                      console.log(response);
                       $window.location.href = '/thankyou';

                    }, function (jqXhr) {
                       console.log(jqXhr);
					   
					    if( jqXhr.status === 422 ) {
						   $scope.errors = jqXhr.data; 
						   $scope.errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';
						    $.each( $scope.errors, function( key, value ) {
								$scope.errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
							});
							 $scope.errorsHtml += '</ul>';
							toastr.error($scope.errorsHtml, "Erro ao finalizar a compra!", $rootScope.opts);
					 }
                      if( jqXhr.status === 400) {
						   $scope.errors = jqXhr.data; 
						   $scope.errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';						    
							$scope.errorsHtml += '<li>' + $scope.errors.message + '</li>'; //showing only the first error.							
							 $scope.errorsHtml += '</ul>';
							toastr.error($scope.errorsHtml, "Erro ao finalizar a compra!", $rootScope.opts);
					 }
                      if( jqXhr.status === 401 ) {
						   $scope.errors = jqXhr.data; 
						   $scope.errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';						    
							$scope.errorsHtml += '<li>' + $scope.errors.CreditCardTransactionResultCollection[0].AcquirerMessage + '</li>'; //showing only the first error.							
							 $scope.errorsHtml += '</ul>';
							toastr.error($scope.errorsHtml, "Erro ao finalizar a compra!", $rootScope.opts);
					 }

                      if( jqXhr.status === 500 ) {
						  $scope.errors = jqXhr.data; 
						   $scope.errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';						    
							$scope.errorsHtml += '<li>Ocorreu um erro no servidor!</li>'; //showing only the first error.							
							 $scope.errorsHtml += '</ul>';
							toastr.error($scope.errorsHtml, "Erro ao finalizar a compra!", $rootScope.opts);
					 }
                    }
            );
	};

});