<div class="modal modal-contact fade" id="contactModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" role="document" ng-controller="ContactCtrl">
            <form name="form" novalidate>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" ng-disabled="sending"><span class="fa fa-close"></span></button>
                    <h4 class="modal-title">Kontakt</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="contactName">Name *</label>
                            <input type="text" class="form-control" ng-model="name" ng-disabled="sending" placeholder="Max Muster" id="contactName" name="contactName" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="contactMail">E-Mail *</label>
                            <input type="email" class="form-control" ng-model="mail" ng-disabled="sending" placeholder="max@muster.mail" id="contactMail" name="contactMail" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label for="contactMessage">Nachricht *</label>
                            <textarea type="text" rows="10" ng-model="message" ng-disabled="sending" class="form-control" placeholder="Nachricht" id="contactMessage" name="contactMessage" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-push-3 col-md-3 captchaContainer">
                            <img src="../securimage/securimage_show.php" height="59px" width="153px" id="contactCaptchaImage"></img>
                            <button class="btn btn-default" onclick="reloadCaptcha()" ng-disabled="sending"><span class="fa fa-refresh"></span></button>
                        </div>
                        <div class="col-md-push-3 col-md-3">
                            <label for="contactCaptcha">Captcha *</label><br>
                            <input type="text" class="form-control" ng-model="captcha" ng-disabled="sending" placeholder="Captcha" id="contactCaptcha" name="contactCaptcha" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alert" ng-class="'alert-'+alert.type" role="alert" ng-show="alert.show">{{alert.message}}</div>
                    <button type="button" class="btn btn-default" ng-click="close()" ng-disabled="sending" data-dismiss="modal"><span class="fa fa-arrow-left"></span> Zurück</button>
                    <submit type="submit" class="btn btn-primary" ng-click="send()" ng-disabled="sending"><span class="fa fa-send"></span> Senden</button>
                </div>
            </form>
        </div>
    </div>
</div>