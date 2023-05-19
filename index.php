<?php session_start();
if ($_SESSION['auth'] == true) {
    header('Location:profile.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <style>
        body {
            background-image: url("https://as2.ftcdn.net/v2/jpg/03/21/75/83/1000_F_321758393_48lRqzu7XGW3l8JlOkdqHciFk8BHXB2S.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class='container d-flex align-items-center justify-content-center flex-column' style="height: 100vh;">
        <div style="background-color:darkgrey; padding:15px; border: 2px #fff solid; border-radius: 30px;">
            <div class='bg'>
                <h1 class="text-center">
                    PHP ToDo
                </h1>
            </div>
            <div>
                <p class='bg-danger text-center error' style='border-radius:5px; color:#fff;'></p>
            </div>
            <form method="POST">
                <div>
                    <p class='text-center mt-3'>Chat ID</p>
                    <input type="text" id="chat_id" name='chat_id' class="form-control" aria-labelledby="passwordHelpBlock">
                </div>
                <div>
                    <p class='text-center'>Password</p>
                    <input type="password" id="password" name='password' class="form-control" aria-labelledby="passwordHelpBlock">
                </div>
                <div class="text-center">
                    <button type="submit" class='btn btn-success mt-3 '>Log in</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <p>Visit this page to get your chat id and set a password:</p>
                <a href="https://t.me/test_php_weather_bot" class="btn btn-warning">Click me!</a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '/auth.php',
                    data: formData,

                    success: function(data) {
                        let resp = JSON.parse(data);
                        if (resp.status == 1 || resp.status == 2) {
                            $('.error').html(resp.message);
                        } else if (resp.status == 0) {
                            window.location.href = '/profile.php';
                        }


                    }
                })
            })
        })
    </script>
</body>


</html>