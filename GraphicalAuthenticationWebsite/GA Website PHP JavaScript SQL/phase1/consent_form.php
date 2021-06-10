<!--Document for KF7004 MComp Computing Research Project-->
<!--Shona Start w17019752-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informed Consent Form</title>
    <link href="../site_style.css" rel="stylesheet" type="text/css"><!--StyleSheet-->
    <?php
        include '../functions.php';
        if(!($has_session = session_status() == PHP_SESSION_ACTIVE)) {
            ini_set("session.save_path", "../../sessionData"); // This sets the save path for the session data
            session_start(); // This starts the session using a function
        }

        echo "<script>console.log('Reset');</script>";

        if((isset($_POST['submit1']) && !empty($_POST['submit1']))) {
            echo "<script>console.log('if');</script>";
            $_SESSION["signature"] = $_POST["signature"];
            if($_SESSION["PTYPE"] == "1") {
                echo "<script>console.log('ifif')</script>";
                header("Location: create_password1.php");
            }
            else {
                echo "<script>console.log('ifelse')</script>";
                header("Location: create_password2.php");
            }
        }
    ?>
</head>
<body>
<div class="wrapper">
    <!--Start of heading-->
    <header>
        <img src="../images/northumbria_logo.png" alt="Northumbria University Logo" width="20%" height="20%">
        <h1>Participant Information Sheet</h1>
    </header>
    <!--End of heading-->
    <!--Start of main body-->
    <main>
        <h2>Please tick where applicable</h2>
        <form action="" method="post">
            <p><input type="checkbox" id="one" name="checkbox_one" required>
            <label for="one">I am 18 years of age or over and I agree to take part in this study.</label></p>

            <p><input type="checkbox" id="two" name="checkbox_two" required>
            <label for="two">I have read and understood the Participant Information Sheet.</label></p>

            <p><input type="checkbox" id="three" name="checkbox_three" required>
            <label for="three">I understand I am free to leave the study at any time, without having to give a reason for leaving, and without judgment.</label></p>

            <p><input type="checkbox" id="four" name="checkbox_four" required>
            <label for="four" class="checkmark">I give permission to receive emails in the future for the follow up questionnaire.</label></p>

            <label for="signature"><p>Signature</label>
                <input class="box" type="text" id="signature" name="signature" required></p>


            <a href="index.php?ptype=
            <?php
                if($_SESSION["PTYPE"] === 1)
                    echo "1";
                else
                    echo "2";
            ?>
            " class="button">Go Back</a>


            <input type="submit" value="Confirm" class="button" name="submit1">
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
</html>