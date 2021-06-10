<!--KF7004 MComp Computing Research Project-->
<!--David Jackson w17022414-->
<?php

/*To Do
    Fix on android phone!!
    Change CSS for disabled buttons! SHONA
    Swap make a pattern with red text!!
    Only allow 1 password per person!
*/

function exceptionHandler($e) // The first two functions will take an exception as a parameter and then display it in a readable format
{
    echo "<p><strong>Problem </strong>" . $e->getMessage() .
        " in file " . $e->getFile() .
        ", on line " . $e->getLine() . "</p>";
}

set_exception_handler('exceptionHandler');


function errorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        return;
    }
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}

set_error_handler('errorHandler');

function getConnection() // Allows the website to connect to the newnumyspace database
{
    try {
        $connection = new PDO("mysql:host=localhost;dbname=unn_w17022414",
            "unn_w17022414", "Mickeyj8."); // Contains the filepath, username and password to connect to the database
        $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection; // Returns the connection information to the page it is needed on
    } catch (Exception $e) { // Catches any errors in connecting t the database, and logs that error on the screen.
        log_error($e);
        throw new Exception("A problem occurred, please try again." . $e->getMessage(), 0, $e); // Displays the error information on the webpage

    }
}

function getUserPassword() {
    $uDetails = array();
    for($i = 1; $i <= 9; $i++) {
        if(isset($_POST['facechk' . $i])) {
            array_push($uDetails, $i);
        }
    }
    if((count($uDetails) == 3) && (!(($uDetails[0] === 0) || ($uDetails[1] === 0) || ($uDetails[2] === 0)))) {
        return $uDetails;
    }
    else {
//        header('Location: create_password1.php');
        return 0;
    }

}

function addNewUser($passwordType) {
    $dbConn = getConnection();
    $email = $_POST['email'];
    $signature = $_SESSION['signature'];

    if ($passwordType === "1") {
        echo "<script>console.log('password1');</script>";
        $uDetails = getUserPassword();
        $currentTime = time();
        $duration = $currentTime - $_SESSION['create_start'];

        $execute = $dbConn->prepare("INSERT INTO users (email, signature, pType, pass1, pass2, pass3, createDuration) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $execute->execute(array($email, $signature, $passwordType, $uDetails[0], $uDetails[1], $uDetails[2], $duration));

        return true;
    }
    else {
        echo "<script>console.log('password2');</script>";
        echo "<script>console.log('" . $passwordType . "');</script>";
        $patternPass = $_POST['pattern'];
        echo "<script>console.log('$patternPass')</script>";
        if (($patternPass === 0) || (strlen($patternPass) === 0))
            return false;
        else {
            echo "<script>console.log('$patternPass')</script>";
            $currentTime = time();
            $duration = $currentTime - $_SESSION['create_start'];
            $SQL = "INSERT INTO users (email, signature, pType, pass1, pass2, pass3, patternPass, createDuration) VALUES ('" . $email . "', '" . $signature . "', '" . $passwordType . "', '0', '0', '0', '" . $patternPass . "', '" . $duration . "')";

            $execute = $dbConn->prepare("INSERT INTO users (email, signature, pType, patternPass, createDuration) VALUES (?, ?, ?, ?, ?)");
            $execute->execute(array($email, $signature, $passwordType, $patternPass, $duration));

            return true;
        }
    }
}

function LogIn() {
    $dbConn = getConnection();
    $email = $_POST['email'];

    $SQL = "SELECT * FROM users WHERE email = ('" . $email . "') LIMIT 1;";

    $userTest = $dbConn->prepare($SQL);
    $userTest->execute();
    $result = $userTest->fetch();

    if ($_SESSION['PTYPE'] == 1) {

        $dbFaces = array($result['pass1'], $result['pass2'], $result['pass3']);
        $uDetails = array();
        for ($i = 1; $i <= 9; $i++) {
            if (isset($_POST['facechk' . $i])) {
                array_push($uDetails, $i);
            }
        }

        sort($dbFaces);
        sort($uDetails);

        if (!(array_diff($uDetails, $dbFaces))) {
            $attempts = 0;
            if(isset($_SESSION['attempts_login']))
                $attempts = $_SESSION['attempts_login'];
            else
                $attempts = 1;
            $currentTime = time();
            $duration = $currentTime - $_SESSION['login_start'];

            $execute = $dbConn->prepare("UPDATE users SET attempts = ?, loginDuration = ? WHERE email = ?");
            $execute->execute(array($attempts, $duration, $email));


            return true;
        } else {
            echo "<script>console.log('FACE LOGIN UNSUCCESSFUL')</script>";
            return false;
        }
    }
    else {
        $dbPattern = $result['patternPass'];
        $uPattern = $_POST['pattern'];

        echo "<script>console.log('" . $dbPattern . "')</script>";
        echo "<script>console.log('" . $uPattern . "')</script>";

        if($dbPattern === $uPattern) {

            if(isset($_SESSION['attempts_login']))
                $attempts = $_SESSION['attempts_login'];
            else
                $attempts = 1;
            $currentTime = time();
            $duration = $currentTime - $_SESSION['login_start'];

            $execute = $dbConn->prepare("UPDATE users SET attempts = ?, loginDuration = ? WHERE email = ?");
            $execute->execute(array($attempts, $duration, $email));

            return true;
        }
        else {
            echo "<script>console.log('PATT LOGIN UNSUCCESFULL')</script>";
            return false;
        }
    }
}

function print9images($faceOrPatt) {
    echo "<table><tr>";
    $fORp = 2;
    $max = 1;
    if($faceOrPatt == "FACE") {
        $fORp = 1;
        $max = 9;
    }
    else if($faceOrPatt == "PATT") {
        $fORp = 10;
        $max = 18;
    }
    else {
        echo "<h1>ERROR</h1>";
    }

    for($i = $fORp; $i <= $max; $i++) {

        if($i <= 9) {
            echo "<td><input id='fc$i' class='faceChk' name='facechk$i' type='checkbox' hidden/>";
            echo "<label for='fc$i'>";
            echo "<img src='../images/$i.jpg' id='$i' alt='Face number $i' class='faceImages'></label></td></div>";
        }
        else {
            echo "<td><input id='fc$i' class='pattChk' name='facechk$i' type='checkbox' hidden/>";
            echo "<label for='fc$i'>";
            echo "<img src='../images/Pattern_Unchecked.jpg' id='$i' alt='Pattern number $i' class='pattImages'></label></td></div>";
        }
        if(($i == 3) || ($i == 6) || ($i == 12) || ($i == 15)){echo "</tr><tr>";}
    }
    echo "</tr></table>";
}