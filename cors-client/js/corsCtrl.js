angular.module('CorsTest', ['ngResource']).controller('corsCtrl', function ($scope, $http, $resource) {
    $http.defaults.useXDomain = true;

    urlA="../cors-server/test.json"; 
    urlA1="http://ricardohbin.com/cors/testcors.php";
    urlNA="http://api.twitter.com/help/test.json";
    CORS_ERROR = "Error - Cors Not Enabled";
    
    $scope.isAllowed = function() {
        $http.get(url=urlA1)
            .success(function(data,status) {
                $scope.corsData = data;
                $scope.corsURL = url;
                $scope.corsStatus = status;
            });
    };

    $scope.isNotAllowed = function() {
        $http.get(url=urlNA)
            .success(function(data) {
                $scope.corsData = data;
            })
            .error(function(data, status) {
                $scope.corsData = CORS_ERROR;
                $scope.corsURL = url;
                $scope.corsStatus = status;

            });
    };

    $scope.useResource = function() {
        var User = $resource(url=urlA1, {
            userId: '@id'
        });
        User.get({
            userId: 123
        }, function(data) {
            alert(data.ok);
        });
    };
});