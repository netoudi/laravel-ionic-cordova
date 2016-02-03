angular.module('starter.controllers')
    .controller('ClientCheckoutCtrl', [

        '$scope', '$state', '$ionicLoading', '$ionicPopup', '$cart', 'Order', 'Cupom',

        function ($scope, $state, $ionicLoading, $ionicPopup, $cart, Order, Cupom) {
            var cart = $cart.get();

            $scope.cupom = cart.cupom;
            $scope.items = cart.items;
            $scope.total = cart.total;

            $scope.removeItem = function (i) {
                $cart.removeItem(i);
                $scope.items.splice(i, 1);
                $scope.total = $cart.get().total;
            };

            $scope.openListProducts = function () {
                $state.go('client.view-products');
            };

            $scope.openProductDetail = function (i) {
                $state.go('client.checkout-item-detail', {'index': i});
            };

            $scope.save = function () {
                var items = angular.copy($scope.items);

                angular.forEach(items, function (item) {
                    item.product_id = item.id;
                });

                $ionicLoading.show({
                    template: 'Processando...'
                });

                Order.save({id: null}, {items: items}, function (data) {
                    $ionicLoading.hide();
                    $state.go('client.checkout-successful');
                }, function (responseError) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Advertência!',
                        template: '<div class="text-center">Pedido não realizado! <br>Tente novamente.</div>'
                    });
                });
            };

            $scope.readBarCode = function () {
                getValueCupom(518);
            };

            $scope.removeCupom = function () {
                $cart.removeCupom();
                $scope.cupom = $cart.get().cupom;
                $scope.total = $cart.getTotalFinal();
            };

            function getValueCupom(code) {
                $ionicLoading.show({
                    template: 'Processando...'
                });

                Cupom.get({code: code}, function (data) {
                    $cart.setCupom(data.data.code, data.data.value);
                    $scope.cupom = $cart.get().cupom;
                    $scope.total = $cart.getTotalFinal();
                    $ionicLoading.hide();
                }, function (responseError) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Advertência!',
                        template: '<div class="text-center">Cupom inválido.</div>'
                    });
                });
            }
        }

    ]);