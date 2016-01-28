angular.module('starter.controllers')
    .controller('HomeCtrl', ['$scope', '$http', function ($scope, $http) {

        $http({
            method: 'GET',
            url: 'http://localhost:8000/api/authenticated'
        }).then(function (response) {
            $scope.user = response.data.data;
        }, function (response) {
            console.log(response);
        });

    }]);