<?php
session_start();

require 'connect_db.php';

function put_in_well($stringythingy) {
    echo '<div class="well">'.$stringythingy.'</div>';
}

if (isset($_POST['btnSubmitEntry'])) {
    $sql = "Insert into journal (USERNAME, DATE, TITLE, ENTRY) VALUES ('".$_SESSION['username']."', '".$_POST['date']."', '".$_POST['title']."', '".$_POST['comment']."')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        put_in_well('Your entry has been added.');
    } else {
        $error_string = 'Error: '.$sql.' <br> '.mysqli_error($conn);
        put_in_well($error_string);
    }
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
                $("#frmInsert").hide();
                $("#frm_edit").hide();

                $("#btnInsert").click(function() {
                    $("#frmInsert").slideToggle();
                });
                
                $("#btnUpdate").click(function(){
                    $("#frm_edit").slideToggle();
                });
                
                $("#btnDelete").click(function(){
                    $("#frm_edit").slideToggle();
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
            <div class="row">

                <div class="well col-md-12">
                    <div class="col-md-2 col-md-offset-3">
                        <button class="btn btn-block btn-default" id="btnInsert"> INSERT </button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-default" id="btnUpdate"> UPDATE </button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-default" id="btnDelete"> DELETE </button>
                    </div>
                </div>

                <div class="clearfix"></div>

                <br>

                <div id ="frmInsert" class="well col-md-12">
                    <form action="journal.php" method="post">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">TITLE: </label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">DATE (YYYY/MM/DD):</label> 
                                <input type="text" class="form-control" id="date" name="date">
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Entry:</label>
                                <textarea class="form-control" rows="7" id="comment" name="comment"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn-default" name ="btnSubmitEntry">Submit</button>
                        </div>
                    </form>
                </div>
                
                
                <div id ="frm_edit" class="well col-md-12">
                    <form action="journal.php" method="post">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">ID: </label>
                                <input type="text" class="form-control" id="ID" name="title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">TITLE: </label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">DATE (YYYY/MM/DD):</label> 
                                <input type="text" class="form-control" id="date" name="date">
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Entry:</label>
                                <textarea class="form-control" rows="7" id="comment" name="comment"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn-default" name ="btnSubmitEditedEntry">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="container well">
            <h2 class="text-center">PREVIOUS ENTRIES</h2>          
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="15%">DATE</th>
                        <th width="15%">TITLE</th>
                        <th width="70%">ENTRY</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    $sql = 'Select DATE, TITLE, ENTRY from journal where USERNAME = "'.$_SESSION['username'].'" order by DATE';
                    $sql_query_result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($sql_query_result) > 0) { // Checks that there are values
                        while($row = mysqli_fetch_assoc($sql_query_result)) { // while there are rows remaining
                            echo 
                                '
                                <tr>
                                    <td>'.$row['DATE'].'</td>
                                    <td>'.$row['TITLE'].'</td>
                                    <td>'.$row['ENTRY'].'</td>
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
