<?php
session_start();

require 'connect_db.php';

function calculate_wilks($bodyweight, $total) {
    $a=-216.0475144;
    $b=16.2606339;
    $c=-0.002388645;
    $d=-0.00113732;
    $e=7.01863E-06;
    $f=-1.291E-08;

    $numerator = 500;
    $denominator = $a + $b*$bodyweight + $c*$bodyweight*$bodyweight + $d*$bodyweight*$bodyweight*$bodyweight + $e*$bodyweight*$bodyweight*$bodyweight*$bodyweight + $f*$bodyweight*$bodyweight*$bodyweight*$bodyweight*$bodyweight;

    $coef = $numerator/$denominator;

    $wilks = $total * $coef;

    return $wilks;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Shopping Cart</title>
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

            });
        </script>

        <style>
            body {
                
                background-color: black;

            }

        </style>


    </head>

    <body>

        <?php require 'navbar.php'; ?> 

        <div class="container">
            <div class="row"> 

                <div class="well col-xs-12 col-md-6 col-md-offset-3"> 
                    <h1 class="Almedra text-center">
                        Wilks Score Calculator
                    </h1>
                </div>

                <div class="well col-xs-12 col-md-6 col-md-offset-3"> 
                    <form action="wilks.php" method="post">
                        <div class="form-group">
                            <label for="bodyweight">Bodyweight:</label>
                            <input type="text" class="form-control" name="bodyweight" id="bodyweight">
                        </div>
                        <div class="form-group">
                            <label for="squat">Squat One Rep Max:</label>
                            <input type="text" class="form-control" name="squat" id="squat">
                        </div>
                        <div class="form-group">
                            <label for="bench">Bench One Rep Max:</label>
                            <input type="text" class="form-control" name="bench" id="bench">
                        </div>
                        <div class="form-group">
                            <label for="deadlift">Deadlift One Rep Max:</label>
                            <input type="text" class="form-control" name="deadlift" id="deadlift">
                        </div>
                        <div class="form-group">
                            <label class="radio-inline">
                                <input type="radio" name="optradio" value="pounds" checked="checked"> Pounds
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio" value="kilos"> Kilos
                            </label>
                        </div>
                        <button type="submit" name="btnSub" class="btn btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <?php

        if (isset($_POST['btnSub'])) {

            $bodyweight;
            $total;

            if ($_POST['optradio'] == 'pounds') {
                $bodyweight= $_POST['bodyweight'] / 2.2 ;
                $total = $_POST['squat'] + $_POST['bench'] + $_POST['deadlift'];
                $total = $total / 2.2;
            } else {
                $bodyweight= $_POST['bodyweight'];
                $total = $_POST['squat'] + $_POST['bench'] + $_POST['deadlift'];
            }

            $answer = calculate_wilks($bodyweight, $total);
            $answer = round($answer,0);
            echo '<div class="well col-xs-12 col-md-4 col-md-offset-4"> <h1 class="Almedra text-center"> Wilks Score: '.$answer.
                '</h1> </div>';
        }



        ?>

    </body>
</html>