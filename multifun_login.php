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
if (isset($_REQUEST["login_submit"])) {
    $row = mysqli_fetch_array(mysqli_query($multifun_database, "SELECT * FROM multifun_users WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_POST["login_username"]) . "';"));
    if (!empty($_POST["login_submit"]) && !empty($_POST["login_password"]) && $_POST["login_username"] === $row["user_username"] && password_verify($_POST["login_password"], $row["user_password"])) {
        session_start();
        $_SESSION["session_first_name"] = $row["user_first_name"];
        $_SESSION["session_last_name"] = $row["user_last_name"];
        $_SESSION["session_username"] = $row["user_username"];
        $_SESSION["session_points"] = $row["user_points"];
        $_SESSION["session_color"] = $row["user_color"];
        mysqli_close($multifun_database);
        header("location: multifun_home.php");
        exit();
    }
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
            <div class="webpage_name" style="margin-right: auto;">LOG-IN</div>
        </header>
        <h1 class="input_message">GET READY FOR MULTIFUN!</h1>
        <form class="input_form" method="post">
            <input name="login_username" class="input_field" type="text" placeholder="USERNAME" value="<?php echo $_POST["login_username"]; ?>">
            <?php
            if (isset($_REQUEST["login_submit"]) && empty($_POST["login_username"])) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>USERNAME FIELD IS EMPTY!</span>";
            }
            else if (isset($_REQUEST["login_submit"]) && $_POST["login_username"] !== $row["user_username"]) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>YOU GIVE THE WRONG USERNAME!</span>";
            }
            ?>
            <br><br>
            <input name="login_password" class="input_field" type="text" placeholder="PASSWORD" value="<?php echo $_POST["login_password"]; ?>">
            <?php
            if (isset($_REQUEST["login_submit"]) && empty($_POST["login_password"])) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>PASSWORD FIELD IS EMPTY!</span>";
            }
            else if (isset($_REQUEST["login_submit"]) && $_POST["login_username"] === $row["user_username"] && !password_verify($_POST["login_password"], $row["user_password"])) {
                echo "<br><span style='color: white; font-size: 1em; font-family: sans-serif; text-align: center;'>YOU GIVE THE WRONG PASSWORD!</span>";
            }
            ?>
            <br><br>
            <input name="login_submit" class="input_button" type="submit" value="LOG-IN">
            <a href="multifun_register.php"><button class="input_button" type="button">REGISTER</button></a>
        </form>
        <?php
        mysqli_close($multifun_database);
        echo "<h1>".$_SESSION["session_username"]."</h1>";
        ?>
    </body>
</html>