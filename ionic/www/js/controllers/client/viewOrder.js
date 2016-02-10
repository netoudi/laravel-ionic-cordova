angular.module('starter.controllers')
    .controller('ClientViewOrderCtrl', [

        '$scope', '$ionicLoading', '$stateParams', 'Order',

        function ($scope, $ionicLoading, $stateParams, Order) {
            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando...'
            });

            Order.get({id: $stateParams.id, include: 'items,cupom'}, function (data) {
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });
        }

    ]);