<?php session_start();
error_reporting(E_ALL);
require_once('./config/config.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="lan party">
    <meta name="author" content="Multimediale Jugendarbeit Sachsen e.V.">
    
    <title><?php echo EVENT_NAME ?></title>
    
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
    <script src="scripts/angular-animate.min.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body ng-app="clanwarsApp" id="page-top">
    <script>
        // Facebook Init
        window.fbAsyncInit = function() {
            console.log('call FB.init');
            FB.init({
                appId      : '<?php echo FB_APPID; ?>',
                xfbml      : true,
                version    : 'v2.5'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-shrink">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><?php echo EVENT_NAME ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#Info">Infos</a>
                    </li>
                    <li>
                        <a class="page-scroll not-active" href="#Spiele">Spiele</a>
                    </li>
                    <li>
                        <a class="page-scroll not-active" href="#Galerie">Galerie</a>
                    </li>
                    <li>
                        <a class="page-scroll not-active" href="#Preise">Preise</a>
                    </li>
                    <li>
                        <a class="page-scroll not-active" href="#Karte">Karte</a>
                    </li>
                    <li>
                        <a class="page-scroll not-active" href="#Anmeldung">Anmeldung</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-heading">&nbsp;</div>
                <div class="intro-lead-in">
                    <p>&nbsp;</p>
                    <p><small>&nbsp;</small></p>
                </div>
            </div>
        </div>
    </header>
    
    <section id="Info">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo EVENT_NAME ?></h2>
                <h3 class="section-subheading text-muted">Save the date: 28.10. bis 30.10.2016</h3>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-6 col-md-push-3">
                <span class="fa-stack fa-4x">
                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa fa-warning fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="info-heading">Bitte habt noch ein bisschen Geduld.</h4>
                <p class="text-muted">
                    Nicht mehr lang, dann beginnt hier der Vorverkauf für die <?php echo EVENT_NAME ?>.<br >
                    Folgt unserer Seite auf <a href="https://www.facebook.com/multimediajugend/" class="btn btn-xs btn-facebook"><i class="fa fa-facebook"></i> Facebook</a> und Ihr erhaltet sofort Informationen, wenn es losgeht.
                </p>
            </div>
        </div>
    </div>
</section>
        
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
                        <li><a href="#" data-toggle="modal" data-target="#contactModal" data-backdrop="static" data-keyboard="false">Kontakt</a></li>
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
    
    <!-- Custom JavaScript -->
    <script src="scripts/clanwars.js"></script>
</body>
</html>
    