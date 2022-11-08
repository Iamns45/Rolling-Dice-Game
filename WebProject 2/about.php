<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Roll Your Dice With Us</title>
    <link href='project2.css' rel='stylesheet' type='text/css'>
</head>
<body>

<ul>
    <li><a href="logout.php">Logout</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a class="active" href="about.php">About</a></li>
    <li><a href="game.php">Game</a></li>
    <li><a href="Leaderboard_gui.php">Leaderboard</a></li>
</ul>
<?php
session_start();
if (!isset($_SESSION['exists'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION['exists']) && $_SESSION['exists'] == true) {
    echo "<h1>Welcome Back " . $_SESSION['name'] . "</h1>";
} else {
    echo "<h1>Hey New USER " . $_SESSION['name'] . "!!! Welcome to Roll Your Dice With Us</h1>";
}

?>
<!-- <div class="welcome">
			<p>Welcome <?= $_POST['name'] ?>!</p>

		</div> -->
<div class="header">
    <p style="font-family: Cursive; color: black">Rolling Dice</p>
</div>

<div class="description">
    <p>Hello! Hello! This is a board game and is played with dice rolling.
        In this each player gets a chance to roll.</br> The die will decide how many positions each player will move
        forward.
        </br>At the danger positions, the score is reduced accordingly.
    </p>
</div>

</div>


</pre>
</div>
</div>

</body>
</html>
