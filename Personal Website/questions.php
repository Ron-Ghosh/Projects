<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (isset($_POST['btnInsert'])) {
    $sql = "Insert into question (Name, Question) VALUES ('".$_POST['person']."', '".$_POST['comment']."')";
    if (!mysqli_query($conn, $sql)) {
        echo '<div class="well"> Error: '.$sql.' <br> '.mysqli_error($conn).'</div>';
    } else {
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Home</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php include 'headInfo.php'; ?>

        <style>
            .boday {
                background-color: black;
            }

            #questionWell, #commentWell {
                background-color: black;
            }

            div#commentWell td {
                color: white;
                font-size: 1.2vw;
                font-family: "Palatino Linotype", "Book Antiqua";
            }

            div.form-group label {
                color: white;
                font-size: 1vw;
                font-family: "Palatino Linotype", "Book Antiqua";
            }

            .btn {
                font-size: 1vw;
                font-family: "Palatino Linotype", "Book Antiqua";
            } 
        </style>

    </head>

    <body class="boday">
        <?php include 'navbar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="well col-xs-8 col-xs-offset-2" id="questionWell">
                    <table class="table">
                        <form class="form-inline" action="questions.php" method="post">
                            <div class="form-group">
                                <label for="person">NAME</label>
                                <input type="text" class="form-control" id="person" name="person">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="comment">COMMENT</label>
                                <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-default btn-block" name="btnInsert">SUBMIT</button>
                        </form>
                    </table>
                </div>

                <div class="clearfix"></div>

                <div class="well col-xs-8 col-xs-offset-2" id="commentWell"> 
                    <table class="table">
                        <?php
                        // Query 
                        $sql = 'Select * from question';

                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            // Output the data in each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo 
                                    '
                                <tr>
                                <td><b>'.$row['Name'].'</b></td>
                                <td>'.$row['Question'].'</td>
                                </tr>
                                ';
                            }
                        }
                        ?>
                    </table>
                </div>

            </div>
        </div>
    </body>

</html>

<?php 
$conn->close(); ?>