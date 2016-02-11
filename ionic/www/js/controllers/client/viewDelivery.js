angular.module('starter.controllers')
    .controller('ClientViewDeliveryCtrl', [

        '$scope', '$ionicLoading', '$stateParams', 'ClientOrder',

        function ($scope, $ionicLoading, $stateParams, ClientOrder) {
            $scope.order = {};
            $scope.map = {
                center: {
                    latitude: -23.444,
                    longitude: -46.444
                },
                zoom: 16
            };

            $ionicLoading.show({
                template: 'Carregando...'
            });

            ClientOrder.get({id: $stateParams.id, include: 'items,cupom'}, function (data) {
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });
        }

    ]);