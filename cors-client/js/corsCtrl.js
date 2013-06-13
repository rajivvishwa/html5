angular.module('CorsTest', ['ngResource']).controller('corsCtrl', function ($scope, $http, $resource) {
    $http.defaults.useXDomain = true;

    url0="http://ricardohbin.com/cors/testcors.php";
    url="../cors-server/test.json";  
    
    $scope.isAllowed = function() {
        $http.get(url)
            .success(function(data) {
                $scope.corsData = data.first;
            });
    };

    $scope.isNotAllowed = function() {
        $http.get('http://api.twitter.com/help/test.json')
            .success(function(data) {
                alert(data);
            })
            .error(function(data, headers) {
                alert(data); 
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