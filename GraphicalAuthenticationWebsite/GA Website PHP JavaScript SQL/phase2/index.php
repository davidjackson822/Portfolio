<!--Document for KF7004 MComp Computing Research Project-->
<!--Shona Start w17019752-->
<!--David Jackson w17022414-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Computing Research Project</title>
    <link href="../site_style.css" rel="stylesheet" type="text/css"><!--StyleSheet-->
    <?php
        include "../functions.php";
        if(!($has_session = session_status() == PHP_SESSION_ACTIVE)) {
            ini_set("session.save_path", "../../sessionData"); // This sets the save path for the session data
            session_start(); // This starts the session using a function
        }

        $_SESSION['INCORRECT'] = false;
        $_SESSION['PTYPE'] = $_GET['ptype'];

        if(!isset($_SESSION['login_start']))
            $_SESSION['login_start'] = time();
        else if(isset($_SESSION['attempts_login']))
            $_SESSION['attempts_login'] = $_SESSION['attempts_login'] + 1;
        else
            $_SESSION['attempts_login'] = 1;

        if(isset($_POST['submit1']))
            if (LogIn()) {
                $_SESSION['INCORRECT'] = false;
                header('Location: questionnaire2.php');
            }
        else {
            $_SESSION['INCORRECT'] = true;
        }

    ?>
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
        <img src="../images/northumbria_logo.png" alt="Northumbria University Logo" width="20%" height="20%">
        <h1>Welcome Back</h1>
    </header>
    <!--End of heading-->
    <!--Start of main body-->
    <main>
        <a href="participant_sheet2.php" class="button">Project Details</a>



        <?php
            if($_SESSION['PTYPE'] == 1) {
                echo "<form action='index.php?ptype=1' name='faceSelectFrm' method='post' id='fcForm'>";
            }
            else {
                echo "<form action='index.php?ptype=2' name='faceSelectFrm' method='post' id='fcForm'>";
            }
        ?>
        <form action="index.php?ptype=" name="faceSelectFrm" method="post" id="fcForm">
            <p><label for="email">Email</label>
                <input class="box" type="email" id="email" name="email" required></p>

            <?php
                if($_SESSION['INCORRECT'] == true) {
                    echo "<p style='color:#ff0000'>Incorrect match. Please ensure that you have the correct email and password.</p>";
                }

                echo "<div class='passwordWrapper'>";

                if($_SESSION['PTYPE'] == 1) {
                    print9images("FACE");
                }
                else {
                    print9images("PATT");
                }

                echo "</div>";
            ?>

            <input type="text" id="currentPattern" name="pattern" hidden>
            <input type="text" id="patternText" hidden><br>
            <input type="text" id="currentAction" hidden>
            <input type="submit" value="Confirm" class="button" name="submit1">
            <a href="questionnaire2.php" class="button">Forgot Password?</a>
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