angular.module('starter.controllers')
    .controller('ClientViewProductCtrl', ['$scope', '$state', '$ionicLoading', 'Product', function ($scope, $state, $ionicLoading, Product) {

        $scope.products = [];

        $ionicLoading.show({
            template: 'Carregando...'
        });

        Product.query({}, function (data) {
            $scope.products = data.data;
            $ionicLoading.hide();
        }, function (dataError) {
            $ionicLoading.hide();
        });

    }]);