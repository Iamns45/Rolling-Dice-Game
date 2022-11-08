<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Rolling Dice</title>
    <link href='project2.css' rel='stylesheet' type='text/css'>
</head>
<body>

    <?php
        session_start();
        if (!isset($_SESSION['exists'])) {
            header("Location: index.php");
            exit;
        }
    ?>

<ul>
    <li><a href="logout.php">Logout</a></li>
    <li><a class="active" href="contact.php">Contact</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="game.php">Game</a></li>
    <li><a href="Leaderboard_gui.php">Leaderboard</a></li>
</ul>
<div class="header">
    <p style="font-family: Cursive; color: cadetblue;">Rolling Dice</p>
</div>
<div class="contact">
    <h2> Contact us</h2>


    <h3>Write to us</h3>
    <p>rollyourdicewithus@gsu.com</p>

    <h3>Give us a call</h3>
    <p>+470 999 9999</p>

    <h3>Address</h3>
    <p>Gerogia State University </p>
    <p>33, Gilmer Street , Atlanta</p>


    <div class="button">
        <a href="about.php">Back</a>

    </div>

</body>
</html>
