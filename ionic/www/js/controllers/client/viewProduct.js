angular.module('starter.controllers')
    .controller('ClientViewProductCtrl', [

        '$scope', '$state', '$ionicLoading', 'Product', '$cart',

        function ($scope, $state, $ionicLoading, Product, $cart) {
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

            $scope.addItem = function (item) {
                item.qtd = 1;
                $cart.addItem(item);
                $state.go('client.checkout');
            };
        }

    ]);