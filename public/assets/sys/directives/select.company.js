angular.module('app').directive("selectCompany", function($timeout) {

    // URLs donde realizar las peticiones de información de empresas.
    var loadCompaniesUrl    = 'http://' + window.location.host + '/ajax/company/load-companies';
    var loadCompanyUrl      = 'http://' + window.location.host + '/ajax/company/get-company';

    return {
        restrict: 'A',
        replace: true,

        template: '<input ui-select2="companySelect2Options" ng-model="companySelected" />',

        // Si se ha establecido un valor por defecto (existía una empresa), la carga remotamente
        // y la marca como seleccionada por defecto.
        controller: ['$scope', '$element', '$attrs', '$transclude', '$http', function($scope, $element, $attrs, $transclude, $http) 
        {
            if ( ! $element.val())
            {
                $scope.selectCompanyInitialized = true;
                return;
            }

            data = { 'id' : $element.val() };

            $http.post(loadCompanyUrl, data)
                .success(function (data, status) { $scope.companySelected = data; $scope.selectCompanyInitialized = true; })
                .error(function (data, status) { alert('Se ha producido un error'); });
        }],

        // Se ejecuta justo después de ser creado el elemento en el DOM. Inicializa el Select2.
        link: function (scope, element, attrs, ctrl) {

            // Opciones Select2 AJAX
            scope.companySelect2Options = {
                placeholder         : "Buscar empresa", minimumInputLength : 3, allowClear : true,
                    ajax: {
                        url                 : loadCompaniesUrl,
                        dataType            : 'json',
                        type                : 'post',
                        quietMillis         : '250',
                        data                : function (term, page) { return { name: term }; },
                        results             : function (data, page) { return { results : data }; }
                    },
                    formatResult    : function(item) { return item.name; },
                    formatSelection : function(item) { return item.name; },
                    escapeMarkup    : function (m) { return m; },
            }
       },
    };
});