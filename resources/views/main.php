<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/3/2018
 * Time: 20:38
 */

?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Question page</title>

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Anton|Permanent+Marker" rel="stylesheet">
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/css/app.css" rel="stylesheet" type="text/css">
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" type="text/javascript"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="error-floater">
                <h4 class="error-message"></h4>
                <p class="error-description"></p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="success-floater">
                <h4 class="success-message"></h4>
                <p class="success-description"></p>
                <p>
                    <i class="fas fa-spinner fa-spin"></i>
                </p>
            </div>
        </div>


        <?php include $response["construct"]["page"].".php"; ?>
    </div>

    <script type="text/javascript">

        function hideError() {
            setTimeout(function () {
                $(".error-floater").fadeOut();
            }, 5000);
        }

        function showError(title, description){

            $(".error-message").html(title);
            $(".error-description").html(description);

            $(".error-floater").fadeIn();

            hideError();
        }


        function hideSuccess() {
            setTimeout(function () {
                $(".error-floater").fadeOut();
            }, 5000);
        }

        function showSuccess(title, description){

            $(".success-message").html(title);
            $(".success-description").html(description);

            $(".success-floater").fadeIn();
        }

    </script>
</body>
</html>