<!--KF7004 MComp Computing Research Project-->
<!--Shona Start w17019752-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Computing Research Project</title>
    <link href="../site_style.css" rel="stylesheet" type="text/css"><!--StyleSheet-->
    <?php
        include '../functions.php';
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
        <iframe width="1000px" height= "1000px" src="https://docs.google.com/forms/d/e/1FAIpQLSdiBB8VTP5BUBLAOe04bAkxTQcedsjw2vKKPyuaBwLW1b_3VA/viewform?embedded=true" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        <!--<iframe width="1000px" height= "1000px" src= "https://forms.office.com/Pages/ResponsePage.aspx?id=3c9X5zUfV0Svj3ycaxQ347ch29sW3iBDt80AB174R4VUMzc1M00wMkJDWUVOTFdOWEFLT0dKWVkySy4u&embed=true" frameborder= "0" marginwidth= "0" marginheight= "0" style= "border: none; max-width:100%; max-height:100vh" allowfullscreen webkitallowfullscreen mozallowfullscreen msallowfullscreen> </iframe>-->
        <p style="color:#ff0000;">Thank you for your participation</p>
        <p style="color:#ff0000;">We will email you for the second half of the study in about 7 days</p>
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