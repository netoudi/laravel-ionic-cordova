angular.module('starter.filters').filter('dateBr', ['$filter', function ($filter) {
    return function (input) {
        return $filter('date')(input, 'dd/MM/yyyy HH:mm');
    };
}]);