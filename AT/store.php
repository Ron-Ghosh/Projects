<?php
session_start();

require 'connect_db.php';

function put_in_well($stringythingy) {
    echo '<div class="well">'.$stringythingy.'</div>';
}

function echo_list($last_val) {
    for ($i = 1 ; $i <= $last_val ; $i++) {
        echo '<option>'.$i.'</option>';
    }
}

if (isset($_POST['btnSubmitEquipment'])) {
    $product = 1;
    $sql = "Insert into cart (USERNAME, PRODUCT, AMOUNT) VALUES ('".$_SESSION['username']."', '".$product."', '".$_POST['equipment_quantity']."')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        put_in_well('Your Equipment order has been added to cart');
    } else {
        $error_string = 'Error: '.$sql.' <br> '.mysqli_error($conn);
        put_in_well($error_string);
    }
}

if (isset($_POST['btnSubmitSupplement'])) {
    $product = 2;
    $sql = "Insert into cart (USERNAME, PRODUCT, AMOUNT) VALUES ('".$_SESSION['username']."', '".$product."', '".$_POST['supplement_quantity']."')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        put_in_well('Your Supplement order has been added to cart');
    } else {
        $error_string = 'Error: '.$sql.' <br> '.mysqli_error($conn);
        put_in_well($error_string);
    }
}

if (isset($_POST['btnSubmitTraining'])) {
    $product = 3;
    $sql = "Insert into cart (USERNAME, PRODUCT, AMOUNT) VALUES ('".$_SESSION['username']."', '".$product."', '".$_POST['training_quantity']."')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        put_in_well('Your Training order has been added to cart');
    } else {
        $error_string = 'Error: '.$sql.' <br> '.mysqli_error($conn);
        put_in_well($error_string);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AT Home Page</title>
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
            .img-padder {
                padding-top: 1%;
                padding-bottom: 1%;
                border: 2px solid white;
            }

            body {
                background-color: black;
            }


        </style>


    </head>

    <body>

        <?php require 'navbar.php' ?>

        <!-- Main Images -->
        <div class="container">
            <div class="row">

                <!-- Header Image (Equipment) -->
                <div class="img-padder col-sm-12">
                    <img class="img img-responsive" src="Images/Header_Image.jpg">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#HeaderModal">PURCHASE EQUIPMENT PACKAGE</button>
                </div>
                <!-- End of Header Image -->

                <!-- Modal for equipment -->
                <div class="modal fade" id="HeaderModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Equipment Package</h4>
                            </div>
                            <div class="modal-body">
                                <p>The equipment great for those trainers looking to beef up their current garage gym, or start a new gym of their own. It has all the basic necessities at the highest quality. </p> <br>
                                <p>PRICE: $10,000.00 </p>

                                <form action="store.php" method="post">
                                    <div class="form-group">
                                        <label for="equipment_quantity">Select Quantity:</label>
                                        <select class="form-control" id="equipment_quantity" name="equipment_quantity">
                                            <?php echo_list(100); ?>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-danger btn-block" name="btnSubmitEquipment">ADD TO CART</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Modal for equipment -->

                <!-- Sub Header image One -->
                <div class="img-padder col-sm-6">
                    <img class="img img-responsive" src="Images/Sub_header_1.jpg">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#SubHeaderModalOne">PURCHASE SUPPLMENT PACKAGE</button>
                </div>
                <!-- End sub Header image One -->

                <!-- Modal for suppments -->
                <div class="modal fade" id="SubHeaderModalOne" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Supplment Package</h4>
                            </div>
                            <div class="modal-body">
                                <p>The equipment great for those trainers looking to get the most of their nutrition and get the best body they can possibly manage. It has all the basic necessities at the highest quality. </p> <br>
                                <p>PRICE: $5,000.00 </p>

                                <form action="store.php" method="post">
                                    <div class="form-group">
                                        <label for="equipment_quantity">Select Quantity:</label>
                                        <select class="form-control" id="supplement_quantity" name="supplement_quantity">
                                            <?php echo_list(100); ?>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-danger btn-block" name="btnSubmitSupplement">ADD TO CART</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Modal for supplements -->

                <!-- Sub Header Image Two -->
                <div class="img-padder col-sm-6">
                    <img class="img img-responsive" src="Images/Sub_header_2.jpg">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#SubHeaderModalTwo">PURCHASE TRAINING PACKAGE</button>
                </div>
                <!-- Sub Header Image Two -->

                <!-- Modal for equipment -->
                <div class="modal fade" id="SubHeaderModalTwo" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Training Package</h4>
                            </div>
                            <div class="modal-body">
                                <p>The equipment great for those trainers looking to get the most of their training and get the best knowledge they can possibly manage. It has all the basic necessities at the highest quality. </p> <br>
                                <p>PRICE: $8,000.00 </p>

                                <form action="store.php" method="post">
                                    <div class="form-group">
                                        <label for="equipment_quantity">Select Quantity:</label>
                                        <select class="form-control" id="training_quantity" name="training_quantity">
                                            <?php echo_list(100); ?>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-danger btn-block" name="btnSubmitTraining">ADD TO CART</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Modal for equipment -->


                <div class="clearfix"></div>

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="https://i.imgur.com/vYLWY3J.jpg">
                </div> 

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="https://i.imgur.com/hRGOo8t.jpg">
                </div>

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="https://i.imgur.com/XhGsjTN.jpg">
                </div>

                <div class="clearfix"></div>

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="https://i.imgur.com/YqzsTwo.jpg">
                </div> 

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="http://i.imgur.com/zufC7Lh.jpg">
                </div>

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="https://i.imgur.com/3WOkyXK.jpg">
                </div> 

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="https://i.imgur.com/0dQF2lo.jpg">
                </div>

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="https://i.imgur.com/WEQaCue.jpg">
                </div>

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="http://i.imgur.com/m358mLL.jpg">
                </div>

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="https://i.imgur.com/9LP2MX8.jpg">
                </div>

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="https://hdqwalls.com/wallpapers/sunset-rock-nature-wide.jpg">
                </div>

                <div class="img-padder col-sm-4">
                    <img class="img img-responsive" src="http://p.fod4.com/p/media/d06173dd4f/jPAQc21sR1CqtNxfr9tH_DEATH_LOVES_MUSIC_Thumb.jpg">
                </div>

            </div>
        </div>

    </body>
</html>