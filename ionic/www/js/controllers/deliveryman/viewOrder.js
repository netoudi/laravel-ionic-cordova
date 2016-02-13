angular.module('starter.controllers')
    .controller('DeliverymanViewOrderCtrl', [

        '$scope', '$state', '$ionicLoading', '$ionicPopup', '$stateParams', '$cordovaGeolocation', 'DeliverymanOrder',

        function ($scope, $state, $ionicLoading, $ionicPopup, $stateParams, $cordovaGeolocation, DeliverymanOrder) {
            var watch;

            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando...'
            });

            DeliverymanOrder.get({id: $stateParams.id, include: 'items,cupom'}, function (data) {
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                console.debug(dataError);
                $ionicLoading.hide();
            });

            $scope.goToDelivery = function () {
                $ionicPopup.alert({
                    title: 'Advertência!',
                    template: '<div class="text-center">Para parar a localização dê ok.</div>'
                }).then(function () {
                    stopWatchPosition();
                });

                DeliverymanOrder.updateStatus({id: $stateParams.id}, {status: 1}, function () {
                    var watchOptions = {
                        timeout: 3000,
                        enableHighAccuracy: false
                    };

                    watch = $cordovaGeolocation.watchPosition(watchOptions);

                    watch.then(null, function (responseError) {
                        // error
                    }, function (position) {
                        DeliverymanOrder.geo({id: $stateParams.id}, {
                            lat: position.coords.latitude,
                            long: position.coords.longitude
                        });
                    });
                });
            };

            $scope.okDelivery = function (order) {
                $ionicLoading.show({
                    template: 'Processando...'
                });

                DeliverymanOrder.updateStatus({id: order.id}, {status: 2}, function (data) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Advertência!',
                        template: '<div class="text-center">Entrega finalizada com sucesso.</div>'
                    }).then(function () {
                        $state.go('deliveryman.orders');
                    });
                }, function (responseError) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Advertência!',
                        template: '<div class="text-center">Não foi possível finalizar a entrega. <br>Tente mais tarde.</div>'
                    });
                });
            };

            function stopWatchPosition() {
                if (watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')) {
                    $cordovaGeolocation.clearWatch(watch.watchId);
                }
            }
        }

    ]);