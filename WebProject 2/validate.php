<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Roll Your Dice With US</title>
    <link href='project2.css' rel='stylesheet' type='text/css'>
</head>
<body>
<?php
session_start();
$_SESSION['exists'] = false;
if (isset($_POST['submit'])) {
    // initialize an error array
    $errors = array();
    // check if name is valid
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
        if (preg_match("/[0-9]/", $name) === 1) {
            $errors[] = "Name cannot be digits";
        }
        $words = explode(" ", $name);
        for ($i = 0; $i < count($words); $i++) {
            if (strcmp(ucfirst($words[$i]), $words[$i]) !== 0) {
                $errors[] = "First Letter must be capitalized";
                break;
            }
        }
    } else {
        $errors[] = "Name cannot be blank";
    }
    // check if email is valid
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email is not valid";
        }
    } else {
        $errors[] = "Email cannot be blank";
    }
    // display errors and go back to signup page
    if (count($errors) > 0) {
        echo '<div class="errorheading"><br>Please fix the following errors:<br></div>';
        foreach ($errors as $error) {
            echo '<div class="errorcontent">' . $error . '<br> </div>';
        }
        echo "<br><br><br><a href='index.php'>Go Back</a>";
        exit();
    }
    // if name and email exixts in login.txt returna variable to about.php
    $file = fopen("login.txt", "r");
    $_SESSION['name'] = $name;
    while (!feof($file)) {
        $line = fgets($file);
        $line = trim($line);
        $line = explode(",", $line);
        if ($line[0] == $name && $line[1] == $email) {
            $_SESSION['exists'] = true;
            break;
        }
    }
    fclose($file);
    // if name and email doesn't exist in login.txt add them to login.txt
    if (!$_SESSION['exists']) {
        $file = fopen("login.txt", "a");
        fwrite($file, $name . "," . $email . "\n");
        fclose($file);
    }

    //redirect to about.php
    header("Location: about.php");
}
?>
</body>
</html>

