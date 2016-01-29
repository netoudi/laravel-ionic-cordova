// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'

angular.module('starter.controllers', []);

angular.module('starter.services', [])

angular.module('starter', ['ionic', 'angular-oauth2', 'starter.controllers', 'starter.services', 'ngResource'])

    .constant('appConfig', {
        baseUrl: 'http://localhost:8000'
    })

    .run(function ($ionicPlatform) {
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

    .config(function (OAuthProvider, OAuthTokenProvider, $urlRouterProvider, $stateProvider) {

        OAuthProvider.configure({
            baseUrl: 'http://localhost:8000',
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
                url: '/client',
                template: '<ui-view/>'
            })
            .state('client.checkout', {
                url: '/checkout',
                templateUrl: 'templates/client/checkout.html',
                controller: 'ClientCheckoutCtrl'
            })
            .state('client.checkout-item-detail', {
                url: '/checkout/detail/:item',
                templateUrl: 'templates/client/checkout_item_detail.html',
                controller: 'ClientCheckoutDetailCtrl'
            })
            .state('client.view-products', {
                url: '/view-products',
                templateUrl: 'templates/client/view_products.html',
                controller: 'ClientViewProductCtrl'
            });

        //$urlRouterProvider.otherwise('/');

    });

