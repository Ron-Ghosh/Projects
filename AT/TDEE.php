<?php
session_start();

require 'connect_db.php';

function echo_list($last_val) {
    for ($i = 1 ; $i <= $last_val ; $i++) {
        echo '<option>'.$i.'</option>';
    }
}

function echo_age_list($last_val) {
    for ($i = 1 ; $i <= $last_val ; $i++) {
        echo '<option value="'.$i.'">'.$i.'</option>';
    }
}

function convert_height($int_param){
    $feet_raw = $int_param / 12;
    $feet = floor($feet_raw);
    $inches = $int_param % 12;
    $height_string = $feet.'ft '.$inches.'in';
    return $height_string;
}

function echo_height_list(){
    for ($i = 48 ; $i <= 96 ; $i++) {
        echo '<option value ="'.$i.'">'.convert_height($i).'</option>';
    }
}

function convert_lb_to_kg($weight) {
    return 0.453592 * $weight;
}

function convert_in_to_cm($height) {
    return 2.54 * $height;
}

function female_TDEE($weight, $height, $age, $activity) {
    $weight = convert_lb_to_kg($weight);
    $height = convert_in_to_cm($height);
    $TDEE = (655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age)) * $activity;
    return round($TDEE); 
}

function male_TDEE($weight, $height, $age, $activity) {
    $weight = convert_lb_to_kg($weight);
    $height = convert_in_to_cm($height);
    $TDEE = (66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age)) * $activity;
    return round($TDEE);
}

function open_well() {
    return '<div class="container">
            <div class="row">
                <div class="well col-md-6 col-md-offset-3">';
}

function close_well() {
    return '</div> </div> </div>';
}


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TDEE Calculator</title>
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

        <?php require 'navbar.php' ?>


        <!-- Calculator -->
        <div class="container">
            <div class="row">
                <div class="well col-md-6 col-md-offset-3">
                    <h1 class="text-center">TDEE Calculator</h1>
                    <form action="TDEE.php" method="post">
                        <br>
                        <div class="text-center">
                            <p> <strong>Gender:</strong></p>
                            <label class="radio-inline"><input type="radio" name="optradio" value="male" checked> Male </label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="female"> Female </label> 
                            <br><br>
                        </div>
                        <div class="form-group">
                            <label for="AgeList">Age:</label> 
                            <select class="form-control" id="AgeList" name="age">
                                <?php echo_age_list(99); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="body_weight">Weight (lbs):</label>
                            <input type="text" class="form-control" id="body_weight" name="weight">
                        </div>
                        <div class="form-group">
                            <label for="HeightList">Height:</label> 
                            <select class="form-control" id="HeightList" name="height">
                                <?php echo_height_list(); ?> 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="activity_options">Activity:</label> 
                            <select class="form-control" id="activity_options" name="activity">
                                <option value="1.2" selected>Sedentary (office job)</option>
                                <option value="1.375">Light Exercise (1-2 days/week)</option>
                                <option value="1.55">Moderate Exercise (3-5 days/week)</option>
                                <option value="1.725">Heavy Exercise (6-7 days/week)</option>
                                <option value="1.9">Athlete (2x per day) </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary" name ="btnSubmitTDEE">CALCULATE</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End of Calculator -->



        <?php 

        if (isset($_POST['btnSubmitTDEE'])) {
            if (is_numeric($_POST['weight'])) {
                if (isset($_POST['optradio'])) {
                    if ($_POST['optradio'] == 'female') {
                        $total = '<h3 class ="text-center"> Your TDEE is: '.female_TDEE($_POST['weight'], $_POST['height'], $_POST['age'], $_POST['activity']).'</h3>';
                        $open = open_well();
                        $close = close_well();
                        echo $open.$total.$close;
                    } else {
                        $total = '<h3 class ="text-center"> Your TDEE is: '.female_TDEE($_POST['weight'], $_POST['height'], $_POST['age'], $_POST['activity']).'</h3>';
                        $open = open_well();
                        $close = close_well();
                        echo $open.$total.$close;
                    }
                }
            } else {
                $open = open_well();
                $close = close_well();
                $message = '<h3 class ="text-center">  Please enter a number </h3>';
                echo $open.$message.$close;  
            }

        }
        ?>

    </body>
</html>