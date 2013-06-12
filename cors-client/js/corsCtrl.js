angular.module('Test', ['ngResource']).controller('corsCtrl', function ($scope, $http, $resource) {
    $http.defaults.useXDomain = true;

    $scope.useHttp = function() {
        $http.get('http://google.com')
            .success(function(data) {
                alert(data.ok);
            });
    };

    $scope.useResource = function() {
        var User = $resource('http://ricardohbin.com/cors/testcors.php', {
            userId: '@id'
        });
        User.get({
            userId: 123
        }, function(data) {
            alert(data.ok);
        });
    };
});