<?php
session_start();
$dir = dirname(__FILE__);
$images = json_decode(file_get_contents($dir . DIRECTORY_SEPARATOR . 'images.json'), true)['slider'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="node_modules/flexslider/flexslider.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <header>
        <div class="container logo-section">
            <div class="logo text-center">
                <a href="index.php">Гостевой дом 'Уютно'</a>
                <div class="slogan-wrap">
                    <p class="slogan"> +38 (067)-400-11-33
                        Одесская область, <br>
                        г. Черноморск (Ильичёвск),
                        Капитанский переулок 7</p>
                </div>
                <div class="blurred"></div>
            </div>        </div>
    </header>
    <section class="container">
        <nav class="navbar navbar-default" role="navigation">
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
                    <li class="active"><a href="index.php">Главная</a></li>
                    <li><a href="about.html">О Нас</a></li>
                    <li><a href="accomodation.html">Номера</a></li>
                    <li><a href="gallery.php">Галерея</a></li>
                    <li><a href="contacts.html">Контакты</a></li>
                    <li class="rent-apart"><a href="apartments.html">Аренда квартир</a></li>

                </ul>
            </div>
        </nav>

        <div class="background-section">
            <div class="border-section">
                <div class="inner-background">
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
                        <p class="col-sm-12 text-center">Гостевой дом "Уютно" место для Вашего отдыха <br></p>
                    </div>
                    <div class="divider clearfix"></div>


                    <div class="services clearfix">
                        <div class="column col-md-6">
                            <h4>Добро пожаловать</h4>

                            <div class="welcome-img img-responsive"></div>
                            <div class="info">
                                <p>Вас приветствует гостевой-дом «Уютно»!
                                    Мини-отель «Уютно» расположен в городе Черноморск (Ильичёвск).
                                    Наш гостевой дом находится в трёх минутах ходьбы от моря. Пляж широкий и песчаный.
                                   </p>
                            </div>
                            <a class="btn read-more" href="about.html">Далее</a>
                        </div>
                        <div class="column col-md-6">
                            <h4>Барбекю</h4>
                            <div class="rest-img img-responsive"></div>
                            <div class="info">
                                <p>На озелененной территории гостевого дома «Уютно»
                                    есть удобные беседки, а также мангал и всё, что нужно для приготовления
                                    шашлыка и барбекю. Безлимитный интернет Wi-Fi
                                </p>
                            </div>
                            <a class="btn read-more" href="about.html">Далее</a>
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
    <script src="node_modules/flexslider/jquery.flexslider-min.js"></script>
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
