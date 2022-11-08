<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Roll Your Dice With Us</title>
    <link href='game.css' rel='stylesheet' type='text/css'>
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION['exists'])) {
            header("Location: index.php");
            exit;
        }
    ?>

<div class="bubblecontainer">
        <div class="bubbles">
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:24;"></span>
            <span style="--i:18;"></span>
            <span style="--i:17;"></span>
            <span style="--i:15;"></span>
            <span style="--i:13;"></span>
            <span style="--i:19;"></span>
            <span style="--i:22;"></span>
            <span style="--i:21;"></span>
            <span style="--i:20;"></span>
            <span style="--i:13;"></span>
            <span style="--i:11;"></span>
            <span style="--i:19;"></span>
            <span style="--i:15;"></span>
            <span style="--i:20;"></span>
            <span style="--i:17;"></span>
            <span style="--i:16;"></span>
            <span style="--i:12;"></span>
            <span style="--i:19;"></span>
            <span style="--i:12;"></span>
            <span style="--i:22;"></span>
            <span style="--i:18;"></span>
            <span style="--i:28;"></span>
            <span style="--i:17;"></span>
            <span style="--i:15;"></span>
            <span style="--i:13;"></span>
            <span style="--i:19;"></span>
            <span style="--i:22;"></span>
            <span style="--i:21;"></span>
            <span style="--i:20;"></span>
            <span style="--i:13;"></span>
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:24;"></span>
            <span style="--i:18;"></span>
            <span style="--i:17;"></span>
            <span style="--i:15;"></span>
            <span style="--i:13;"></span>
            <span style="--i:11;"></span>
            <span style="--i:19;"></span>
            <span style="--i:15;"></span>
            <span style="--i:20;"></span>
        </div>
    </div>

    <ul>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="game.php">Game</a></li>
        <li><a class="active" href="Leaderboard_gui.php">Leaderboard</a></li>
    </ul>

    <table class="LeaderboardTable">
        <thead>
        <style>
            h2 {
                border-style: solid;
                border-color: coral;
                background-color:orangered;
                text-align: center;
                font-family: Copperplate, Papyrus, fantasy;
                 }
            table {
                border-style: solid;
                border-color: coral;
                border-collapse: collapse;
                width: 100%;
            }

            th{
                text-align: center;
                padding: 8px;
                border-bottom: 1px solid #DDD;
                font-family: Cursive;
            }

            th, td {
                text-align: center;
                padding: 8px;
                border-bottom: 1px solid #DDD;
            }

            tr:nth-child(even) {
                background-color: #E3B448;
            }

            tr:nth-child(odd) {
                background-color:#CBD18F;
            }

            th
            {
                background-color:#FFA351FF;
                color:black;
            }

        </style>
        <H2> Leaderboard</H2>
        <tr>
            <th>Name</th>
            <th>Games Won</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $file_handle = fopen("Scores.txt", "r");
            $winners = array();
            while (!feof($file_handle)) {
                $playerName = fgets($file_handle);
                $playerName = trim($playerName);
                if (array_key_exists($playerName, $winners)) {
                    $gamesWon = $winners[$playerName];
                    $winners[$playerName] = $gamesWon + 1;
                } else {
                    $winners[$playerName] = 1;
                }
            }
            arsort($winners);
            foreach ($winners as $k => $v) {
                echo "<tr><td>" . $k . "</td><td>" . $v . "</td>";
            }
//            array_multisort($price, SORT_DESC, $inventory);
//            fclose($file_handle);
            ?>
        </tbody>
    </table>

    <div class="bubblecontainer">
        <div class="bubbles">
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:24;"></span>
            <span style="--i:18;"></span>
            <span style="--i:17;"></span>
            <span style="--i:15;"></span>
            <span style="--i:13;"></span>
            <span style="--i:19;"></span>
            <span style="--i:22;"></span>
            <span style="--i:21;"></span>
            <span style="--i:20;"></span>
            <span style="--i:13;"></span>
            <span style="--i:11;"></span>
            <span style="--i:19;"></span>
            <span style="--i:15;"></span>
            <span style="--i:20;"></span>
            <span style="--i:17;"></span>
            <span style="--i:16;"></span>
            <span style="--i:12;"></span>
            <span style="--i:19;"></span>
            <span style="--i:12;"></span>
            <span style="--i:22;"></span>
            <span style="--i:18;"></span>
            <span style="--i:28;"></span>
            <span style="--i:17;"></span>
            <span style="--i:15;"></span>
            <span style="--i:13;"></span>
            <span style="--i:19;"></span>
            <span style="--i:22;"></span>
            <span style="--i:21;"></span>
            <span style="--i:20;"></span>
            <span style="--i:13;"></span>
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:24;"></span>
            <span style="--i:18;"></span>
            <span style="--i:17;"></span>
            <span style="--i:15;"></span>
            <span style="--i:13;"></span>
            <span style="--i:11;"></span>
            <span style="--i:19;"></span>
            <span style="--i:15;"></span>
            <span style="--i:20;"></span>
        </div>
    </div>

</body>
</html>