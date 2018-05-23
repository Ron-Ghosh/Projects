<?php

session_start();

require 'connect_db.php';

function validate($param) {
    $param = htmlspecialchars($param);
    $param = trim($param);
    $param = stripslashes($param);
    return $param;
}

if (isset($_POST['btnRegister'])) {

    $username = validate($_POST['username']);

    $sql = 'SELECT USERNAME FROM users WHERE USERNAME="'.$username.'"';
    $sql_query_result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($sql_query_result) < 1) { // If there are no results 

        $pass1 = validate($_POST['pwd']);
        $pass2 = validate($_POST['pwd_confirm']);

        if ($pass1 == $pass2) { // Making sure that they entered the correct password
            $sql = "Insert into USERS (USERNAME, PASSWORD) VALUES ('".$username."', '".$pass1."')";
            if (mysqli_query($conn, $sql)) {
                /* $last_id = */ mysqli_insert_id($conn); // Automatically inserts a new ID
                // echo 'New record created successfully. Last inserted ID is: '.$last_id;
            } else {
                echo 'Error: '.$sql.' <br> '.mysqli_error($conn);
            }
        } else {
            echo '<div class="well text-center"> Passwords do not match </div>';
        } 
    } else {
        echo '<div class="well text-center"> This username already exists </div>';
    } 
}

if (isset($_POST['btnLogin'])) {
    $username = validate($_POST['login_username']);
    $password = validate($_POST['login_pwd']);

    $sql = 'SELECT USERNAME FROM users WHERE USERNAME="'.$username.'"';
    $sql_query_result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($sql_query_result) == 1) {
        $sql = 'SELECT PASSWORD FROM users WHERE USERNAME="'.$username.'"';
        $sql_query_result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($sql_query_result);

        if ($row['PASSWORD'] == $password) {
            
            $_SESSION['username'] = $username;
            
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'store.php';
            
            header("Location: http://$host$uri/$extra");
        } else {
            echo '<div class="well text-center"> You entered the wrong password </div>';
        }

    } else {
        echo '<div class="well text-center"> No match found </div>';
    }

}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcome</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="icon" href="https://d30y9cdsu7xlg0.cloudfront.net/png/61493-200.png">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function(){
                $("#frmRegister").hide();
                $("#frmLogin").hide();

                $("#register").click(function() {
                    $("#frmRegister").slideToggle();
                });

                $("#login").click(function() {
                    $("#frmLogin").slideToggle();
                });
                
                //$('[data-toggle="popover"]').popover(); 
                $("#pop_one").popover(); 

            });

        </script>

        <style>
            #carousel {
                border: 10px solid white;
            }

            .well-border {
                border: 10px solid black;
            }

            #mainBody {
               background-color: black;
            }

        </style>


    </head>

    <body id="mainBody">

        <div class="container">

            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Analytic Twitch</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li id="register"><a href="#"><span class="glyphicon glyphicon-user"></span> Register </a></li>
                        <li id="login"><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login </a></li>
                    </ul>
                </div>
            </nav>

            <div class="row" id="frmRegister">
                <div class="well well-border col-md-4 col-md-offset-4">
                    <form action="login.php" method="post">
                        <h3 class="text-center"> REGISTER </h3>
                        <br>
                        <div class="form-group" id="pop_one" data-toggle="popover" data-trigger="hover" data-content="Pick a unique name" data-placement="top">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" name="pwd" id="pwd">
                        </div>
                        <div class="form-group">
                            <label for="pwd_confirm">Confirm Password:</label>
                            <input type="password" class="form-control" name="pwd_confirm" id="pwd_confirm">
                        </div>
                        <button type="submit" class="btn btn-danger btn-block" name="btnRegister">Submit</button>
                    </form>
                </div>
            </div>

            <div class="row" id="frmLogin">
                <div class="well well-border col-md-4 col-md-offset-4">
                    <form action="login.php" method="post">
                        <h3 class="text-center"> LOGIN </h3>
                        <br>
                        <!-- Username (with a popover) -->
                        <div class="form-group">
                            <label for="login_username">Username:</label>
                            <input type="text" class="form-control" name="login_username" id="login_username">
                        </div>
                        
                        <div class="form-group">
                            <label for="login_pwd">Password:</label>
                            <input type="password" class="form-control" name="login_pwd" id="login_pwd">
                        </div>
                        <button type="submit" class="btn btn-danger btn-block" name="btnLogin">Submit</button>
                    </form>
                </div>
            </div>

            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div id="carousel" class="carousel-inner">

                    <div class="item active">
                        <img src="Images/login_pic_1.jpg" alt="one" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="Images/login_pic_2.jpg" alt="two" style="width:100%;">
                    </div>

                    <div class="item">
                        <img src="Images/Login_pic_3.jpg" alt="three" style="width:100%;">
                    </div>
                    
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Prev</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
        <br>
    </body>
</html>