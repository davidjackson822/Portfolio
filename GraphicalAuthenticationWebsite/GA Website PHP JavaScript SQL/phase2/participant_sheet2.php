<!--KF7004 MComp Computing Research Project-->
<!--Shona Start w17019752-->

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
        <h2>Project Title:</h2>
        <p>Recognition versus pure recall for dyslexic users </p>
        <h2>Principal Investigators:</h2>
        <p>Polina Evtimova, Shona Start, David Jackson and Myron Williamson</p>
        <h2>What is the Purpose of the Study? </h2>
        <ul>
            <li>The study aims to investigate user account creation and management among dyslexic users.</li>
            <li>Your experience will help us understand the tools that aid dyslexic users to enable the accessible creation and management of social media accounts.</li>
        </ul>
        <h2>What will I have to do?</h2>
        <ul>
            <li>You will be asked to create a user account on a website made for this study and complete a short survey about your experience of creating an account.</li>
            <li>The survey will be mostly multiple choice and YES/NO answers.</li>
            <li>You will then be contacted by email, at a later date, and asked to login to your account. After you login you will then be asked to complete a second questionnaire similar to the first.</li>
        </ul>
        <h2>Why have I been invited to take part?</h2>
        <ul>
            <li>We are studying how dyslexic users operate our website, so you should have been diagnosed with dyslexia in the past.</li>
            <li>You have been invited to take part only if you are aged 18 or over.</li>
            <li>You own and use one or more online accounts or devices and know how to create an account online.</li>
        </ul>
        <h2>Do I have to take part?</h2>
        <ul>
            <li>This study is voluntary.</li>
            <li>If you wish to withdraw at any point simply inform the researchers via the email listed below. You do not need to give a reason why you are withdrawing.</li>
        </ul>
        <h2>What data are we collecting?</h2>
        <ul>
            <li>The main type of personal data we are collecting is email addresses.</li>
            <li>We will also be storing usernames and passwords, however, they will not be linked to any other username and password that you use, so you can use whatever username and password you would like.</li>
            <li>The data will be stored on a secure OneDrive folder until the end of the study, afterwards it will be permanently deleted.</li>
        </ul>
        <h2>How will the data be kept confidential and anonymous?</h2>
        <ul>
            <li>The only personal data that is being collected is email addresses, and they will not be linked to individuals or identifiable from the report.</li>
            <li>Throughout the report, any individual data that is referenced will be anonymized.</li>
        </ul>
        <h2>What will happen to the results of the study?</h2>
        <ul>
            <li>The results will be analyzed and explained in a report that will hopefully be published in the near future.</li>
            <li>Any personal information will be permanently deleted afterwards.</li>
        </ul>

        <?php
            if($_SESSION['PTYPE'] == 1)
                echo "<a href='index.php?ptype=1' class='button'>Go Back</a>";
            else
                echo "<a href='index.php?ptype=2' class='button'>Go Back</a>";
        ?>
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