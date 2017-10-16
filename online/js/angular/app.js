'use strict';
var app = angular.module('app', ['ngMask'])
        .run(function ($rootScope) { 
             $rootScope.opts = {
		   "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
		};
        });

app.directive('file', function () {
    return {
        require: "ngModel",
        scope: {
            ngModel: "="
        },
        restrict: 'AE',
        transclude: true,
        controllerAs: 'Empresactrl',
        link: function (scope, el, attrs, ngModel) {
            console.log("teste");
            el.bind('change', function (event) {
                var files = event.target.files;
                var file = files[0];

                //validar 

                var filename = file.name;

                var index = filename.lastIndexOf(".");
                var strsubstring = filename.substring(index, filename.length);


                ngModel.$setViewValue(file);
                scope.$apply();
            });
        }
    };
});        