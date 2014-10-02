String.prototype.trunc = String.prototype.trunc ||
      function(n){
          return this.length>n ? this.substr(0,n-1)+' ... ' : this;
      };

// Changing AngularJS {{ curly brackets }} for [[ custom brackets ]]. This
// way it can be mixed with blade templating nomenclature.
// Catching also every http event and showing the spinner everytime's caught.
var app = angular.module('app', ['ngResource', 'ui.select2'])
.config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
}])
.config(function ($httpProvider) {
    $httpProvider.responseInterceptors.push('myHttpInterceptor');
    var spinnerFunction = function (data, headersGetter) {
        // todo start the spinner here
        showProgress();
        return data;
    };
    $httpProvider.defaults.transformRequest.push(spinnerFunction);
})
// register the interceptor as a service, intercepts ALL angular ajax http calls
.factory('myHttpInterceptor', function ($q, $window) {
    return function (promise) {
        return promise.then(function (response) {
            // do something on success
            // todo hide the spinner
            hideProgress();
            return response;

        }, function (response) {
            // do something on error
            // todo hide the spinner
            hideProgress();
            return $q.reject(response);
        });
    };
})
.filter('isEmpty', function() {
    return function(input, replaceText) {
        if (input == null)
            return replaceText;
        if ( ! input)
            return replaceText;

        return input;
    }
});