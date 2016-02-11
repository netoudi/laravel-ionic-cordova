angular.module('starter.controllers')
    .controller('DeliverymanOrdersCtrl', [

        '$scope', '$state', '$ionicLoading', 'DeliverymanOrder',

        function ($scope, $state, $ionicLoading, DeliverymanOrder) {
            $scope.orders = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });

            $scope.openListProducts = function () {
                $state.go('deliveryman.view-products');
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
                $state.go('deliveryman.view-order', {id: order.id});
            };

            function getOrders() {
                return DeliverymanOrder.query({
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