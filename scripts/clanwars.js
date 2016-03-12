$(function() {
    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
    
    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top'
    })

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });
});


// function fb_login() {
//     FB.login(function(response){
//         if (response.authResponse) {
//             console.log('Welcome!  Fetching your information.... ');
// 
//             FB.api('/me',  {fields: 'id,first_name,middle_name,last_name,email,age_range,birthday'}, function(response) {
//                 console.log(response);
//             });
//             
//         } else {
//             console.log('User cancelled login or did not fully authorize.');
//         }
//     });
//     // Später hinzufügen
//     //}, {scope: 'user_birthday'});
// }



var clanwarsApp = angular.module('clanwarsApp', []);

clanwarsApp.controller('GalleryCtrl', ['$scope', function($scope) {
    $scope.images = [
        {'id': '1', 'desc': 'Die Location von außen'},
        {'id': '2', 'desc': 'Der Blick von der Bar'},
        {'id': '3', 'desc': 'Hardware darf nicht fehlen'},
        {'id': '4', 'desc': 'Bei Bedarf ist die Empore geöffnet'},
        {'id': '5', 'desc': 'Zocken!'},
        {'id': '6', 'desc': 'Durstlöscher'},
        {'id': '7', 'desc': 'Blick in Richtung Bar'},
        {'id': '8', 'desc': 'Wir sehen uns auf der Clanwars'}
    ];
    $scope.totalItems = $scope.images.length;
    $scope.currentPage = 1;
    
    $scope.setPage = function (pageNo) {
        pageNo = parseInt(pageNo);
        if(pageNo == 0) {
            pageNo = $scope.totalItems;
        }
        if(pageNo == $scope.totalItems+1) {
            pageNo = 1;
        }
        $scope.currentPage = pageNo;
    }
}]);

clanwarsApp.controller('RegisterCtrl', ['$scope', '$http', function($scope, $http) {
    $scope.persons = [{'id' : 0}];
    $scope.isRegister = true;
    $scope.noClan = {ID: 0, Name: 'Kein Clan'};
    $scope.clan = angular.copy($scope.noClan);
    $scope.clans = [];
    
    $scope.selectClan = function(clan) {
        $scope.clan = angular.copy(clan);
    }
    
    $scope.addPerson = function() {
        var newPersonNo = $scope.persons.length;
        $scope.persons.push({'id': newPersonNo});
    };
    
    $scope.removePerson = function() {
        var lastPerson = $scope.persons.length-1;
        $scope.persons.splice(lastPerson);
    }
    
    $scope.validate = function() {
        $scope.isRegister = false;
        document.getElementById('Anmeldung').scrollIntoView();
    }
    
    $scope.goBack = function() {
        $scope.isRegister = true;
        document.getElementById('Anmeldung').scrollIntoView();
    }

    $scope.loadClans = function() {
        console.log("load clans");
        $http.get("/backend/clans.php?method=list").then(
            function(response) {
                $scope.clans = response.data;
                console.log("clans loaded");
            }
        );
    }
    
    $scope.fbLogin = function() {
        FB.login(function(response){
            if (response.authResponse) {
                console.log('Welcome!  Fetching your information.... ');

                FB.api('/me',  {fields: 'id,first_name,middle_name,last_name,email,age_range,birthday'}, function(response) {
                    console.log(response);
                    $scope.persons[0].firstname = response.first_name;
                    $scope.persons[0].lastname = response.last_name;
                    $scope.persons[0].email = response.email;
                    console.log("Persons:");
                    console.log($scope.persons[0]);
                });
                
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        });
        // Später hinzufügen
        //}, {scope: 'user_birthday'});
    }
    
    $scope.loadClans();
}]);