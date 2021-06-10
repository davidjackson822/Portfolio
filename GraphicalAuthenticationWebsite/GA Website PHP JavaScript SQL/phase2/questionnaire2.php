<!--KF7004 MComp Computing Research Project-->
<!--Shona Start w17019752-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Computing Research Project</title>
    <link href="../site_style.css" rel="stylesheet" type="text/css"><!--StyleSheet-->
    <?php
    include  "../functions.php";
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
    </header>
    <!--End of heading-->
    <!--Start of main body-->
    <main>
        <iframe width="1000px" height= "1000px" src="https://docs.google.com/forms/d/e/1FAIpQLSdeSksvpBOR6zCLvMAwsPBGkPmsdv7HyzmxpuLqaUUGJA-r6Q/viewform?embedded=true" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
       <p style="color:#ff0000;">Thank you for your participation</p>
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