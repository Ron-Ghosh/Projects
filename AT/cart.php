<?php
session_start();

require 'connect_db.php';

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


        <div class="container well">
            <h2 class="text-center">SHOPPING CART</h2>          
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="25%">ID</th>
                        <th width="25%">PRODUCT</th>
                        <th width="25%">AMOUNT</th>
                        <th width="25%">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql  = 'SELECT cart.ID, products.PRODUCT, cart.AMOUNT, (cart.AMOUNT * products.PRICE) as TOTAL FROM cart join products on cart.PRODUCT = products.ID where cart.USERNAME = "'.$_SESSION['username'].'"';
                    $sql_query_result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($sql_query_result) > 0) { // Checks that there are values
                        while($row = mysqli_fetch_assoc($sql_query_result)) { // while there are rows remaining
                            echo 
                                '
                                <tr>
                                    <td>'.$row['ID'].'</td>
                                    <td>'.$row['PRODUCT'].'</td>
                                    <td>'.$row['AMOUNT'].'</td>
                                    <td>'.$row['TOTAL'].'</td>
                                </tr>
                                ';
                        }
                    }
                    ?>
                </tbody>
            </table>

            <form class="form-inline" action="cart.php" method="post">
                <div class="form-group">
                    <label for="remove">Remove ID:</label>
                    <input type="text" class="form-control" id="remove" name="txtRemove">
                </div>
                <button type="submit" class="btn btn-default" name="btnRemove">Remove</button>
            </form>
        </div>

        <?php 
        if (isset($_POST['btnRemove']) && is_numeric($_POST['txtRemove'])) {
            $sql = 'Delete from cart where ID = '.$_POST['txtRemove'];
            $sql_query_result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($sql_query_result) > 0) {
                if($sql_query_result) {
                    echo 'Record Deleted';
                } else {
                    echo 'Error: '.$sql.'<br>'.mysqli_error($conn);
                }
            } else {
                echo 'No matching records.';
            }
        }
        ?>
    </body>
</html>
