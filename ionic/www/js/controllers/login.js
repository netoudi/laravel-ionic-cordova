angular.module('starter.controllers')
    .controller('LoginCtrl', [

        '$scope', 'OAuth', 'OAuthToken', '$ionicPopup', '$state', 'User', 'UserData',

        function ($scope, OAuth, OAuthToken, $ionicPopup, $state, User, UserData) {

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
                        UserData.set(data.data);
                        $state.go('client.view-products');
                    }, function (responseError) {
                        UserData.set(null);
                        OAuthToken.removeToken();
                        $ionicPopup.alert({
                            title: 'Advertência!',
                            template: '<div class="text-center">Login e/ou senha inválidos.</div>'
                        });
                        console.debug(responseError);
                    });
            };

            $scope.setUser = function (type) {
                var username = '', password = '123456';

                switch (type) {
                    case 'client':
                        username = 'user@user.com';
                        break;
                    case 'deliveryman':
                        username = 'deliveryman@user.com';
                        break;
                    case 'admin':
                        username = 'admin@user.com';
                        break;
                }

                $scope.user = {
                    username: username,
                    password: password
                };
            };

        }]);