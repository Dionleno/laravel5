'use strict';
app.controller('userController',function($scope,$rootScope,SistemaService,$window) {
  
	 
	$scope.user = {};

	$scope.registerUser = function() {
		console.log($scope.user);
		

		 SistemaService.OptionPostUpload($scope.user,'/user/save').then(
                    function (response) {      
                       $window.location.href = '/pagamento';
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
	}

});