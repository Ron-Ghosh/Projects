<?php
session_start();

require 'connect_db.php';

function echo_image($link) {
    return '<img style="display:block;" width="100%" src="'.$link.'" alt="test">';
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Exercises</title>
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
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
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
            
            <form action="food_db_search.php" method="post">
                <div class="well col-xs-4 col-xs-offset-4">
                    <h2 class="text-center">TOP EXERCISES</h2> <br>
                    <br>
                    <div class="text-center">
                        <label for="myInput">Filter Exercises:</label>
                    </div>
                    <input class="form-control" id="myInput" type="text" placeholder="Search.."> <br>
                    <button type="submit" class="btn btn-default btn-block" name="btnRegister">Submit</button> <br>
                </div> 
            </form>

            <br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="well col-xs-6 col-xs-offset-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="20%">EXERCISE</th>
                            <th width="20%">TYPE</th>
                            <th width="20%">PRIMARY MUSCLE</th>
                            <th width="40%">PICTURE</th>
                        </tr>
                    </thead>
                    <tbody id ="myTable">
                        <?php
                        $sql  = 'Select Exercise, Type, Primary_Muscle, Image from exercises';
                        $sql_query_result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($sql_query_result) > 0) { // Checks that there are values
                            while($row = mysqli_fetch_assoc($sql_query_result)) { // while there are rows remaining
                                $image = 'Images/exercises/'.$row['Image']; //get the full file path for the image

                                echo 
                                    '
                                <tr>
                                    <td>'.$row['Exercise'].'</td>
                                    <td>'.$row['Type'].'</td>
                                    <td>'.$row['Primary_Muscle'].'</td>
                                    <td>'.' '.echo_image($image).' '.'</td>
                                </tr>
                                ';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
