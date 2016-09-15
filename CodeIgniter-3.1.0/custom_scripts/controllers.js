	angular.module('myApp')

	// FACTORIES
	.factory('loginFactory', ['$http', function($http){
		return {
			userLogin : function(data){
				var config = {
					headers : {
						'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'        	
                	}
				}
            	return $http.post("index.php/welcome/set_session", data, config)      		
			}
		}
	}])

	.factory('postFormFactory', ['$http', function($http){
		return {
			postJobForm : function(data){
				var config = {
					headers : {
						'content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
					}
				}
				return $http.post("index.php/welcome/post_job", data, config)
			}
		}
	}])

	.factory('getDataFactory', ['$http', function($http){
		return {
			getData: function(data){
				var config = {
					headers : {
						'content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
					}
				}
				return $http.post('index.php/welcome/get_userinfo', data, config);
			}
		};
	}])

	.factory('logOutFactory', ['$http', function($http){
		return {
			logOut : function(data){
				var config = {
					headers : {
						'content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
					}
				}
				return $http.post("index.php/welcome/logout", data, config);
			}
		}
	}])
	// FACTORIES END

	// CONTROLLERS
	.controller('loginCtrl', ['$scope', '$http', '$cookies', '$route', '$location', '$rootScope', 'loginFactory', 'getDataFactory', 'logOutFactory', function($scope, $http, $cookies, $route, $location, $rootScope, loginFactory, getDataFactory, logOutFactory){

		//FUNCTION FOR MAKING POST-JOB AND USER ACCOUNT VISIBLE
		$scope.loginTab = function(){
			$("#signUpModal").modal('hide')
			if ($cookies.get("user_identifier")) {
				return true;
			} else {
				return false;
			}
		}

		//IF COOKIE IS AVAILABLE SEND REQUEST TO FETCH DATA OF LOGINED USER
		if ($cookies.get("user_identifier")) {
			var login_credentials = $.param({
        	user_identifier: $cookies.get("user_identifier"),
        	auth_key: $cookies.get("auth_key")
        });
        getDataFactory.getData(login_credentials)
        	.success(function(data){
        		$scope.name = data.display_name;
        		$scope.photo = data.photo_url;
        	}).error(function(){
        		alert('oops an error occured');
        	})
		}

		// FACEBOOK LOGIN FUNCTION
		$scope.FbLogin = function(){
			FB.login(function(response) {
			    if (response.authResponse) {
			    	FB.api('/me?fields=first_name,picture,last_name', function(response) {    		       
				    	console.log('Good to see you, ' + response.first_name + '.');
					    var data = $.param({
			                id: response.id,
			                firstname: response.first_name,
			                lastname: response.last_name,
			                email: "",
			                photo_url: response.picture.data.url,
			                provider:"facebook"
			            	});
				        
				    		loginFactory.userLogin(data)
					    		.success(function (data, status, headers, config) {
					    			$scope.name = response.first_name + " " + response.last_name;
					    			$scope.photo = response.picture.data.url;
				        			$location.path("#/home");
			            		})
			            		.error(function (data, status, header, config) {
			                		$scope.ResponseDetails = "Data: " + data +
				                    "<hr />status: " + status +
				                    "<hr />headers: " + header +
				                    "<hr />config: " + config;
			            		});
					});
				}
			});
		}

		// LINKEDIN LOGIN function
		function linkedinLogin(){
		    console.log('linkedinLogin called');
		    var src="http://platform.linkedin.com/in.js"
		    api_key: 'XXXXXXXXXXXXXXXX'
		    authorize: true
		    onLoad: OnLinkedInFrameworkLoad
		}

		function OnLinkedInFrameworkLoad(){
		      IN.Event.on(IN, "auth", OnLinkedInAuth);
		}

		function OnLinkedInAuth() {
		    IN.API.Profile("me").result(ShowProfileData);
		    console.log("info");
		}
		function ShowProfileData(profiles) {
		    var member = profiles.values[0];
		    console.log(member);
		    var id=member.id;
		    var firstName=member.firstName; 
		    var lastName=member.lastName; 
		    var photo=member.pictureUrl; 
		    var headline=member.headline;
		    console.log(id);
		    console.log(firstName);
		    console.log(lastName);
		    console.log(photo);
		    console.log(headline);
		    var data = $.param({
                id: id,
                firstname: firstName,
                lastname: lastName,
                email: ""
            	});
	        var config = {
            	headers : {
                	'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            	}
        	}
        	loginFactory.userLogin(data)
        		.success(function (data, status, headers, config) {
        			$route.reload();
        		})
        		.error(function (data, status, header, config) {
            		$scope.ResponseDetails = "Data: " + data +
                    "<hr />status: " + status +
                    "<hr />headers: " + header +
                    "<hr />config: " + config;
        		});
		}

		// GOOGLE LOGIN function
		function onSignIn(googleUser) {
			console.log(googleUser);
	  		var profile = googleUser.getBasicProfile();
	  		console.log("enter");
	  		console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
	  		console.log('Name: ' + profile.getName());
	  		console.log('Image URL: ' + profile.getImageUrl());
	  		console.log('Email: ' + profile.getEmail());
	  		var data = $.param({
                id: profile.getId(),
                firstname: profile.getName(),
                lastname: "",
                email: profile.getEmail()
            	});
	        var config = {
            	headers : {
                	'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            	}
        	}
        	loginFactory.userLogin(data)
        		.success(function (data, status, headers, config) {
        			$route.reload();
				})
        		.error(function (data, status, header, config) {
            		$scope.ResponseDetails = "Data: " + data +
                    "<hr />status: " + status +
                    "<hr />headers: " + header +
                    "<hr />config: " + config;
        		});
        }

        $scope.logout = function(){
        	var login_credentials = $.param({
	        	user_identifier: $cookies.get("user_identifier"),
	        	auth_key: $cookies.get("auth_key")
        	});
        	console.log(login_credentials);
        	logOutFactory.logOut(login_credentials)
        		.success(function(data, status, header, config){
        			$route.reload();		
        		});
        }
	}])

	.controller("home-ctrl", ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope){

	}])

	.controller("find-job-ctrl", ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope){

	}])

	.controller("companies-ctrl", ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope){

	}])

	.controller("post-job-ctrl", ['$scope', '$http', '$cookies', '$location', '$rootScope', '$window', 'postFormFactory', 'getDataFactory', function($scope, $http, $cookies, $location, $rootScope, $window, postFormFactory, getDataFactory){

		// TO PREFILL YOUR ACCOUNT
		$scope.getDataFactory = getDataFactory;
		// console.log(getDataFactory);

		// EMAIL VALIDATION


		// DATE PICKER
        $(function () {
                $('#datetimepicker1').datetimepicker();
        });


		// CHECKING WEATHER USER IS LOGIN OR NOT, IF IT DO SO THEN ALLOW TO ACCESS POST-JOB PAGE, ELSE REDIRECT TO HOME PAGE
		if ($cookies.get("user_identifier")) {
			}else {
				$location.path("#/home");
				$("#signUpModal").modal();
			}

		// FUNCTION TO SHOW PREVIEW OF POST-JOB FORM 
		$scope.formPreview = function(){
			var jobTitle = document.getElementById('job-title-id').value,
				applicationEmail = document.getElementById('application-email-id').value,
				jobType = document.getElementById('job-type-id').value,
				jobTag = document.getElementById('job-tag-id').value,
				description = document.getElementById('description-id').value,
				closingDate = document.getElementById('closing-date-id').value,
				companyName = document.getElementById('company-name-id').value;
			var fieldArray = [
				"job-title", "application-email", "location", "job-type", "job-tag", "image", "description", "closing-date", "company-name", "tag-line",
				 "company-description", "logo", "video", "company-website", "google-username", "facebook-username", "linkedin-username", "twitter-username"
			]

			$scope.values = {
				email: document.getElementById('application-email-id').value,
				video: document.getElementById('video-id').value,
				website: document.getElementById('company-website-id').value,
				google: document.getElementById('google-username-id').value,
				facebook: document.getElementById('facebook-username-id').value,
				linkedin: document.getElementById('linkedin-username-id').value,
				twitter: document.getElementById('twitter-username-id').value
			}

			if (jobTitle == "" || jobType == "" || applicationEmail == "" || jobTag == "" || description == "" || closingDate == "" || companyName == "") {
				alert("Please fill all mendatory fields.")
				$("formPreview").modal("hide")
			}else{
				$("formPreview").modal()
				fieldArray.forEach(function(elements, index){
					if (elements == "image" || elements == "logo" ) {
							var oFReader = new FileReader();
								if(document.getElementById(elements+'-id').files.length != 0){
							        oFReader.readAsDataURL(document.getElementById(elements+'-id').files[0]);
							        oFReader.onload = function (oFREvent) {
							            document.getElementById(''+elements).src = oFREvent.target.result;
							        };
								}
					}else{
						var sub_string = '@';
						if (document.getElementById("application-email-id").value.indexOf(sub_string) != -1) {	
							$("#formPreview").modal()
							document.getElementById("" + elements).innerHTML = document.getElementById(elements + "-id").value;			
						}else{
							$("#formPreview").modal('hide');
							document.getElementById("validation-message").innerHTML = '<h2> Email not valid</h2>'
						}
					}
				})
			}

			// FUNCTION FOR SENDING THE FORM TO THE DATA BASE
			$scope.postForm = function($scope){
				if ($cookies.get("user_identifier")) {
					var job_meta = {};
					var company_meta = {};
					fieldArray.forEach(function(elements, index){
						if (index <= 7) {
							job_meta[''+elements] = document.getElementById(elements + "-id").value; 
						}else{
							company_meta[''+elements] = document.getElementById(elements+'-id').value;
						}
					})
					var postData = $.param({
						otp:$cookies.get("auth_key"),
						user_id: $cookies.get("user_identifier"),
						job_meta: job_meta,
						company_meta: company_meta,
						company_name: document.getElementById(fieldArray[8]+'-id').value
					});
					postFormFactory.postJobForm(postData)
						.success(function(data, headers, config, status){
							$("#formPreview").modal("hide")
							$window.location.reload();
						})
				}else {
					$location.path("#/home")
					$("#signUpModal").modal()
				}
			}
		}

		// FUNCTION FOR EDIT LISTING
		$scope.editListing = function(){
			$("#formPreview").modal("hide");
			document.getElementById("validation-message").innerHTML = '';
		}
	}])