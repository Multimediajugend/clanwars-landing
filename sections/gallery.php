<section id="Galerie" ng-controller="GalleryCtrl">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Galerie</h2>
                <h3 class="section-subheading text-muted">Hier kannst du dir schon mal ein Bild machen.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-lg-3"  ng-repeat="image in images">
                <div class="gallery-item">
                    <a ng-href="#" data-toggle="modal" data-target="#imageModal" ng-click="setPage(image.id)">
                        <img ng-src="img/gallery/{{image.id}}.jpg" class="img-responsive" title="{{image.desc}}">
                    </a>
                    <p class="text-muted">{{image.desc}}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" role="document">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                    <h4 class="modal-title">{{images[currentPage-1].desc}}</h4>
                </div>
                <div class="modal-body">
                    <img ng-src="img/gallery/{{currentPage}}.jpg" class="img img-responsive"></img>
                </div>
                <div class="modal-footer">
                    <ul class="pagination">
                        <li><a href="" ng-click="setPage(currentPage-1)"><span class="fa fa-chevron-left"></span></a></li>
                        <li ng-repeat="image in images" ng-class="{ active: $index+1 == currentPage}">
                            <a href="" ng-click="setPage(image.id)" >{{image.id}}</a>
                        </li>
                        <li><a href="" ng-click="setPage(currentPage+1)"><span class="fa fa-chevron-right"></span></a></li>
                    </ul>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>
</section>