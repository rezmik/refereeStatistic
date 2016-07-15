var refereeApp = angular.module('refApp', ['ui.router']);

refereeApp.config(['$urlRouterProvider', '$stateProvider', function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/home');

    $stateProvider
      .state('home', {
        url: '/home',
        template: '<h1>Hello</h1>'
      });
  }]);
