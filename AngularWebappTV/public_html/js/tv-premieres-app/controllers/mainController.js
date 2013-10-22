app.controller("mainController", function($scope, $http){
    
    $scope.apiKey = "2d1bfc9c2aad356bba8cffe094ad341a";
    $scope.results = [];
    $scope.init = function() {
        //Date de début
        var today = new Date();
        var apiDate = today.getFullYear() + ("0" + (today.getMonth() + 1)).slice(-2) + "" + ("0" + today.getDate()).slice(-2);
        $http.jsonp('http://api.trakt.tv/calendar/premieres.json/' + $scope.apiKey + '/' + apiDate + '/' + 30 + '/?callback=JSON_CALLBACK').success(function(data) {
            //Pour chq jour récupérer tous les épisodes
            angular.forEach(data, function(value, index){
                /*l'API enregistre la date séparément pour chaque épisode.
                  on la sauvegarde pour la réutliser
                 **/
                var date = value.date;
                //ajouter chq épisode au tableau
                angular.forEach(value.episodes, function(tvshow, index){
                    tvshow.date = date;
                    $scope.results.push(tvshow);
                });
            });
        }).error(function(error) {
 
        });
    };

});

