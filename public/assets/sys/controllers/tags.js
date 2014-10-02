function TagsCtrl ($scope, $rootScope, $http, $templateCache)
{
    var url =  'http://' + window.location.host;

    $scope.url          = url + '/ajax/tags/load-tags';
    $scope.saveUrl      = url + '/ajax/tags/store-tag';
    $scope.deleteUrl    = url + '/ajax/tags/delete-tag';

    $scope.init = function(entity, entityId, items)
    {
        $scope.data = { 'entity' : entity, 'entity_id' : entityId };

        $scope.load(true);
    };

    $scope.load = function(init)
    {
        $http.post($scope.url, $scope.data)
            .success(function (data, status) {
                $scope.tags = data;

                if (init)
                    $rootScope.$broadcast('tagsLoaded');          // Loaded for first load
                else
                    $rootScope.$broadcast('tagsUpdated');         // Updated for any other
            })
            .error(function (data, status) {
                if (data)
                    alert('Se ha producido un error al cargar las etiquetas.');
            });
    };

    $scope.create = function()
    {
        $scope.saveData = { 'entity' : $scope.data.entity, 'entity_id' : $scope.data.entity_id, 'tag' : $scope.tagName };

        $http.post($scope.saveUrl, $scope.saveData)
            .success(function (data, status) {
                $scope.load(false);
                $scope.tagName = '';

                $rootScope.$broadcast('tagCreated');
            })
            .error(function (data, status) {
                if (data)
                    alert('Se ha producido un error al guardar la etiqueta.');
            });
    };

    $scope.delete = function($index)
    {
        $scope.deleteData = { 'entity' : $scope.data.entity, 'entity_id' : $scope.data.entity_id, 'tagIndex' : $index };

        $http.post($scope.deleteUrl, $scope.deleteData)
            .success(function (data, status) {
                $scope.load(false);

                $rootScope.$broadcast('tagDeleted');
            })
            .error(function (data, status) {
                if (data)
                    alert('Se ha producido un error al eliminar la etiqueta.');
            });
    };

}