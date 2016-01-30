angular.module('starter.controllers')
    .controller('ClientOrdersCtrl', [

        '$scope', '$state', '$ionicLoading', 'Order',

        function ($scope, $state, $ionicLoading, Order) {
            $scope.orders = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });

            $scope.openListProducts = function () {
                $state.go('client.view-products');
            };

            Order.query({}, function (data) {
                $scope.orders = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });
        }

    ]);