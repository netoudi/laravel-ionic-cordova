// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'

angular.module('starter.controllers', []);

angular.module('starter.services', [])

angular.module('starter.filters', [])

angular.module('starter', ['ionic','ionic.service.core', 'angular-oauth2', 'starter.controllers', 'starter.services', 'starter.filters', 'ngResource', 'ngCordova', 'uiGmapgoogle-maps', 'pusher-angular'])

    .constant('appConfig', {
        baseUrl: 'http://192.168.0.112:8000',
        pusherKey: ''
    })

    .run(function ($ionicPlatform, $window, appConfig) {
        $window.client = new Pusher(appConfig.pusherKey);

        $ionicPlatform.ready(function () {
            if (window.cordova && window.cordova.plugins.Keyboard) {
                // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
                // for form inputs)
                cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

                // Don't remove this line unless you know what you are doing. It stops the viewport
                // from snapping when text inputs are focused. Ionic handles this internally for
                // a much nicer keyboard experience.
                cordova.plugins.Keyboard.disableScroll(true);
            }
            if (window.StatusBar) {
                StatusBar.styleDefault();
            }
        });
    })

    .config(function (OAuthProvider, OAuthTokenProvider, $urlRouterProvider, $stateProvider, $provide, appConfig) {

        OAuthProvider.configure({
            baseUrl: appConfig.baseUrl,
            clientId: 'appid01',
            clientSecret: 'secret', // optional
            grantPath: '/oauth/access_token'
        });

        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false
            }
        });

        $stateProvider
            .state('login', {
                url: '/login',
                templateUrl: 'templates/login.html',
                controller: 'LoginCtrl'
            })
            .state('home', {
                url: '/home',
                templateUrl: 'templates/home.html',
                controller: 'HomeCtrl'
            })

            // CLIENT
            .state('client', {
                abstract: true,
                cache: false,
                url: '/client',
                templateUrl: 'templates/client/menu.html',
                controller: 'ClientMenuCtrl'
            })
            .state('client.checkout', {
                cache: false,
                url: '/checkout',
                templateUrl: 'templates/client/checkout.html',
                controller: 'ClientCheckoutCtrl'
            })
            .state('client.checkout-item-detail', {
                url: '/checkout/detail/:index',
                templateUrl: 'templates/client/checkout_item_detail.html',
                controller: 'ClientCheckoutDetailCtrl'
            })
            .state('client.checkout-successful', {
                cache: false,
                url: '/checkout/successful',
                templateUrl: 'templates/client/checkout_successful.html',
                controller: 'ClientCheckoutSuccessfulCtrl'
            })
            .state('client.view-products', {
                url: '/view-products',
                templateUrl: 'templates/client/view_products.html',
                controller: 'ClientViewProductCtrl'
            })
            .state('client.orders', {
                url: '/orders',
                templateUrl: 'templates/client/orders.html',
                controller: 'ClientOrdersCtrl'
            })
            .state('client.view-order', {
                url: '/view-order/:id',
                templateUrl: 'templates/client/view_order.html',
                controller: 'ClientViewOrderCtrl'
            })
            .state('client.view-delivery', {
                cache: false,
                url: '/view-delivery/:id',
                templateUrl: 'templates/client/view_delivery.html',
                controller: 'ClientViewDeliveryCtrl'
            })

            // DELIVERYMAN
            .state('deliveryman', {
                abstract: true,
                cache: false,
                url: '/deliveryman',
                templateUrl: 'templates/deliveryman/menu.html',
                controller: 'DeliverymanMenuCtrl'
            })
            .state('deliveryman.orders', {
                url: '/orders',
                templateUrl: 'templates/deliveryman/orders.html',
                controller: 'DeliverymanOrdersCtrl'
            })
            .state('deliveryman.view-order', {
                url: '/view-order/:id',
                templateUrl: 'templates/deliveryman/view_order.html',
                controller: 'DeliverymanViewOrderCtrl'
            });

        $urlRouterProvider.otherwise('/login');

        $provide.decorator('OAuthToken', ['$localStorage', '$delegate', function ($localStorage, $delegate) {
            Object.defineProperties($delegate, {
                setToken: {
                    value: function (data) {
                        return $localStorage.setObject('token', data);
                    },
                    enumerable: true,
                    configurable: true,
                    writable: true
                },
                getToken: {
                    value: function () {
                        return $localStorage.getObject('token');
                    },
                    enumerable: true,
                    configurable: true,
                    writable: true

                },
                removeToken: {
                    value: function () {
                        $localStorage.setObject('token', null);
                    },
                    enumerable: true,
                    configurable: true,
                    writable: true
                }
            });

            return $delegate;
        }]);

    });

