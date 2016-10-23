<?php
session_start();
require_once dirname(__FILE__) . "/config/config.php";

$loggedIn = false;
if(isset($_POST['password']) && password_verify($_POST['password'], OVERVIEW_HASH)){
    $loggedIn = true;
    // logged id
    require_once dirname(__FILE__) . "/backend/guestdb.php";
    require_once dirname(__FILE__) . "/backend/clandb.php";
    require_once dirname(__FILE__) . "/backend/paymentdb.php";
    $guestdb = new GuestDB();
    $clandb = new ClanDB();
    $paymentdb = new PaymentDB();
}
?>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Clanwars 2016 - Übersicht</title>
    <!-- FavIcon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Angular.js -->
    <script src="scripts/angular.min.js"></script>
    <script src="scripts/angular-animate.min.js"></script>
</head>
<body id="page-top" class="container">
    <h1>Clanwars 2016 Übersicht</h1>
    <?php
    if(!$loggedIn) {
    ?>
    <form action="anmeldungen.php" class="form-inline" method="post" name="login">
        <input class="form-control" type="password" placeholder="Password" name="password">
        <button type="submit" class="btn btn-primary" ><span class="fa fa-user-secret"></span> Anmelden</button>
    </form>
    <?php
    } else {
    ?>
    <div ng-app="overviewApp" ng-controller="overviewCtrl">
        <h2>Gäste <span class="badge">{{guests.length}}</span></h2>
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th>Nachname</th>
                    <th>Vorname</th>
                    <th>E-Mail</th>
                    <th>Geburtstag</th>
                    <th>Bezahldatum</th>
                    <th>Clan</th>
                    <th>PayPalToken</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="guest in guests">
                    <td>{{guest.Lastname}}</td>
                    <td>{{guest.Firstname}}</td>
                    <td>{{guest.Mail}}</td>
                    <td>{{guest.Birthday}}</td>
                    <td>{{getPayDate(guest.PayPalToken)}}</td>
                    <td>{{getClan(guest.ClanID)}}</td>
                    <td>{{guest.PayPalToken}}</td>
                </tr>
            </tbody>
        </table>

        <h2>Clans <span class="badge">{{clans.length}}</span></h2>
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Erstelldatum</th>
                    <th>Mitglieder</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="clan in clans">
                    <td>{{clan.name}}</td>
                    <td>{{clan.creationtime}}</td>
                    <td>{{getClanMember(clan.id)}}</td>
                </tr>
            </tbody>
        </table>

        <h2>Bezahlvorgänge <span class="badge">{{payments.length}}</span></h2>
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th>PayPalToken</th>
                    <th>Clan</th>
                    <th>Erstelldatum</th>
                    <th>Bezahldatum</th>
                    <th>Personen</th>
                    <th>Bezahldetails</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="payment in payments" ng-click="showPayment($index)">
                    <td>{{payment.Token}}</td>
                    <td>{{getClan(payment.ClanID)}}</td>
                    <td>{{payment.CreationTime}}</td>
                    <td>{{payment.SuccessTime}}</td>
                    <td><span title="{{payment.Persons}}">{{shorten(payment.Persons)}}</span></td>
                    <td><span title="{{payment.SuccessPayment}}">{{shorten(payment.SuccessPayment)}}</span></td>
                </tr>
            </tbody>
        </table>
        <h3>Bezahlvorgang im Detail:</h3>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong class="panel-title">Token</strong></div>
                    <div class="panel-body">{{payments[paymentDetail].Token}}</div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong class="panel-title">Clan</strong></div>
                    <div class="panel-body">{{getClan(payments[paymentDetail].ClanID)}}</div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong class="panel-title">Erstelldatum</strong></div>
                    <div class="panel-body">{{payments[paymentDetail].CreationTime}}</div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong class="panel-title">Bezahldatum</strong></div>
                    <div class="panel-body">{{payments[paymentDetail].SuccessTime}}</div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong class="panel-title">Personen</strong></div>
                    <div class="panel-body">{{payments[paymentDetail].Persons}}</div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong class="panel-title">Bezahldetails</strong></div>
                    <div class="panel-body">{{payments[paymentDetail].SuccessPayment}}</div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <!-- jQuery -->
    <script src="scripts/jquery-2.2.1.min.js"></script>
    <!-- Bootstrap Core Javascript -->
    <script src="scripts/bootstrap.min.js"></script>
    <!-- UI Bootstrap -->
    <script src="scripts/ui-bootstrap-custom-1.3.2.js"></script>    
    <script src="scripts/ui-bootstrap-custom-tpls-1.3.2.js"></script>
    <?php
    if($loggedIn) {
    ?>
    <!-- Custom JavaScript -->
    <script>
        var overviewApp = angular.module('overviewApp', []);
        overviewApp.controller('overviewCtrl', ['$scope', function($scope) {
            $scope.password = '213';
            $scope.guests = <?php echo json_encode($guestdb->listGuests()); ?>;
            $scope.clans = <?php echo json_encode($clandb->listClans()); ?>;
            $scope.payments = <?php echo json_encode($paymentdb->listPayments()); ?>;

            $scope.paymentDetail = 0;

            $scope.shorten = function(input) {
                if(input == null) {
                    return " ";
                }
                str = input.toString();
                if(str.length > 30) {
                    return str.substr(0, 30);
                }
                return input
            }

            $scope.getClan = function(ClanID) {
                if(ClanID == null) {
                    return "kein Clan";
                }
                for(var i=0; i<$scope.clans.length; i++) {
                     if($scope.clans[i].id == ClanID) {
                         return $scope.clans[i].name;
                     }
                }
            }

            $scope.getPayDate = function(Token) {
                if(!Token.startsWith('EC')) {
                    return '--';
                }

                for(var i=0; i<$scope.payments.length; i++) {
                    if($scope.payments[i].Token == Token) {
                        return $scope.payments[i].SuccessTime;
                    }
                }
                return '??';           
            }

            $scope.getClanMember = function(ClanID) {
                var cnt = 0;
                for(var i=0; i<$scope.guests.length; i++) {
                    if($scope.guests[i].ClanID == ClanID) {
                        cnt++;
                    }
                }
                return cnt;
            }

            $scope.showPayment = function(index) {
                $scope.paymentDetail = index;
            }
        }]);
    </script>
    <?php
    }
    ?>
</body>
</html>