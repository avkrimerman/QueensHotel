<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/login-style.css"/>
    <title>Login</title>
</head>
<body>
    <div class="wrapper">
        <form class="form-signin">
            <h2 class="form-signin-heading">Login</h2>
            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus />
            <input type="password" class="form-control" name="password" placeholder="Password" required />
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
    </div>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $('.form-signin').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/auth.php',
                method: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status) {
                        window.location = '/upload.php';
                    }
                }
            });
        });
    </script>
</body>
</html>

