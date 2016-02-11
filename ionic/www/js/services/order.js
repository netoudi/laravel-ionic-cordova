angular.module('starter.services')
    .factory('ClientOrder', ['$resource', 'appConfig', function ($resource, appConfig) {

        return $resource(appConfig.baseUrl + '/api/client/orders/:id', {id: '@id'}, {
            query: {
                isArray: false
            }
        });

    }])
    .factory('DeliverymanOrder', ['$resource', 'appConfig', function ($resource, appConfig) {

        return $resource(appConfig.baseUrl + '/api/deliveryman/orders/:id', {id: '@id'}, {
            query: {
                isArray: false
            }
        });

    }]);