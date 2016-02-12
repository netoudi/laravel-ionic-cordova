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

            $scope.markers = [
                {
                    id: 1,
                    coords: {
                        latitude: -23.444,
                        longitude: -46.444
                    },
                    options: {
                        title: 'Meu título',
                        labelContent: 'Meu marcador',
                        icon: 'http://maps.google.com/mapfiles/kml/shapes/airports.png'
                    }
                },
                {
                    id: 2,
                    coords: {
                        latitude: -22.444,
                        longitude: -46.444
                    },
                    options: {
                        title: 'Meu título',
                        labelContent: 'Meu marcador'
                    }
                }
            ];

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