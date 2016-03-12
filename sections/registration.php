<section id="Anmeldung" ng-controller="RegisterCtrl">
    <form name="register" id="registerForm" action="" method="post">
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
                <div class="col-md-6 form-group">
                    <label for="firstname">Vorname *</label>
                    <input type="text" ng-model="persons[0].firstname" tabindex="1" class="form-control" placeholder="Max" id="firstname" name="firstname" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="lastname">Nachname *</label>
                    <input type="text" ng-model="persons[0].lastname" tabindex="2" class="form-control" placeholder="Mustermann" id="lastname" name="lastname" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="email">E-Mail-Adresse *</label>
                    <input type="email" ng-model="persons[0].email" tabindex="3" class="form-control" placeholder="max@muster.mail" id="email" name="email" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="birthday">Geburtsdatum *<span class="small">Die Veranstaltung ist ab 16.</span></label>
                    <input type="date" ng-model="persons[0].birthday" tabindex="4" class="form-control" placeholder="1988-05-27" id="birthday" name="birthday" required>
                </div>
            </div>
            <h5 class="section-subheading text-center">Falls du deinen ganzen Clan anmelden willst, kannst du hier weitere Personen hinzufügen.</h5>
            <fieldset ng-repeat="person in persons" ng-if="$index > 0">
                <legend>Person{{$index+1}} <small ng-show="$last"> - <a href="" ng-click="removePerson()">löschen</a></small></legend>
                <div class="row">
                    <div class="col-md-3 col-xs-6 form-group">
                        <label for="personfirstname">Vorname</label>
                        <input type="text" ng-model="person.firstname" tabindex="{{$index*4+2}}" class="form-control" placeholder="Max" name="personfirstname">
                    </div>
                    <div class="col-md-3 col-xs-6 form-group">
                        <label for="personlastname">Nachname</label>
                        <input type="text" ng-model="person.lastname" tabindex="{{$index*4+3}}" class="form-control" placeholder="Mustermann" name="personlastname">
                    </div>
                    <div class="col-md-3 col-xs-6 form-group">
                        <label for="personemail">E-Mail</label>
                        <input type="email" ng-model="person.email" tabindex="{{$index*4+4}}" class="form-control" placeholder="max@muster.mail" name="personemail">
                    </div>
                    <div class="col-md-3 col-xs-6 form-group">
                        <label for="personbirthday">Geburtsdatum</label>
                        <input type="date" ng-model="person.birthday" tabindex="{{$index*4+5}}" class="form-control" placeholder="1970-01-01" name="personbirthday">
                    </div>
                </div>
            </fieldset>
            <div class="row text-center">
                <button type="button" tabindex="5" class="btn btn-sm btn-default" ng-click="addPerson()"><span class="fa fa-plus"></span> Hinzufügen</button>
            </div>
            <br />
            <h4 class="text-center">Hier kannst du einen Clan auswählen</h4>
            <h6 class="text-center" ng-show="persons.length>1">Alle oben aufgeführten Personen werden dem Clan hinzugefügt.</h6>
            <div class="row">
                <div class="col-md-6 col-md-push-3 form-group">
                    <div class="input-group">
                        <input type="text" ng-model="clan.Name" class="form-control" disabled id="clan" placeholder="Kein Clan">
                        <span class="input-group-btn">
                            <button class="btn btn-default" tabindex="{{persons.length*4+2}}" type="button" data-toggle="modal" data-target="#clanModal" ng-click="loadClans()">Clan auswählen</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div id="registerError" class="alert alert-danger" style="display:none;">Da ist etwas schief gelaufen</div>
                <button type="button" tabindex="{{persons.length*4+3}}" class="btn btn-lg btn-primary" ng-click="validate()">Weiter zum Bezahlen</button>
            </div>
        </div>
        <div ng-hide="isRegister" class="container">    
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
                        <td>Ticket für: {{person.firstname}} {{person.lastname}}<small ng-hide="clan==noClan"> (Gruppenkarte)</small></td>
                        <td><span ng-show="clan==noClan">20,00 €</span><span ng-hide="clan==noClan">15,00 €</span></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>Gesamt</td>
                        <td><span ng-show="clan==noClan">{{persons.length*20}},00 €</span><span ng-hide="clan==noClan">{{persons.length*15}},00 €</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="row text-center">
                <div class="col-lg-12">
                    <button class="btn btn-lg btn-default" ng-click="goBack()" type="button"><span class="fa fa-arrow-left"></span> Zurück</button>
                    <button class="btn btn-lg btn-primary" type="button"><span class="fa fa-paypal"></span> Weiter zu PayPal</button>
                </div>
            </div>
        </div>
    </form>
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
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="clanDropDown" data-toggle="dropdown">
                                        {{clan.Name}}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="" ng-click="selectClan(noClan)">{{noClan.Name}}</a></li>
                                        <li ng-repeat="clanItem in clans"><a href="" ng-click="selectClan(clanItem)">{{clanItem.Name}}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="clanPassword">Passwort:</label>
                                <input class="form-control" type="password" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zurück</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Auswählen</button>
                </div>
            </div>
        </div>
    </div>
</section>
