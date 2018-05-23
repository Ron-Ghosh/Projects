<?php
session_start();

require 'connect_db.php';

$search_term = strtoupper($_POST['foodSearch']);

$search_term = trim($search_term);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Foods</title>
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


        <div class="container well">
            <h2 class="text-center">USDA FOOD DATABASE</h2> <br>
            <form action="food_db_search.php" method="post">
                <div class="col-xs-4 col-xs-offset-4">
                    <br>
                    <div class="text-center">
                        <label for="foodSearch">SEARCH FOR A FOOD:</label>
                    </div>
                    <input type="text" class="form-control" name="foodSearch" id="foodSearch"> <br>
                    <button type="submit" class="btn btn-default btn-block" name="btnRegister">Submit</button> <br>
                </div> <br> <br>
            </form>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="50%">DESCRIPTION</th>
                        <th width="10%">CALORIES</th>
                        <th width="10%">PROTEIN</th>
                        <th width="10%">FAT</th>
                        <th width="10%">CARB</th>
                        <th width="10%">SERVING SIZE (g)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql  = 'Select DESCRIPTION, CALORIES, PROTEIN, FAT, CARB, SERVING from food2 where DESCRIPTION LIKE "%'.$_POST['foodSearch'].'%"';
                    $sql_query_result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($sql_query_result) > 0) { // Checks that there are values
                        while($row = mysqli_fetch_assoc($sql_query_result)) { // while there are rows remaining
                            echo 
                                '
                                <tr>
                                    <td>'.$row['DESCRIPTION'].'</td>
                                    <td>'.$row['CALORIES'].'</td>
                                    <td>'.$row['PROTEIN'].'</td>
                                    <td>'.$row['FAT'].'</td>
                                    <td>'.$row['CARB'].'</td>
                                    <td>'.$row['SERVING'].'</td>
                                </tr>
                                ';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
