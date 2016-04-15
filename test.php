<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="lan party">
    <meta name="author" content="Multimediale Jugendarbeit Sachsen e.V.">
    
    <title>Clanwars 2016</title>
    
    <!-- FavIcon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/clanwars.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <!-- Angular.js -->
    <script src="scripts/angular.min.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body ng-app="clanwarsApp" id="page-top">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Clanwars 2016</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/#Info">Infos</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/#Spiele">Spiele</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#Galerie">Galerie</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#Preise">Preise</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#Karte">Karte</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#Anmeldung">Anmeldung</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-heading">Clanwars 2016</div>
                <div class="intro-lead-in">
                    <p>Die Community-Party in Sachsen</p>
                    <p><small>vom 28.10. bis 30.10.2016</small></p>
                </div>
                <a href="#Info" class="page-scroll btn btn-primary btn-lg">Mehr Infos</a>
            </div>
        </div>
    </header>
    
    <section id="Test" ng-controller="TestCtrl">
        <div class="container">
            DatePicker:
            <div class="input-group">
                <p class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-click="birthdayOpen()"><span class="fa fa-calendar"></span></button>
                </p>
                <input type="text" class="form-control" uib-datepicker-popup="{{dateFormat}}" false ng-model="birthday" is-open="birthdayPopup.opened" datepicker-options="dateOptions" datepicker-popup-template-url="/template/datepicker.html" ng-click="birthdayOpen()" placeholder="28.10.2000" required>
            </div>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        </div>
    </section>
    <div>
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a href="https://www.multimediajugend.de/">
                            <img src="img/mjslogo.png"><br>
                            <span class="small">www.multimediajugend.de</span>    
                        </a>                    
                    </div>
                    <div class="col-md-6">
                        <?php
                            $footerDate = "2016";
                            if(date("Y") > 2016) {
                                $footerDate = $footerDate."-".date("Y");
                            }
                        ?>
                        <span class="copyright small">&copy; Multimediale Jugendarbeit Sachsen e.V. <?php echo $footerDate ?></span><br />
                        <a href="https://www.speicherzentrum.de/"><img src="img/speicherzentrum.jpg"></a>                    
                    </div>
                    <div class="col-md-3">
                        <ul class="quicklinks">
                            <li><a href="#" data-toggle="modal" data-target="#impressumModal">Impressum</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#agbModal">AGB</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#contactModal">Kontakt</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Impressum Modal -->
        <?php include("./modals/impressum.php"); ?>
        
        <!-- AGB Modal -->
        <?php include("./modals/agb.php"); ?>
        
        <!-- Kontakt Modal -->
        <?php include("./modals/contact.php"); ?>
        
        <!-- jQuery -->
        <script src="scripts/jquery-2.2.1.min.js"></script>
        <!-- Bootstrap Core Javascript -->
        <script src="scripts/bootstrap.min.js"></script>
        <!-- UI Bootstrap -->
        <script src="scripts/ui-bootstrap-custom-1.3.2.js"></script>    
        <script src="scripts/ui-bootstrap-custom-tpls-1.3.2.js"></script>    
        <!-- Plugin JavaScript -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="scripts/classie.js"></script>
        <script src="scripts/cbpAnimatedHeader.js"></script>
    </div>
    <!-- Custom JavaScript -->
    <!--<script src="scripts/clanwars.js"></script>-->
    <script type="text/javascript">
        var clanwarsApp = angular.module('clanwarsApp', ['ui.bootstrap']);
        
        clanwarsApp.controller('TestCtrl', ['$scope', function($scope) {
            $scope.dateFormat = 'dd.MM.yyyy';
            $scope.birthday = null;
            
            $scope.dateOptions = {
                showWeeks: false,
                clearText: 'test',
                datepickerMode: 'year',
                maxDate: new Date(2000, 10, 28),
                yearRange: "c-50:c-10"
            }
            
            $scope.birthdayPopup = {
                opened: false
            }
            
            $scope.birthdayOpen = function() {
                $scope.birthdayPopup.opened = true;
            }
        }]);
    </script>
</body>
</html>