angular.module('starter.controllers')
    .controller('ClientMenuCtrl', [

        '$scope', '$state', '$ionicLoading', 'User',

        function ($scope, $state, $ionicLoading, User) {
            $scope.user = {
                name: ''
            };

            $ionicLoading.show({
                template: 'Carregando...'
            });

            User.authenticated({}, function (data) {
                $scope.user = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });
        }

    ]);