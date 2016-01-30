angular.module('starter.filters').filter('orderStatus', ['$filter', function ($filter) {
    return function (input) {
        var status = ['Pedido realizado', 'A caminho', 'Entrege', 'Cancelado'];
        return status[input] || input;
    };
}]);