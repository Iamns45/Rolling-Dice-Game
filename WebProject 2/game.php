<?php
session_start();

if (!isset($_SESSION['exists'])) {
    header("Location: index.php");
    exit;
}

$prev_value = 0;
$_SESSION['dice'] = '0';
function throw_dice(): int
{
    $dice = rand(1, 6);
    $_SESSION['dice'] = $dice;
    return $dice;
}

$player_turn = $_POST["player_turn"] ?? 1;
$win = false;
$is_initial_load = true;

if (isset($_POST["user_guess"])) {
    if ($player_turn == 1) {
        $player_turn = 2;

        $players = [
            ["name" => $_POST["player_1_name"], "score" => throw_dice() + $_SESSION['players'][0]["score"]],
            ["name" => $_POST["player_2_name"], "score" => $_SESSION['players'][1]["score"]]
        ];
        if ($players[0]["score"] > 100) {
            $players = [
                ["name" => $_POST["player_1_name"], "score" => +$_SESSION['players'][0]["score"]],
                ["name" => $_POST["player_2_name"], "score" => $_SESSION['players'][1]["score"]]
            ];
        }
    } else {
        $player_turn = 1;

        $players = [
            ["name" => $_POST["player_1_name"], "score" => $_SESSION['players'][0]["score"]],
            ["name" => $_POST["player_2_name"], "score" => throw_dice() + $_SESSION['players'][1]["score"]],
        ];
        if ($players[1]["score"] > 100) {
            $players = [
                ["name" => $_POST["player_1_name"], "score" => +$_SESSION['players'][0]["score"]],
                ["name" => $_POST["player_2_name"], "score" => $_SESSION['players'][1]["score"]]
            ];
        }
    }
    $_SESSION['players'] = $players;
    $is_initial_load = false;
} else if (isset($players)) {
    $players[$player_turn - 1]["score"] += $players[$player_turn - 1]["score"];
} else if (isset($_GET["start"])) {
    $players = [
        ["name" => $_GET["player_1_name"], "score" => 0],
        ["name" => $_GET["player_2_name"], "score" => 0],
    ];
    $is_initial_load = false;
    $_SESSION['players'] = $players;
    $_SESSION['level'] = $_GET["level"];
    //print_r( $_SESSION['players']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Rolling Dice</title>
    <link href='game.css' rel='stylesheet' type='text/css'>
</head>
<body>
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
    <li><a class="active" href="game.php">Game</a></li>
    <li><a href="Leaderboard_gui.php">Leaderboard</a></li>
</ul>

<?php if (!$is_initial_load) : ?>

    <form id="main" action="game.php" method="post">
        <div id="container">
            <div id="game">
                <?php
                $rows = 10;
                $cols = 10;
                $count = 100;
                $no = 12;

                if ($_SESSION["level"] == "Medium") {
                    $no = 8;
                } else if ($_SESSION["level"] == "Hard") {
                    $no = 6;
                }

                echo "<table border='1' align='center'>";

                for ($tr = 1; $tr <= $rows; $tr++) {

                    echo "<tr >";
                    for ($td = 1; $td <= $cols; $td++) {


                        if ($count % $no == 0) {
                            echo "<td  id='danger'>" . $count . "</td>";
                            if ($count == $_SESSION['players'][0]["score"]) {

                                $players = [
                                    ["name" => $_POST["player_1_name"], "score" => $_SESSION['players'][0]["score"] - 5],
                                    ["name" => $_POST["player_2_name"], "score" => $_SESSION['players'][1]["score"]]
                                ];
                                $_SESSION['players'] = $players;
                                $_SESSION['dice'] = $_SESSION['dice'] . ". Danger!! " . $players[0]["name"] . "'s score was reduced by 5 positions ";
                            }
                            if ($count == $_SESSION['players'][1]["score"]) {
                                $players = [
                                    ["name" => $_POST["player_1_name"], "score" => $_SESSION['players'][0]["score"]],
                                    ["name" => $_POST["player_2_name"], "score" => $_SESSION['players'][1]["score"] - 5]
                                ];
                                $_SESSION['players'] = $players;
                                $_SESSION['dice'] = $_SESSION['dice'] . ". Danger!! " . $players[0]["name"] . "'s score was reduced by 5 positions";
                            }
                        } else {
                            if ($count == $_SESSION['players'][0]["score"] && $count == $_SESSION['players'][1]["score"])
                                echo "<td width='80px' height='40px' align='center' bgcolor='yellow'>" . $_SESSION['players'][0]["name"] . "\n" . $_SESSION['players'][1]["name"] . "</td>";
                            else if ($count == $_SESSION['players'][0]["score"]) {
                                if ($count == 100) {
                                    $win = true;
                                    $_SESSION['dice'] = $_SESSION['dice'] . ", " . $_SESSION['players'][0]["name"] . "  Wins!";

                                    $content = "\n" . $_SESSION['players'][0]["name"];
                                    $file = fopen("Scores.txt", "a");
                                    fwrite($file, $content);
                                    fclose($file);
                                }
                                echo "<td width='80px' height='40px' align='center'  bgcolor='green'>" . $_SESSION['players'][0]["name"] . "</td>";
                            } else if ($count == $_SESSION['players'][1]["score"]) {
                                if ($count == 100) {
                                    $win = true;
                                    $_SESSION['dice'] = $_SESSION['dice'] . ", " . $_SESSION['players'][1]["name"] . "  Wins!";

                                    $content = "\n" . $_SESSION['players'][1]["name"];
                                    $file = fopen("Scores.txt", "a");
                                    fwrite($file, $content);
                                    fclose($file);
                                }
                                echo "<td width='80px' height='40px' align='center' bgcolor='cyan'>" . $_SESSION['players'][1]["name"] . "</td>";
                            } else
                                echo "<td width='80px' height='40px' align='center'>" . $count . "</td>";
                        }
                        $count--;
                    }
                    echo "</tr>";
                }

                echo "</table>";
                ?>
            </div>
        </div>
        <?php


        if (isset($players)) {
            echo "<input hidden name=\"player_1_name\" type=\"text\" value=\"" . $players[0]["name"] . "\">";
            echo "<input hidden name=\"player_2_name\" type=\"text\" value=\"" . $players[1]["name"] . "\">";
            echo "<input hidden name=\"player_1_score\" type=\"text\" value=\"" . $players[0]["score"] . "\">";
            echo "<input hidden name=\"player_2_score\" type=\"text\" value=\"" . $players[1]["score"] . "\">";
        }

        echo "<input hidden name=\"player_turn\" type=\"text\" value=\"$player_turn\">";
        ?>

        <div id="player_1_gui">
            <div id="player_1_gui">
                <section class="skewed">
                    <span>Scoreboard</span>
                </section>
                <div id="player1">
                    <?php
                    $player_being_configured = 1;
                    include "player_gui.php" ?>
                </div>
            </div>
            <div>
                <h1 id="show"><?php if (isset($_SESSION['dice']))
                        echo "You got a " . $_SESSION['dice'];
                    ?>
                </h1>
            </div>
            <div id="player_2_gui">
                <div id="player2">
                    <?php
                    $player_being_configured = 2;
                    include "player_gui.php" ?>
                </div>
            </div>
        </div>
    </form>

<?php else: ?>
    <div>
        <form action="game.php" method="get">
            <div class="header">
                <p style="font-family: Cursive; color: darkorange;">Rolling Dice</p>
            </div>
            <br>
            <div id="names">
                <input type="text" class="button" id="name" required name="player_1_name" placeholder="Player 1 Name">
                <input type="text" class="button" id="name" required name="player_2_name" placeholder="Player 2 Name"/>
                <strong>Choose a difficulty level:</strong>
                <select name="level" id="level">
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                </select>
            </div>
            <br>
            <br>
            <input type="submit" id="submit" class="inputbutton" value="Start" name="start">
        </form>
    </div>

<?php endif; ?>
</body>
</html>
