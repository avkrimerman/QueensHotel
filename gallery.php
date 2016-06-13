<?php
$dir = dirname(__FILE__);
$images = json_decode(file_get_contents($dir . DIRECTORY_SEPARATOR . 'images.json'), true)['gallery'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css"/>
    <link href="vendor/lightbox/lightbox.min.css" rel="stylesheet">
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
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="accomodation.html">Accomodation</a></li>
                                <li class="active"><a href="gallery.php">Gallery</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                            </ul>
                        </div>
                    </nav>
                    <section class="gallery">
                        <div class="row">
                            <?php
                            foreach ($images as $key => $value) {
                                echo '<div class="col-sm-4 gallery-item">'.
                                    '<a href="'.$value.'" class="gallery-link" data-lightbox="gallery-image">'.
                                    '<img src="'.$value.'" alt=""/>'.
                                    '</a>'.
                                    '</div>';
                            }
                            ?>
                        </div>
                    </section>
                    <div class="footer clearfix">
                        <div class="copyright">
                            <p>Copyright © 2012. All Rights Reserved . Theme design by <span>TemplateSquare.com</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendor/lightbox/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>
</body>
</html>
