<div ng-controller="RegisterCtrl">
    <section id="Anmeldung">
        <form name="register" id="registerForm" action="" method="post" novalidate>
            <div ng-show="isRegister" class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Anmeldung</h2>
                        <h3 class="section-subheading text-muted">Bitte gib hier deine Daten an, wenn du dich zur Clanwars anmelden möchtest.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="button" class="btn btn-lg btn-facebook" ng-click="fbLogin();"><span class="fa fa-facebook-square"></span> Mit Facebook anmelden</button><br>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6 form-group" ng-class="{ 'has-error' : register.firstname.$invalid && !register.firstname.$pristine && register.firstname.$touched }">
                        <label for="firstname">Vorname *</label>
                        <input type="text" ng-model="persons[0].firstname" class="form-control" placeholder="Max" id="firstname" name="firstname" required>
                    </div>
                    <div class="col-md-6 form-group" ng-class="{ 'has-error' : register.lastname.$invalid && !register.lastname.$pristine && register.lastname.$touched }">
                        <label for="lastname">Nachname *</label>
                        <input type="text" ng-model="persons[0].lastname" class="form-control" placeholder="Mustermann" id="lastname" name="lastname" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group" ng-class="{ 'has-error' : register.email.$invalid && !register.email.$pristine && register.email.$touched }">
                        <label for="email">E-Mail-Adresse *</label>
                        <input type="email" ng-model="persons[0].email" class="form-control" placeholder="max@muster.mail" id="email" name="email" required>
                    </div>
                    <div class="col-md-6 form-group" ng-class="{ 'has-error' : register.birthday.$invalid && !register.birthday.$pristine && register.birthday.$touched }">
                        <label for="birthday">Geburtsdatum *<span class="small">Die Veranstaltung ist ab 16.</span></label>
                        <div class="input-group">
                            <p class="input-group-btn">
                                <button type="button" class="btn btn-default" ng-click="birthdayOpen(0)"><span class="fa fa-calendar"></span></button>
                            </p>
                            <input type="text" class="form-control date-picker" placeholder="01.01.1990" ng-model="persons[0].birthday" required>
                        </div>
                    </div>
                </div>
                <h5 class="section-subheading text-center">Falls du deinen ganzen Clan anmelden willst, kannst du hier weitere Personen hinzufügen.</h5>
                <fieldset ng-repeat="person in persons" ng-if="$index > 0" ng-form="personForm">
                    <legend>Person{{$index+1}} <small ng-show="$last"> - <a href="" ng-click="removePerson()">löschen</a></small></legend>
                    <div class="row">
                        <div class="col-md-3 col-xs-6 form-group" ng-class="{ 'has-error' : personForm.firstname.$invalid && !personForm.firstname.$pristine && personForm.firstname.$touched }">
                            <label for="personfirstname">Vorname</label>
                            <input type="text" ng-model="person.firstname" class="form-control" placeholder="Max" name="firstname" required>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group" ng-class="{ 'has-error' : personForm.lastname.$invalid && !personForm.lastname.$pristine && personForm.lastname.$touched }">
                            <label for="personlastname">Nachname</label>
                            <input type="text" ng-model="person.lastname" class="form-control" placeholder="Mustermann" name="lastname" required>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group" ng-class="{ 'has-error' : personForm.email.$invalid && !personForm.email.$pristine && personForm.email.$touched }">
                            <label for="personemail">E-Mail</label>
                            <input type="email" ng-model="person.email" class="form-control" placeholder="max@muster.mail" name="email" required>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group" ng-class="{ 'has-error' : personForm.birthday.$invalid && !personForm.birthday.$pristine && personForm.birthday.$touched }">
                            <label for="personbirthday">Geburtsdatum</label>
                            <div class="input-group">
                                <p class="input-group-btn">
                                    <button type="button" class="btn btn-default" ng-click="birthdayOpen($index)"><span class="fa fa-calendar"></span></button>
                                </p>
                                <input type="text" class="form-control date-picker" ng-model="person.birthday" required>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="row text-center">
                    <button type="button" class="btn btn-sm btn-default" ng-click="addPerson()"><span class="fa fa-plus"></span> Hinzufügen</button>
                </div>
                <br />
                <h4 class="text-center">Hier kannst du einen Clan auswählen</h4>
                <h6 class="text-center" ng-show="persons.length>1">Alle oben aufgeführten Personen werden dem Clan hinzugefügt.</h6>
                <div class="row">
                    <div class="col-md-6 col-md-push-3 form-group">
                        <div class="input-group">
                            <input type="text" ng-model="clan.Name" class="form-control" disabled id="clan" placeholder="Kein Clan">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#clanModal" ng-click="loadClans()">Clan auswählen</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <div id="registerError" class="alert alert-danger" style="display:none;">Da ist etwas schief gelaufen</div>
                    <button type="button" class="btn btn-lg btn-primary" ng-click="validate()" ng-disabled="register.$invalid">Weiter zum Bezahlen</button>
                </div>
            </div>
            <div ng-hide="!isRegister" class="container">    
                <h2 class="text-center">Deine Anmeldedaten noch einmal zusammengefasst:</h2>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Beschreibung</th>
                            <th>Preis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="person in persons">
                            <td>Ticket für: {{person.firstname}} {{person.lastname}} <small>- inkl. PayPal-Gebühren</small> <small ng-hide="clan.ID==noClan.ID"> (Gruppenkarte)</small></td>
                            <td><span ng-show="clan.ID==noClan.ID">{{singleTicket.toString().replace('.',',')}} €</span><span ng-hide="clan.ID==noClan.ID">{{groupTicket.toString().replace('.',',')}} €</span></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td><label>Gesamt</label></td>
                            <td><label><span ng-show="clan.ID==noClan.ID">{{(persons.length*singleTicket).toString().replace('.',',')}} €</span><span ng-hide="clan.ID==noClan.ID">{{(persons.length*groupTicket).toString().replace('.',',')}} €</span></label></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row text-center">
                    <div class="col-lg-12">
                        Bitte beachte die <a href="#" data-toggle="modal" data-target="#agbModal">AGB</a> der Clanwars 2016.
                    </div>
                    <br /><br />
                    <div class="col-lg-12">
                        <button class="btn btn-lg btn-default" ng-click="goBack()" type="button"><span class="fa fa-arrow-left"></span> Zurück</button>
                        <button class="btn btn-lg btn-primary" type="button" ng-disabled="true"><span class="fa fa-paypal"></span> Weiter zu PayPal</button>
                    </div>
                    <br /><br /><br /><br /><br />
                    <div class="col-lg-12">
                        Du hast keinen PayPal-Account?<br />Dann schreibe uns direkt über das <a href="#">Kontaktformular</a> an und wir finden einen Weg, wie du <span ng-hide="persons.length>1">dich</span><span ng-hide="persons.length<=1">euch</span> zur Clanwars 2016 anmelden kannst.<br>
                        <a href="#" data-toggle="modal" ng-click="showContact()" data-target="#contactModal" data-backdrop="static" data-keyboard="false">Kontakt</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <div class="modal fade" id="clanModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" role="document">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                    <h4 class="modal-title">Clan auswählen</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="addClan">
                        </div>
                        <div class="chooseClan">
                            <div class="form-group">
                                <label for="clanDropDown">Clan:</label>
                                <div class="input-group" ng-hide="modalClan.ID >= 0">
                                    <input class="form-control" ng-model="modalClan.Name" id="newClanName"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" ng-click="test()">Zurück</button>
                                    </span>
                                </div>                                
                                <div class="dropdown" ng-show="modalClan.ID >= 0">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="clanDropDown" data-toggle="dropdown">
                                        {{modalClan.Name}}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="" ng-click="selectClan(noClan)">{{noClan.Name}}</a></li>
                                        <li><a href="" ng-click="addClan()">Neuen Clan hinzufügen</a></li>
                                        <li class="divider"></li>
                                        <li ng-repeat="clanItem in clans"><a href="" ng-click="selectClan(clanItem)">{{clanItem.Name}}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="clanPassword">Passwort:</label>
                                <input class="form-control" type="password" ng-model="clanPassword" id="clanPassword" />
                            </div>
                        </div>
                    </form>
                    <div ng-show="modalInfo" class="alert alert-info">
                        {{modalInfo}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Abbrechen</button>
                    <button type="button" class="btn btn-primary" ng-click="checkClan()"><span class="fa fa-save"></span> Auswählen</button>
                </div>
            </div>
        </div>
    </div>
</div>
