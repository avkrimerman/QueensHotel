<?php
session_start();

if (!$_SESSION['username'])
{
    if ($_SERVER['HTTP_X_REQUESTED_WITH'])
    {
        echo json_encode(['status' => false, 'msg' => 'Not Authorized']);
        exit();
    }
    else
    {
        $location = $_SERVER['HTTP_HOST'];
        header("Location: http://{$location}/");
        exit();
    }

}

$dir = dirname(__FILE__);

$allImages = [];
$folder = $dir . DIRECTORY_SEPARATOR . 'upload-files';

if ($handle = opendir($folder)) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            $allImages[] = '/upload-files/' . $entry;
        }
    }

    closedir($handle);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //Get the temp file path
    $tmpFilePath = $_FILES['file_data']['tmp_name'];
    //Make sure we have a filepath
    if ($tmpFilePath != "")
    {
        if (!is_dir($dir . DIRECTORY_SEPARATOR . 'upload-files'))
        {
            mkdir($dir . DIRECTORY_SEPARATOR . 'upload-files');
        }

        //Setup our new file path
        $newFilePath = $dir . DIRECTORY_SEPARATOR . 'upload-files' . DIRECTORY_SEPARATOR . $_FILES['file_data']['name'];
        //Upload the file into the temp dir
        move_uploaded_file($tmpFilePath, $newFilePath);
        echo json_encode(['status' => true]);
        exit();
    }
}

$images = json_decode(file_get_contents($dir . DIRECTORY_SEPARATOR . 'images.json'), true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="node_modules/bootstrap-fileinput/css/fileinput.min.css"/>
    <link href="node_modules/lightbox2/dist/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login-style.css"/>

    <title></title>
</head>
<body>
<nav>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Гостевой дом "Уютно"</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Изображения</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" id="logout">Выйти</a></li>
                </ul>
            </div>
        </div>
    </nav>
</nav>

<div class="container">
    <div class="form-group col-sm-12">
        <input id="file" class="file" type="file" multiple data-preview-file-type="any" data-upload-url="/upload.php">
    </div>
</div>
<div class="container">
    <div class="divider"></div>
</div>
<div class="container slider">
    <h3 class="text-center">Slider</h3>
    <div class="row">

        <?php 
        
        foreach ($images['slider'] as $key => $value) 
        {
            echo '<div class="col-sm-4 thumbnail">'.
                '<img src="'.$value.'" alt=""/>'.
                '<div class="btn-remove" data-src="'.$value.'" data-type="slider">'.
                    '<i class="glyphicon glyphicon-remove"></i>'.
                '</div>'.
            '</div>'; 
        }
        
        ?>

        <div class="col-sm-4 text-center add-img" data-type="slider">
            <div class="thumbnail">
                <i class="glyphicon glyphicon-plus"></i>
            </div>
        </div>

    </div>
</div>
<div class="container">
    <div class="divider"></div>
</div>

<div class="container gallery">
    <h3 class="text-center">Gallery</h3>
    <div class="row">
    
    <?php
    
    foreach ($images['gallery'] as $key => $value)
    {
        echo '<div class="col-sm-4">'.
            '<a href="'.$value.'" class="gallery-link thumbnail" data-lightbox="gallery-image">'.
                '<img src="'.$value.'" alt=""/>'.
            '</a>'.
            '<div class="btn-remove" data-src="'.$value.'" data-type="gallery">'.
                '<i class="glyphicon glyphicon-remove"></i>'.
            '</div>'.
        '</div>';
    }
    ?>

        <div class="col-sm-4 text-center add-img" data-type="gallery">
            <div class="thumbnail">
                <i class="glyphicon glyphicon-plus"></i>
            </div>
        </div>
    </div>
</div>

<!--<div class="container">-->
<!--    <div class="divider"></div>-->
<!--</div>-->
<!--<div class="container all-images">-->
<!--    <h3 class="text-center">All images</h3>-->
<!--    <div class="row">-->
<!---->
<!--        --><?php
//
//        foreach ($allImages as $key => $value)
//        {
//            echo '<div class="col-sm-4 thumbnail">'.
//                '<img src="'.$value.'" alt=""/>'.
//                '<div class="btn-remove" data-src="'.$value.'" data-type="all">'.
//                '<i class="glyphicon glyphicon-remove"></i>'.
//                '</div>'.
//                '</div>';
//        }
//
//        ?>
<!--    </div>-->
<!--</div>-->

<div class="modal" id="associate-images" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Attach images</h4>
            </div>
            <div class="modal-body">
                <div class="row"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="associate-save" class="btn btn-primary">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/bootstrap-fileinput/js/fileinput.min.js"></script>
<script src="node_modules/lightbox2/dist/js/lightbox.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    });
    
    $('.btn-remove').on('click', function() {
        var self = $(this);
        $.ajax({
            method: 'post',
            url: '/image-remove.php',
            data: {
                src: self.data('src'),
                type: self.data('type')
            },
            dataType: 'json',
            success: function() {
                self.parent().remove();
            }
        });
    });

    $('.add-img').on('click', function() {
        var self = $(this);
        $.ajax({
            method: 'get',
            url: '/image-list.php',
            dataType: 'json',
            success: function(response) {
                var template = '<div class="col-sm-4 preview"><img src="$src" alt="" /></div>';
                var type = self.data('type');
                var $modal = $('#associate-images');
                var $modalBody = $modal.find('.modal-body .row');

                $modalBody.empty();

                for (var i = 0; i < response.length; i ++) {
                    var image = response[i];
                    $modalBody.append(template.replace('$src', image));
                }
                $('#associate-save').data('type', type);
                $modal.modal('show');
            }
        });
    });

    $('#associate-images').on('click', '.preview', function() {
        $(this).toggleClass('choose');
    });

    $('#associate-save').on('click', function() {
        var imageSrc = [];
        
        $('#associate-images .choose img').each(function() {
            imageSrc.push($(this).prop('src'));
        });
        
        var type = $('#associate-save').data('type');
        
        $.ajax({
            method: 'post',
            url: '/image-associate.php',
            dataType: 'json',
            data: {src: imageSrc, type: type},
            success: function(resp) {
                if (! resp.status) return;
                window.location.reload();
            }
        });
    });

    $('#logout').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            method: 'get',
            url: '/logout.php',
            dataType: 'json',
            success: function() {
                window.location = '/';
            }
        });
    });
</script>

</body>
</html>
