var picker = [];

var createDatePicker = function() {
    var eleGroup = document.querySelectorAll('.date-picker');

    for(var i=0; i<picker.length; i++) {
        picker[i].destroy();
    }
    
    for(var i=0; i<eleGroup.length; i++) {
        var x = eleGroup[i];
        
        picker[i] = new Pikaday({
            field: eleGroup[i],
            format: 'DD.MM.YYYY',
            firstDay: 1,
            maxDate: new Date(2000, 09, 28),
            defaultDate: new Date(1989, 12, 01),
            i18n: {
                previousMonth : 'Vorheriger Monat',
                nextMonth     : 'Nächster Monat',
                months        : ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],
                weekdays      : ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
                weekdaysShort : ['So','Mo','Di','Mi','Do','Fr','Sa']
            }
        });
    }
}

createDatePicker();

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
    
    var hash = window.location.hash.substr(1);
    
    if(hash.toLowerCase() == 'impressum') {
        $('#impressumModal').modal('show');
    }

    // Show Thanks-Modal, if needed
    if(window.location.href.substring(window.location.href.indexOf('#')+1) == 'Danke') {
        console.log('Danke');
        $('#thanksModal').modal('show');
    } 
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

var reloadCaptcha = function() {
    document.getElementById('contactCaptchaImage').src = '/securimage/securimage_show.php?' + Math.random();
    return false;
}

var clanwarsApp = angular.module('clanwarsApp', ['ngAnimate']);

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

clanwarsApp.controller('ContactCtrl', ['$scope', '$timeout', '$http', function($scope, $timeout, $http) {
    $scope.name = '';
    $scope.mail = '';
    $scope.message = '';
    $scope.captcha = '';
    $scope.hidden = null;
    $scope.alert = {type: 'danger', message: '', show: false};
    $scope.sending = false;
    var promise;

    $scope.$on('registerContact', function (event, arg) {
        var persons = arg.persons;
        var clan = arg.clan;

        $scope.name = persons[0].firstname + ' ' + persons[0].lastname;
        $scope.mail = persons[0].email;

        $scope.hidden = JSON.stringify(arg);

        var message = 'Füge hier noch eine Nachricht ein:\r\n\r\n\r\n-----Für eine schnellere Bearbeitung das Nachfolgende bitte stehen lassen-----\r\n';

        for(var i=0; i<persons.length; i++) {
            message += "[Person" + (i+1) + "] Vorname: " + persons[i].firstname + " - Nachname: " + persons[i].lastname + " - E-Mail: " + persons[i].email + " - Geburtstag: " + persons[i].birthday + "\r\n";
        }
        if(clan.id > 0) {
            message += "Clan: " + clan.name + "\r\n";
        }
        $scope.message = message;
    });

    $scope.send = function() {
        if($scope.name === undefined || $scope.name.length == 0) {
            showAlert('danger', 'Bitte gib deinen Namen an.');
            return;
        }
        if($scope.mail === undefined || $scope.mail.length == 0) {
            showAlert('danger', 'Bitte gib deine E-Mail-Adresse an.');
            return;
        }
        if($scope.message === undefined || $scope.message.length == 0) {
            showAlert('danger', 'Bitte gib eine Nachricht ein.');
            return;
        }
        if($scope.captcha === undefined || $scope.captcha.length == 0) {
            showAlert('danger', 'Bitte gib das Captcha ein.');
            return;
        }

        if($scope.sending) {
            return;
        }
        
        $scope.sending = true;
        showAlert('info', 'Deine Nachricht wird gesendet.', true);

        $http({
            method: 'POST',
            url: '/ajax/mail.php?method=contact',
            data: {
                name: $scope.name,
                mail: $scope.mail,
                message : $scope.message,
                hidden: $scope.hidden,
                captcha : $scope.captcha
            }
        }).then(function(response) {
            $scope.sending = false;
            if(response.status == 200) {
                if(response.data.status == 'ok') {
                    $scope.name = '';
                    $scope.mail = '';
                    $scope.message = '';
                    showAlert('success', response.data.message);    
                } else {
                    showAlert('danger', response.data.message);    
                }
            } else {
                showAlert('danger', 'Leider ist ein Problem beim Sender der Nachricht aufgetreten.');
            }
            $scope.captcha = '';
            reloadCaptcha();
        });
    }

    $scope.close = function() {
        clearForm();

        $timeout.cancel(promise);
        $scope.alert.show = false;
    }

    var clearForm = function() {
        $scope.name = '';
        $scope.mail = '';
        $scope.message = '';
    }

    var showAlert = function(type, message, permanent) {
        if(typeof permanent === "undefined") {
            permanent = false;
        }

        $scope.alert.type = type;
        $scope.alert.message = message;
        $scope.alert.show = true;
        
        $timeout.cancel(promise);

        if(!permanent) {
            promise = $timeout(function() {
                $scope.alert.show = false;
            }, 5000);
        }
    }

}]);

clanwarsApp.controller('RegisterCtrl', ['$rootScope', '$scope', '$timeout', '$http', function($rootScope, $scope, $timeout, $http) {
    $scope.singleTicket = 25.84;
    $scope.groupTicket = 20.74;
    $scope.persons = [{'id' : 0, 'birthday': null}];
    $scope.isRegister = true;
    $scope.noClan = {id: 0, name: 'Kein Clan', password: ''};
    $scope.clan = angular.copy($scope.noClan);
    $scope.modalClan = angular.copy($scope.noClan);
    $scope.clans = [];
    $scope.paypal = {link: '', error: '', token: ''};
    
    $scope.resetModalClan = function() {
        $scope.modalClan = angular.copy($scope.noClan);
    }

    $scope.addClan = function() {
        $scope.modalClan.id = -1;
        $scope.modalClan.name = '';
        $scope.modalClan.password = '';
    }
    
    $scope.selectClan = function(clan) {
        $scope.modalClan.id = clan.id;
        $scope.modalClan.name = clan.name;
        $scope.modalClan.password = '';
    }
    
    $scope.test = function() {
        $scope.modalClan = angular.copy($scope.noClan);
    }

    $scope.showContact = function() {
        $rootScope.$broadcast('registerContact', {persons: $scope.persons, clan: $scope.clan});
    }
    
    $scope.checkClan = function() {
        if($scope.modalClan.id == 0) {
            $scope.clan = angular.copy($scope.noClan);
            $('#clanModal').modal('toggle');
        } else if($scope.modalClan.id < 0) {
            if($scope.modalClan.password === undefined || $scope.modalClan.password.length <= 0) {
                $scope.modalInfo = 'Bitte ein Passwort eingeben';
            } else {
                $scope.modalInfo = 'Prüfe, ob Name bereits existiert';
                $http({
                    method: 'POST',
                    url: '/ajax/clan.php?method=checkName',
                    data : {
                        clanName: $scope.modalClan.name
                    }
                }).then(function(response) {
                    if(response.data == 'true') {
                        $scope.clan = angular.copy($scope.modalClan);
                        $scope.modalInfo = '';
                        $('#clanModal').modal('toggle');
                    } else {
                        $scope.modalInfo = 'Der Name existiert bereits';
                    }
                });
            }
        } else {
            $scope.modalInfo = 'Bitte warte einen Moment';

            $http({
                method: 'POST',
                url: '/ajax/clan.php?method=checkPW',
                data: {
                    clanId: $scope.modalClan.id,
                    clanPassword: $scope.modalClan.password
                }
            }).then(function(response) {
                if(response.data == 'true') {
                    $scope.clan = angular.copy($scope.modalClan);
                    $scope.modalInfo = '';
                    $scope.resetModalClan();
                    $('#clanModal').modal('toggle');
                } else {
                    $scope.modalInfo = 'Das Passwort ist nicht korrekt';
                    $scope.clan = angular.copy($scope.noClan);
                }
            });
        }
    }
    
    $scope.addPerson = function() {
        var newPersonNo = $scope.persons.length;
        $scope.persons.push({'id': newPersonNo, 'birthday': null});
        $timeout(function() {
            createDatePicker();
        }, 1);
    };
    
    $scope.removePerson = function() {
        var lastPerson = $scope.persons.length-1;
        $scope.persons.splice(lastPerson);
    }
    
    $scope.validate = function() {
        $scope.isRegister = false;
        document.getElementById('Anmeldung').scrollIntoView();

        $http({
                method: 'POST',
                url: '/ajax/paypal.php?method=prepare',
                data: {
                    persons: JSON.stringify($scope.persons),
                    clan: JSON.stringify($scope.clan)
                }
            }).then(function(response) {
                $scope.paypal.link = '';
                if(response.status == 200) {
                    if(response.data.status == 'ok') {
                        $scope.paypal.link = response.data.url;
                        $scope.paypal.token = response.data.token;
                    } else {
                        $scope.paypal.error = response.data.message;
                    }
                } else {
                    $scope.paypal.error('Es scheint ein Problem mit dem Server zu geben, bitte versuche es später noch einmal.');
                }
            });

    }
    
    $scope.goBack = function() {
        $scope.isRegister = true;
        $scope.paypal.link = '';
        if($scope.paypal.token != '') {
            $http({
                method: 'POST',
                url: '/ajax/paypal.php?method=cancel',
                data: {
                    token: $scope.paypal.token
                }
            });
        }
        document.getElementById('Anmeldung').scrollIntoView();
    }

    $scope.loadClans = function() {
        $scope.resetModalClan();
         
        $http.get("/ajax/clan.php?method=list").then(
            function(response) {
                if(response.status == 200) {
                    $scope.clans = response.data;
                }

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