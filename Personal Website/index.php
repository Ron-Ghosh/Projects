<?php

//date in mm/dd/yyyy format; or it can be in other formats as well
$birthDate = "04/22/1994";

//explode the date to get month, day and year
$birthDate = explode("/", $birthDate);

//get age from date or birthdate
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[2]) - 1)
        : (date("Y") - $birthDate[2]));

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Home</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php include 'headInfo.php'; ?>

        <style>
            #myName {
                font-size: 5vw;
                color: whitesmoke;
                font-family: "Palatino Linotype", "Book Antiqua";
                text-decoration: underline;
            }

            #coverImage {
                background: linear-gradient(black, white, black);
            }

            .subheading {
                font-size: 2vw;
                color: white;
                font-family: "Palatino Linotype", "Book Antiqua";
                text-decoration: underline;
            }
            
            #mainSum{
                color: black;
            }

            .boday {
                background-color: black;
            }

            #schoolTable {
                background-color: ghostwhite;
            }

            .fourDiv {
                background-color: black;
            }

            #sumTable {
                background-color: ghostwhite;
                border: 5px solid #AED6F1;
            }
            
            table#sumTable td, table#sumTable th {
                font-size: 1vw;
                font-family: "Palatino Linotype", "Book Antiqua";
            }

            .fourTable {
                font-size: 1vw;
                background-color: white;
                border: 3px solid red;
            }
            
            table.fourTable td, table.fourTable th {
                font-size: 1vw;
                font-family: "Palatino Linotype", "Book Antiqua";
            }
            
            .btn {
                font-size: 1vw;
            }
        </style>

    </head>

    <body class="boday">
        <?php include 'navbar.php'; ?>

        <div id="coverImage">
            <br>
            <img src="images/profile.PNG" class="img-thumbnail img-responsive center-block">
            <br>
        </div>

        <p class="text-center" id="myName"><b>RON GHOSH</b></p>

        <hr>

        <div class="container-fluid">
            <div class="row">

                <div class="col-xs-6 col-xs-offset-3">
                    <div class="well">
                        <p class="text-center subheading" id="mainSum"> <b>Summary</b></p>
                        <p class="text-center">
                            My name is Ron and I am <?php echo $age; ?> years old. <br>
                            I believe in keeping it simple and doing good work. <br>
                            I have a background in business and computer proramming. <br>
                            I'm always striving to learn new things and better myself.
                        </p>
                        <div class="text-center">
                            <a href="Assets/Ron%20Ghosh%20Resume.pdf" target="_blank">
                                <button type="button" class="btn btn-primary">See Full Resume</button>
                            </a>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1"> 
                                <table class="table well" id="sumTable">
                                    <thead>
                                        <tr>
                                            <th>EDUCATION</th>
                                            <th>INSTITUTION</th>
                                            <th>YEAR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Computer Programming</td>
                                            <td>Humber College</td>
                                            <td>2016-2018</td>
                                        </tr>
                                        <tr>
                                            <td>Bachelors of Business Administration</td>
                                            <td>York University</td>
                                            <td>2012-2016</td>
                                        </tr>
                                        <tr>
                                            <td>High School Diploma</td>
                                            <td>Lorne Park high School</td>
                                            <td>2008-2012</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="clearfix"></div>

                <div class="col-xs-4 col-xs-offset-2">
                    <div class="well fourDiv">
                        <p class="text-center subheading"><b>IT Skills</b></p>
                        <hr>
                        <table class="table fourTable well">

                            <tbody>
                                <tr>
                                    <td><b>Languages</b></td>
                                    <td>Java, C#, Python, HTML, CSS, JS, PHP, XML, ASP.NET, SQL</td>
                                </tr>
                                <tr>
                                    <td><b>Software / IDE</b></td>
                                    <td>
                                        <b>Java:</b> Netbeans, Eclipse, Android Studio <br> 
                                        <b>C#/ASP.NET:</b> Visual Studio <br> 
                                        <b>PHP:</b> XAMPP, Apache <br>
                                        <b>Python:</b> Pycharm <br>
                                        <b>DB:</b> SQL Server, Oracle 12c, MySQL <br> 
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Software Management</b></td>
                                    <td>
                                        Software Development Life Cycle, Project Management life Cycle <br> 
                                        Requirements Engineering, System and Context Boundaries, <br>
                                        3 Tier System, Use Case Analysis
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Design / Modelling</b></td>
                                    <td>
                                        UML, Class Diagrams, Entity Relationships, Data Flow Diagrams, Sequence Diagrams, State chart Diagrams
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Other</b></td>
                                    <td>
                                        Software Testing, IT management, Source Control, GIT
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <a href="Assets/Summary.pdf" target="_blank">
                                <button type="button" class="btn btn-danger">See All Skills</button>
                            </a>
                        </div>

                    </div>
                </div>
                
                <div class="col-xs-4">
                    <div class="well fourDiv">
                        <p class="text-center subheading"><b>Work Experience</b></p>
                        <hr>
                        <table class="table fourTable well">
                            <tbody>
                                <tr>
                                    <td><b>TD Bank</b></td>
                                    <td>
                                        Worked in the fraud department. <br>
                                        Analyzed fraud using SQL, VBA and Python. <br>
                                        Streamlined Fraud Reporting Processes. <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Turnstyle Solutions</b></td>
                                    <td>
                                        Worked on the Customer Success Team <br>
                                        Used SQL Queries to generate inshights about Brick and Mortar customer behaviour. <br>
                                        Helped with onboarding process, sales and Marketing.
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Mondelez International</b></td>
                                    <td>
                                        VBA to analyze international market trends. <br>
                                        Streamlined the finance reporting system of the suppliers and distributors.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="clearfix"></div>

                <div class="col-xs-4 col-xs-offset-2">
                    <div class="well fourDiv">
                        <p class="text-center subheading"><b>Projects</b></p>
                        <hr>
                        <table class="table fourTable well">
                            <tbody>
                                <tr>
                                    <td><b>.NET</b></td>
                                    <td>
                                        Bookstore <br>
                                        Hospital Management System
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Java</b></td>
                                    <td>
                                        Many Console and GUI Applications
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>PHP</b></td>
                                    <td>Fitness Website</td>
                                </tr>
                                <tr>
                                    <td><b>Python</b></td>
                                    <td>Web Crawlers</td>
                                </tr>
                                <tr>
                                    <td><b>Other</b></td>
                                    <td>Bash Scripting, SQL, etc.</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <a href="https://github.com/Ron-Ghosh/Projects" target="_blank">
                                <button type="button" class="btn btn-danger">See All Projects (under construction)</button>
                            </a>
                        </div>
                    </div>
                </div>
                
                

                <div class="col-xs-4">
                    <div class="well fourDiv">
                        <p class="text-center subheading"><b>Other Skills and Experience</b></p>
                         <hr>
                        <table class="table fourTable well">
                            <tbody>
                                <tr>
                                    <td><b>Personal Training</b></td>
                                </tr>
                                <tr>
                                    <td><b>Videography</b></td>
                                </tr>
                                <tr>
                                    <td><b>Resident Assisstant</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>