<?php
session_start();
$dir = dirname(__FILE__);
$images = json_decode(file_get_contents($dir . DIRECTORY_SEPARATOR . 'images.json'), true)['slider'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="vendor/flexSlider/flexslider.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <header>
        <div class="container logo-section">
            <div class="logo text-center">
                <a href="index.php">Уютно</a>
                <div class="slogan-wrap">
                    <p class="slogan">гостевой дом</p>
                </div>
                <div class="blurred"></div>
            </div>        </div>
    </header>
    <section class="container">
        <div class="background-section">
            <div class="border-section">
                <div class="inner-background">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="bg-menu-l"><img src="images/navigation/menu-l.png" alt=""/></div>
                        <div class="bg-menu-r"><img src="images/navigation/menu-r.png" alt=""/></div>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse navbar-ex1-collapse text-uppercase">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="accomodation.html">Accomodation</a></li>
                                <li><a href="gallery.php">Gallery</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                            </ul>
                        </div>
                    </nav>

                    <!-- flexslider -->
                    <div class="slider-section">
                        <div id="slider" class="flexslider">
                            <ul class="slides">
                                <?php
                                foreach ($images as $key => $value) {
                                    echo '<li><img src="'.$value.'"/></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <?php
                                foreach ($images as $key => $value) {
                                    echo '<li><img src="'.$value.'"/></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="info-block clearfix">
                        <p class="col-sm-12 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Pellentesque vel mauris a diam convallis dapibus vel eget tortor. Vestibulum ante ipsum
                            primis in faucibus orci luctus.</p>
                    </div>
                    <div class="divider clearfix"></div>


                    <div class="services clearfix">
                        <div class="column col-md-6">
                            <h4>Welcome</h4>

                            <div class="welcome-img img-responsive"></div>
                            <div class="info">
                                <p>Proin justo erat, fermentum sed sagittis in, dignissim quis dolor. Phasellus eget
                                    urna turpis, eu suscipit ipsum. Vestibulum vestibulum enim in ipsum eleifend ac
                                    pretium mauris dignissim.</p>

                                <p>Ut est dolor, tincidunt a vehicula et, varius blandit nulla. Cras quis ante
                                    libero.</p>
                            </div>
                            <a class="btn read-more" href="about.html">Read more</a>
                        </div>
                        <!--<div class="column col-md-4">-->
                            <!--<h4>Our Services</h4>-->

                            <!--<div class="info">-->
                                <!--<p>Maecenas sed nulla nunc. Aenean est dolor, cursus id viverra eget, lobortis vel-->
                                    <!--turpis. Fusce vehicula auctor tortor, sit amet ullamcorper metus condimentum-->
                                    <!--adipiscing.</p>-->
                                <!--<ul class="services-list">-->
                                    <!--<li>Family Getaway</li>-->
                                    <!--<li> Discover Our Destination</li>-->
                                    <!--<li> Just Married</li>-->
                                    <!--<li>Complimentary in-slider Internet access</li>-->
                                    <!--<li>Romantic Getaway</li>-->
                                    <!--<li>Suite Dreams</li>-->
                                    <!--<li>15% Point bonus on each stay</li>-->
                                <!--</ul>-->
                            <!--</div>-->
                            <!--<button type="button" class="btn">Read more</button>-->
                        <!--</div>-->
                        <div class="column col-md-6">
                            <h4>Our Restaurant</h4>
                            <div class="rest-img img-responsive"></div>
                            <div class="info">
                                <p>Sed in quam quis lacus gravida placerat sit amet eu elit. Duis lacus tortor, consectetur
                                    et aliquet vel, consequat ornare tortor.</p>
                                <p>Nam imperdiet fringilla iaculis. Sed sagittis, metus nec mattis molestie, metus est
                                    pretium libero, nec auctor massa enim nec erat. </p>
                            </div>
                            <a class="btn read-more" href="about.html">Read more</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer clearfix">
                <div class="copyright">
                    <p>Copyright © 2012. All Rights Reserved . Theme design by <span>TemplateSquare.com</span></p>
                </div>
            </div>
        </div>
        </div>

    </section>


    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendor/flexSlider/jquery.flexslider-min.js"></script>
    <script>
        $(window).load(function() {
            // The slider being synced must be initialized first
            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 140,
                itemMargin: 12,
                asNavFor: '#slider'
            });

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel"
            });
        });
    </script>
</body>
</html>
