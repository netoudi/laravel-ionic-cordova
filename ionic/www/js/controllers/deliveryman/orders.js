angular.module('starter.controllers')
    .controller('DeliverymanOrdersCtrl', [

        '$scope', '$state', '$ionicLoading', 'Order',

        function ($scope, $state, $ionicLoading, Order) {
            $scope.orders = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });

            $scope.openListProducts = function () {
                $state.go('client.view-products');
            };

            $scope.doRefresh = function () {
                getOrders().then(function (data) {
                    $scope.orders = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                }, function (dataError) {
                    $scope.$broadcast('scroll.refreshComplete');
                });
            };

            $scope.openOrderDetail = function (order) {
                $state.go('client.view-order', {id: order.id});
            };

            function getOrders() {
                return Order.query({
                    id: null,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            }

            getOrders().then(function (data) {
                $scope.orders = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });
        }

    ]);