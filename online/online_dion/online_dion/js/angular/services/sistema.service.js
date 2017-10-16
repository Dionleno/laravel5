'use strict';
app.service('SistemaService', ['$http','$q','$window',function($http,$q,$window){


           this.OptionGet = function (url) {
                    var deferred = $q.defer();                


                    $http({
                        method: 'GET',
                        url: url,
                        headers: {
                            'Content-Type': 'application/json'
                        },                       
                    }).then(function successCallback(response) {
                        console.log(response);
                        deferred.resolve(response);

                    }, function errorCallback(error) {

                        deferred.reject(error);

                    });

                    return deferred.promise;
                },
                this.OptionPost = function (data,url) {
                    var deferred = $q.defer();
                    console.log(data);


                    $http({
                        method: 'POST',
                        url: url,
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        params: data,
                    }).then(function successCallback(response) {
                        console.log(response);
                        deferred.resolve(response);

                    }, function errorCallback(error) {

                        deferred.reject(error);

                    });

                    return deferred.promise;
                },
                this.OptionPostUpload = function (data,url) {
                    var deferred = $q.defer();
                    console.log(data);
          
                    var n = new FormData();
                    n.append('file[0]',data.file);
                    angular.forEach(data, function(value, key) {
                        n.append(key, value);
                    });

                    $http({
                        method: 'POST',
                        url: url,
                        headers: {
                            'Content-Type': undefined
                        },
                        data: n,
                    }).then(function successCallback(response) {
                        console.log(response);
                        deferred.resolve(response);

                    }, function errorCallback(error) {

                        deferred.reject(error);

                    });

                    return deferred.promise;
                }
}]);