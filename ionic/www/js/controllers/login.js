angular.module('starter.controllers')
    .controller('LoginCtrl', [

        '$scope', 'OAuth', 'OAuthToken', '$ionicPopup', '$state', '$localStorage', 'User', 'UserData',

        function ($scope, OAuth, OAuthToken, $ionicPopup, $state, $localStorage, User, UserData) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.login = function () {
                var promise = OAuth.getAccessToken($scope.user);

                promise
                    .then(function (data) {
                        var token = $localStorage.get('device_token');
                        return User.updateDeviceToken({}, {device_token: token}).$promise;
                    })
                    .then(function (data) {
                        return User.authenticated({include: 'client'}).$promise;
                    })
                    .then(function (data) {
                        UserData.set(data.data);
                        if (data.data.role == 'deliveryman') {
                            $state.go('deliveryman.orders');
                        } else {
                            $state.go('client.view-products');
                        }
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