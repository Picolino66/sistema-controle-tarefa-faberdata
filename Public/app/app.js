var myApp = angular.module('tarefaModulo', ['ui.router', 'ui.bootstrap']);

myApp.config(function ($stateProvider, $locationProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/sistema-controle-tarefa-faberdata');
    $stateProvider
            .state('/sistema-controle-tarefa-faberdata', {
                url: '/sistema-controle-tarefa-faberdata',
                templateUrl: '/sistema-controle-tarefa-faberdata/Public/templates/tarefa.html',
                controller: 'tarefaController',
                controllerAs: "std_ctrl",
              
                resolve: {
                    'title': ['$rootScope', function ($rootScope) {
                            $rootScope.title = "CRUD Tarefas";
                        }]
                }

            })
            
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });




});