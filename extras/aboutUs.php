<!DOCTYPE html>
<html lang="en">
    <?php
    include '../components/header.php';
    ?>
    <body>
        <div id="content">
            <?php
            include '../components/navbar.php';
            ?>
            <div id="aboutBox" class="container col-10 pt-5">
                <div class="h2 pacifico text-warning text-center  mb-5">
                    Our LCD-Shopology Team
                </div> 
                <div class="row justify-content-around">
                    <div class="card col-xl-3 col-lg-5 col-md-10 col-sm-10 col-xs-10 mb-3 d-flex alight-items-stretch">
                        <img class="card-img-top mt-3" src="../img/lisa.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h3 class="text-center pacifico text-warning pb-3">Lisa</h3>
                            <h5 class="pacifico"><strong>Project Manager</strong></h5>
                            <p class="card-text">Always making sure our team and projects are running successfully & smoothly.</p>
                            <h6>In charge of :</h6>
                            <p class="card-text">User Crud, Map API, Reviews, Search Bar</p>
                            <h6>Get in touch :</h6>
                            <a href="mailto:scelli.lisa@gmail.com" class="card-text">scelli.lisa@gmail.com</a>
                        </div>
                    </div>

                    <div class="card col-xl-3 col-lg-5 col-md-10 col-sm-10 col-xs-10 mb-3 d-flex alight-items-stretch">
                        <img class="card-img-top mt-3" src="../img/chris.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h3 class="text-center pacifico text-warning pb-3">Chris</h3>
                            <h5 class="pacifico"><strong>Customer Support & Design</strong></h5>
                            <p class="card-text">Staying in contact with our customer's, ensuring they're requests are fulfilled & styling our website</p>
                            <h6>In charge of :</h6>
                            <p class="card-text">Product Crud, Discounts, Styling</p>
                            <h6>Get in touch :</h6>
                            <a href="mailto:christinarenieris@gmail.com" class="card-text">christinarenieris@gmail.com</a>
                        </div>
                    </div>

                    <div class="card col-xl-3 col-lg-5 col-md-10 col-sm-10 col-xs-10 mb-3 d-flex alight-items-stretch">
                        <img class="card-img-top mt-3" src="../img/david.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h3 class="text-center pacifico text-warning pb-3">David</h3>
                            <h5 class="pacifico"><strong>Lead Developer</strong></h5>
                            <p class="card-text">Leading our developer team, establishing our website functionality is TOP.</p>
                            <h6>In charge of :</h6>
                            <p class="card-text">Wishlist, Cart, Slider, Sorting</p>
                            <h6>Get in touch :</h6>
                            <a href="mailto:david.jaroska@gmail.com" class="card-text">david.jaroska@gmail.com</a>                        
                        </div>
                    </div> 
                </div>
                <div class="container">
                    <div class="h2 pacifico text-warning text-center  mt-5 mb-5">
                        Our Store Location
                    </div>
                    <p class="text-center">Riesenradplatz 1,<br> 1020 Vienna,<br> Austria</p>
                    
                    <div id="map" data-X='48.217717' data-Y='16.396677' class='w-80 map'>

                    </div>
                </div>
            </div>
        </div>
        <?php
        include '../components/footer.php';
        ?>

        <script>
            var map;
            function initMap() {
                let map = document.getElementById('map');
                var city = {
                    lat: parseFloat(map.dataset.x),
                    lng: parseFloat(map.dataset.y)
                };
                map = new google.maps.Map(map, {
                    center: city,
                    zoom: 8
                });
                var pinpoint = new google.maps.Marker({
                    position: city,
                    map: map
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtjaD-saUZQ47PbxigOg25cvuO6_SuX3M&callback=initMap" async defer></script>
    </body>
</html>
