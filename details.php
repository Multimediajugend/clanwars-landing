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
    
    <title>Clanwars 2016</title>
    
    <!-- FavIcon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/clanwars.css?v=20161024_1330" rel="stylesheet">
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
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-shrink">
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
                    <li  class="active">
                        <a href="//hsf-clanwars.de/#Info">Infos</a>
                    </li>
                    <li>
                        <a href="//hsf-clanwars.de/#Spiele">Spiele</a>
                    </li>
                    <li>
                        <a href="//hsf-clanwars.de/#Galerie">Galerie</a>
                    </li>
                    <li>
                        <a href="//hsf-clanwars.de/#Preise">Preise</a>
                    </li>
                    <li>
                        <a href="//hsf-clanwars.de/#Karte">Karte</a>
                    </li>
                    <li>
                        <a href="//hsf-clanwars.de/#Anmeldung">Anmeldung</a>
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
    <section id="Faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Clanwars 2016</h2>
                    <h3 class="section-subheading text-muted">Die wichtigsten Fragen und Antworten:</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-push-1">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="frageEins">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        Was bedeutet LAN-Party ab 16?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="frageEins">
                                <div class="panel-body">
                                    <p class="text-center"><img src="/img/usk16.png" /></p>
                                    <p class="text-center">
                                        <strong>Wir, als Veranstalter, müssen sicherstellen, dass Teilnehmer unter 18 Jahre keinen Zugang zu jugendgefährdenden Medien erhalten. Das bedeutet, dass Spiele, sowie Medien zu den Spielen, die keine Jugendfreigabe (USK 18) erhalten haben, auf unserer Veranstaltung verboten sind.</strong> 
                                    </p>
                                    <p>
                                        <h5>Ich bin unter 18 Jahre alt.</h5>
                                        Solltest du zu Beginn der Veranstaltung das 18. Lebensjahr noch nicht erreicht haben, musst du einen ausgefüllten <a href="Muttizettel-Clanwars2016.pdf">Muttizettel</a> mitbringen und in Begleitung deines Erziehungsbeauftragten erscheinen.<br>
                                        Der Erziehungsbeauftragte wird von deinen Eltern/Erziehungsberechtigten bestimmt.
                                    </p>
                                    <p>
                                        <h5>Ich bin bereits 18 Jahre oder älter.</h5>
                                        Auch für dich gelten die oben genannten Regeln.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="frageZwei">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        Welche Spiele darf ich also Spielen?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="frageZwei">
                                <div class="panel-body">
                                    <p>
                                        Hier ein paar ausgewählte Spiele, davon dürft ihr die <span class="green"><strong>grün</strong></span> markierten Spiele spielen, die <span class="red"><strong>rot</strong></span> markierten hingegen nicht:
                                    </p>
                                    <ul>
                                        <li><strong>Counter Strike</strong>: <span class="green">1.6</span>, <span class="red">Condition Zero</span>, <span class="green">Source</span>, <span class="green">Global Offensive</span> </li>
                                        <li><strong>Battlefield</strong>: <span class="green">1942</span>, <span class="green">Vietnam</span>, <span class="green">BF 2</span>, <span class="green">2142</span>, <span class="red">BF 3</span>, <span class="red">Hardline</span>, <span class="green">Battlefield 1</span></li>
                                        <li><strong>Call of Duty</strong>: <span class="red">alle Teile</span></li>
                                        <li><strong>MOBA</strong>: <span class="green">LoL</span>, <span class="green">DotA 2</span></li>
                                        <li><strong>Sonstige</strong>: <span class="green">TrackMania</span>, <span class="green">FlatOut 2 (dt. Version)</span>, <span class="green">Blobby Volley</span>, <span class="green">Diablo III</span></li>
                                    </ul>
                                    <p class="text-muted">
                                        Wenn du dir nicht sicher bist, welche Altersfreigabe welches Spiel hat, kannst du auf der Webseite der <a href="http://www.usk.de/titelsuche">USK</a> selbst nachschauen.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="frageDrei">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        Was muss ich alles mitbringen?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="frageDrei">
                                <div class="panel-body">
                                    <ul>
                                        <li>Euren Personalausweis/Führerschein</li>
                                        <li>Wenn ihr noch keine 18 Jahre alt seid, bringt bitte einen ausgefüllten <a href="Muttizettel-Clanwars2016.pdf">Muttizettel</a> mit.</li>
                                        <li>Funktionstüchtiger PC bzw. Laptop</li>
                                        <li>Stromverteiler (Pro Person steht ein Stromanschluss zur Verfügung)</li>
                                        <li>Sonstige Hardware (Maus, Tastatur, Headset)</li>
                                        <li>mindestens 5 Meter Netzwerkkabel<sup>1</sup></li>
                                        <li>Eure Spiele</li>
                                    </ul>
                                    <span class="text-muted">
                                        <sup>1</sup> <small>notfalls könnt ihr bei uns auch Netzwerkkabel ausleihen - solange der Vorrat reicht</small>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="frageVier">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                        Gibt es Schlafmöglichkeiten?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="frageVier">
                                <div class="panel-body">
                                    Ja, es steht ein Schlafbereich zur Verfügung. Wenn ihr lieber in der Nähe eures PC's sein wollt, habt ihr auch da genügend Platz.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="frageFuenf">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                        Gibt es Duschmöglichkeiten?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="frageFuenf">
                                <div class="panel-body">
                                    Nein, leider stehen keine Duschmöglichkeiten bereit.
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="text-center">
                            Wenn ihr noch Fragen habt, schreibt uns über das <a href="#" data-toggle="modal" data-target="#contactModal" data-backdrop="static" data-keyboard="false">Kontaktformular</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="Catering" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    <h2 class="section-heading text-center">Catering</h2>
                    <h3 class="section-subheading text-muted text-center">Hier findet ihr die Cateringpreise für die Clanwars 2016.</h3>
                    <div class="red text-center">Das sind die vorläufigen Preise, die tatsächlichen Preise können von diesen abweichen</div>
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th><h4>Beschreibung</h4></th>
                                <th><h4>Preis</h4></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2"><h5>Getränke</h5></td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Braustolz - 0,5 l</strong><br>
                                    <small>Pils und Radler</small>
                                </td>
                                <td>1,20 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Hasseröder - 0,5 l</strong><br>
                                    <small>Pils</small>
                                </td>
                                <td>1,50 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Köstritzer - 0,5 l</strong><br>
                                    <small>Schwarzbier</small>
                                </td>
                                <td>1,50 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Schöfferhofer o.ä. - 0,5 l</strong><br>
                                    <small>Hefeweizen & alkoholfreies Weizen</small>
                                </td>
                                <td>1,50 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Schöfferhofer Grapefruit - 0,5 l</strong><br>
                                    <small>Weizenbiermixgetränkt mit Grapefruitgeschmack</small>
                                </td>
                                <td>1,25 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Bad Brambacher - 0,5 l</strong><br>
                                    <small>verschiedene Sorten</small>
                                </td>
                                <td>0,50 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Red Bull - 0,25 l</strong><br>
                                    <small>Energy Drink</small>
                                </td>
                                <td>1,25 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Mineralwasser - 0,5 l</strong><br>
                                    <small>medium & spritzig</small>
                                </td>
                                <td>0,25 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Kaffee & Tee</strong><br>
                                    <small>Pfefferminz-, Kräuter- und Früchtetee</small>
                                </td>
                                <td>0,00 €</td>
                            </tr>
                            <tr>
                                <td colspan="2"><h5>Speisen</h5></td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Doppeltoast (Sandwich)</strong><br>
                                    <small>Belegt mit Käse und Salami oder Jagdwurst</small>
                                </td>
                                <td>1,20 €</td>
                            <tr>
                            <tr>
                                <td>
                                    <strong>Clanwars Baguette</strong><br>
                                    <small>Belegt mit Käse, Schinken, Salat, Gurke und Tomate - auch überbacken</small>
                                </td>
                                <td>2,50 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Muffin</strong><br>
                                    <small>natürlich selbst gebacken.</small>
                                </td>
                                <td>1,50 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Mittagessen Samstag</strong><br>
                                    <small>Nudeln mit Hackfleischsoße und Käse</small>
                                </td>
                                <td>2,50 €</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Frühstück Samstag/Sonntag</strong><br>
                                    <small>verschiedene Sorten Müsli, Brötchen mit verschiedenen Aufstrichen</small>
                                </td>
                                <td>1,50 €</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <strong>Freitag- und Samstagabend werden wir Pizza bestellen.</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="Turnierpreise">
        <div class="row">
            <div class="col-md-8 col-md-push-2 col-lg-6 col-lg-push-3 text-center">
                <h2 class="section-heading">Turnierpreise</h2>
                <h3 class="section-subheading text-muted">Was kann ich bei den Turnieren gewinnen?</h3>
                <h4>Sponsored by Fractal Design</h4>
                <div class="row">
                    <div class="col-md-6">
                        <h5>1x Fractal Design Define S Window Black</h5>
                        <img id="fractaldesign01" src="/img/sponsors/fractaldesign/define_s_1.jpg" class="img-responsive" />
                        <p class="text-muted">
                            Das Define S Gehäuse ist mit einer Vielzahl von intelligenten Features ausgestattet und zeichnet sich durch ein großzügiges Raumangebot sowie ein außerordentlich leises Betriebsgeräusch aus. Auch beim Design gibt es keine Kompromisse, so kommt das Define S ebenfalls im eleganten, für die Define Serie typischen, skandinavischen Design.<br>
                            <a href="http://www.fractal-design.com/home/product/cases/define-series/define-s">Mehr Infos bekommt ihr hier</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5>2x Fractal Design Dynamic GP-14 Black/White</h5>
                        <img id="fractaldesign02" src="/img/sponsors/fractaldesign/dynamic_1.jpg" class="img-responsive" />
                        <p class="text-muted">
                            Designt mit führenden technologischen Erkenntnissen, bieten die Dynamic Series Lüfter aerodynamische Elemente, ähnlich dem Design einer Tragfläche mit herausragenden geräuschreduzierenden Elementen zu einem fantastischen Preis-Leistungs-Verhältnis.<br>
                            <a href="http://www.fractal-design.com/home/product/casefans/dynamic-series">Mehr Infos bekommt ihr hier</a>
                        </p>
                    </div>
                </div>
                <h4>Weitere Preise</h4>
                <div class="row">
                    <div class="col-md-6 col-md-push-3">
                        <p>
                            <strong>Natürlich gibt es noch andere Preise, lasst euch einfach überraschen.</strong>
                        </p>
                    </div>
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
   
    <!-- Custom JavaScript -->
    <script>
        $(function() {
            $('#fractaldesign01')
                .mouseover(function() {
                    $(this).attr('src', 'http://local.hsf-clanwars.de/img/sponsors/fractaldesign/define_s_2.jpg');
                })
                .mouseout(function() {
                    $(this).attr('src', 'http://local.hsf-clanwars.de/img/sponsors/fractaldesign/define_s_1.jpg');
                });

            $('#fractaldesign02')
                .mouseover(function() {
                    $(this).attr('src', 'http://local.hsf-clanwars.de/img/sponsors/fractaldesign/dynamic_2.jpg');
                })
                .mouseout(function() {
                    $(this).attr('src', 'http://local.hsf-clanwars.de/img/sponsors/fractaldesign/dynamic_1.jpg');
                });
        });
    </script>
</body>
</html>
    