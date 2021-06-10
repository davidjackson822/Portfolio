<!--KF7004 MComp Computing Research Project-->
<!--Shona Start w17019752-->
<!--David Jackson w17022414-->
<?php
    include '../functions.php';

    if(!($has_session = session_status() == PHP_SESSION_ACTIVE)) {
        // This sets the save path for the session data
        ini_set("session.save_path", "../../sessionData");
        // This starts the session using a function
        session_start();
    }

    if(!isset($_SESSION['create_start']))
        $_SESSION['create_start'] = time();
    else if(isset($_SESSION['attempts_create']))
        $_SESSION['attempts_create'] = $_SESSION['attempts_create'] + 1;
    else
        $_SESSION['attempts_create'] = 1;


    if(isset($_POST['submit'])) {
        if (addNewUser("1")) {

            header('Location: questionnaire.php');
            //header('Location: create_password1.php');
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Computing Research Project</title>
    <link href="../site_style.css" rel="stylesheet" type="text/css"><!--StyleSheet-->

</head>
<body>
<svg id="SVGcont">

    <?php
        for($i = 0; $i < 9; $i++) {
            echo "<g class='pattG'><rect class='lineSVG' x='0' y='0' id='SVG$i' rx='10'></rect ></g>";
        }

    ?>

</svg>
<div class="wrapper">
    <!--Start of heading-->
    <header>
        <img src="../images/northumbria_logo.png" alt="Northumbria University Logo" >
        <h1>Create Password</h1>
    </header>
    <!--End of heading-->
    <!--Start of main body-->
    <main>
        <form action="create_password1.php" name="faceSelectFrm" method="post" id="fcForm">
            <p><label for="email">Email:</label>
            <input class="box" type="email" id="email" name="email" required></p>
            <p>Choose 3 faces:</p>
            <p style="color:#ff0000;">You will need to remember this password for the second part of the study</p>


            <div class='passwordWrapper'>
                <?php
                print9images("FACE");
                ?>
            </div>


            <input type="text" id="currentPattern" name="pattern" hidden>
            <input type="text" id="patternText" hidden><br>
            <input type="text" id="currentAction" hidden>
            <input type="submit" value="Confirm" class="button" name="submit" disabled>
        </form>
    </main>
    <!--End of main body-->
    <!--Start of footer-->
    <footer>
        <h2>Contact for further information or to withdraw from the study:</h2>
        <p>alan.godfrey@northumbria.ac.uk</p>
    </footer>
    <!--End of footer-->


</div>
</body>
<script src="../JSFunctions.js" defer></script>
</html>