var myApp = angular.module('myApp', ['ngRoute', 'ngCookies', 'ngMessages']);
	
	// INITIATING FB FUNTION ASYNHRONOUSLY
	window.fbAsyncInit = function() {
	    FB.init({ 
	      appId: '1154376217983383',
	      status: true, 
	      cookie: true, 
	      xfbml: true,
	      version: 'v2.7'
	    });
	};

	(function(d, s, id){
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) {return;}
	    js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs); 
		}(document, 'script', 'facebook-jssdk'));

	// INITIATING TINY MCE ONLINE TEXT EDITOR
	tinymce.init({
	    selector: '#company-description-id'
	});


	// $(window).scroll(function() {
	// 	if ($(document).scrollTop() > 50) {
	// 		$('nav').addClass('shrink');
	// 		console.log("its scrolling")
	// 	} else {
	// 		$('nav').removeClass('shrink');
	// 	}
	// });

	// IMPLEMENTING ROUTING
	myApp.config([
			'$routeProvider', function($routeProvider){
				$routeProvider.when('/home', {
					templateUrl: '../CodeIgniter-3.1.0/partials/home.php',
					controller: 'home-ctrl',
				}).when('/find-job', {
					templateUrl: '../CodeIgniter-3.1.0/partials/find-job.php',
					controller: 'find-job-ctrl'
				}).when('/post-job', {
					templateUrl: '../CodeIgniter-3.1.0/partials/post-job.php',
					controller: 'post-job-ctrl'
				}).when('/companies', {
					templateUrl: '../CodeIgniter-3.1.0/partials/companies.php',
					controller: 'companies-ctrl'
				}).otherwise({
					redirectTo: '/home'
				});
		}]);