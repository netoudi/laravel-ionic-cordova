angular.module('starter.controllers')
    .controller('LoginCtrl', [

        '$scope', 'OAuth', 'OAuthToken', '$ionicPopup', '$state', '$localStorage', 'User',

        function ($scope, OAuth, OAuthToken, $ionicPopup, $state, $localStorage, User) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.login = function () {
                var promise = OAuth.getAccessToken($scope.user);

                promise
                    .then(function (data) {
                        return User.authenticated({include: 'client'}).$promise;
                    })
                    .then(function (data) {
                        $localStorage.set('user', data.data);
                        $state.go('client.view-products');
                    }, function (responseError) {
                        $localStorage.set('user', null);
                        OAuthToken.removeToken();
                        $ionicPopup.alert({
                            title: 'Advertência!',
                            template: '<div class="text-center">Login e/ou senha inválidos.</div>'
                        });
                        console.debug(responseError);
                    });
            };

        }]);