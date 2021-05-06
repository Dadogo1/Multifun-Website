<?php
include_once "multifun_database.php";
session_start();
if (isset($_SESSION["session_first_name"]) || isset($_SESSION["session_last_name"]) || isset($_SESSION["session_username"]) || isset($_SESSION["session_points"]) || isset($_SESSION["session_color"])) {
    header("location: multifun_home.php");
    exit();
}
else {
     $_SESSION = array();
    setcookie(session_name(), "", time() - 3600);
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="multifun_style.css">
        <title>MULTIFUN</title>
    </head>
    <body>
        <header class="webpage_header">
            <a class="home_link" href="multifun_home.php" style="pointer-events: none;">MULTIFUN</a>
            <div class="webpage_name" style="margin-right: auto;">REGISTER</div>
        </header>
        <h1 class="input_message">INPUT YOUR INFORMATION</h1>
        <form class="input_form" method="post">
            <input name="create_first_name" class="input_field" type="text" placeholder="FIRST NAME" value="<?php echo $_POST["create_first_name"]; ?>">
            <?php
            if (isset($_POST["create_submit"]) && empty($_POST["create_first_name"])) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>FIRST NAME FIELD IS EMPTY!</span>";
            }
            else if (isset($_POST["create_submit"]) && !preg_match("/^[A-Z]{1}[a-z]*$/", $_POST["create_first_name"])) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>FIRST NAME FIELD MUST START WITH A CAPITAL LETTER AND THE REST OF THE LETTERS MUST BE LOWER CASE!</span>";
            }
            ?>
            <br><br>
            <input name="create_last_name" class="input_field" type="text" placeholder="LAST NAME" value="<?php echo $_POST["create_last_name"]; ?>">
            <?php
            if (isset($_POST["create_submit"]) && empty($_POST["create_last_name"])) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>LAST NAME FIELD IS EMPTY!</span>";
            }
            else if (isset($_POST["create_submit"]) && !preg_match("/^[A-Z]{1}[a-z]*$/", $_POST["create_last_name"])) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>LAST NAME FIELD MUST START WITH A CAPITAL LETTER AND THE REST OF THE LETTERS MUST BE LOWER CASE!</span>";
            }
            ?>
            <br><br>
            <input name="create_username" class="input_field" type="text" placeholder="USERNAME" value="<?php echo $_POST["create_username"]; ?>">
            <?php
            if (isset($_POST["create_submit"]) && empty($_POST["create_username"])) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>USERNAME FIELD IS EMPTY!</span>";
            }
            else if (isset($_POST["create_submit"]) && mysqli_num_rows(mysqli_query($multifun_database, "SELECT * FROM multifun_users WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_POST["create_username"]) . "';")) > 0){
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>PLEASE TRY A DIFFERENT USERNAME BECAUSE IT IS ALREADY BEEN USED!</span>";
            }
            ?>
            <br><br>
            <input name="create_password" class="input_field" type="text" placeholder="PASSWORD" value="<?php echo $_POST["create_password"]; ?>">
            <?php
            if (isset($_POST["create_submit"]) && empty($_POST["create_password"])){
                    echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>PASSWORD FIELD IS EMPTY!</span>";
            }
            else if (isset($_POST["create_submit"]) && !preg_match("/^(?=.*?[A-Za-z_])(?=.*?\d)(?=.*?\W).{5,}$/", $_POST["create_password"])) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>PASSWORD FIELD MUST BE AT LEAST 5 CHARCTERS AND CONTAIN A LETTER, NUMBER, AND SYMBLOL!</span>";
            }
            ?>
            <br><br>
            <a href="multifun_login.php"><button class="input_button" type="button">GO BACK</button></a>
            <input name="create_submit" class="input_button" type="submit" value="CREATE">
        </form>
        <?php
        if (isset($_POST["create_submit"]) && !empty($_POST["create_first_name"]) && !empty($_POST["create_last_name"]) && !empty($_POST["create_username"]) && !empty($_POST["create_password"]) && preg_match("/^[A-Z]{1}[a-z]*$/", $_POST["create_first_name"]) && preg_match("/^[A-Z]{1}[a-z]*$/", $_POST["create_last_name"]) && mysqli_num_rows(mysqli_query($multifun_database, "SELECT * FROM multifun_users WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_POST["create_username"]) . "';")) <= 0 && preg_match("/^(?=.*?[A-Za-z])(?=.*?\d)(?=.*?\W).{5,}$/", $_POST["create_password"])) {
                mysqli_query($multifun_database, "INSERT INTO multifun_users (user_first_name, user_last_name, user_username, user_password, user_color, user_points) VALUES ('" . mysqli_real_escape_string($multifun_database, $_POST["create_first_name"]) . "', '". mysqli_real_escape_string($multifun_database, $_POST["create_last_name"]) . "', '" . mysqli_real_escape_string($multifun_database, $_POST["create_username"]) . "', '" . mysqli_real_escape_string($multifun_database, password_hash($_POST["create_password"], PASSWORD_DEFAULT)) . "', '" . mysqli_real_escape_string($multifun_database, "red") ."', '" . mysqli_real_escape_string($multifun_database, "0") . "');");
                echo "<h2 style='color: white; font-family: sans-serif; text-align: center'>YOU DID IT!</h2>";
                echo "<h4 style='color: white; font-family: sans-serif; text-align: center'>NOW GO BACK AND LOG-IN WITH YOUR NEW USERNAME AND PASSWORD</h4>";
        }
        mysqli_close($multifun_database);
        ?>
    </body>
</html>