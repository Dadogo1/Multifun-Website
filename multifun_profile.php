<?php
include_once "multifun_database.php";
session_start();
if (!isset($_SESSION["session_first_name"]) || !isset($_SESSION["session_last_name"]) || !isset($_SESSION["session_username"]) || !isset($_SESSION["session_points"]) || !isset($_SESSION["session_color"])) {
    header("location: multifun_login.php");
    exit();
}
if (isset($_POST["submit_red"]) && $_SESSION["session_color"] !== "red" && $_SESSION["session_points"] >= 100) {
    $_SESSION["session_points"] -= 100;
    $_SESSION["session_color"] = "red";
    mysqli_query($multifun_database, "UPDATE multifun_users SET user_color='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_color"]) . "', user_points='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_points"]) . "' WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_SESSION["session_username"]) . "';");
    mysqli_close($multifun_database);
}
else if (isset($_POST["submit_blue"]) && $_SESSION["session_color"] !== "blue") {
    $_SESSION["session_points"] -= 100;
    $_SESSION["session_color"] = "blue";
    mysqli_query($multifun_database, "UPDATE multifun_users SET user_color='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_color"]) . "', user_points='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_points"]) . "' WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_SESSION["session_username"]) . "';");
    mysqli_close($multifun_database);
}
else if (isset($_POST["submit_yellow"]) && $_SESSION["session_color"] !== "yellow") {
    $_SESSION["session_points"] -= 100;
    $_SESSION["session_color"] = "yellow";
    mysqli_query($multifun_database, "UPDATE multifun_users SET user_color='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_color"]) . "', user_points='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_points"]) . "' WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_SESSION["session_username"]) . "';");
    mysqli_close($multifun_database);
}
else if (isset($_POST["submit_green"]) && $_SESSION["session_color"] !== "green") {
    $_SESSION["session_points"] -= 100;
    $_SESSION["session_color"] = "green";
    mysqli_query($multifun_database, "UPDATE multifun_users SET user_color='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_color"]) . "', user_points='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_points"]) . "' WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_SESSION["session_username"]) . "';");
    mysqli_close($multifun_database);
}
else if (isset($_POST["submit_orange"]) && $_SESSION["session_color"] !== "orange") {
    $_SESSION["session_points"] -= 100;
    $_SESSION["session_color"] = "orange";
    mysqli_query($multifun_database, "UPDATE multifun_users SET user_color='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_color"]) . "', user_points='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_points"]) . "' WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_SESSION["session_username"]) . "';");
    mysqli_close($multifun_database);
}
else if (isset($_POST["submit_indigo"]) && $_SESSION["session_color"] !== "indigo") {
    $_SESSION["session_points"] -= 100;
    $_SESSION["session_color"] = "indigo";
    mysqli_query($multifun_database, "UPDATE multifun_users SET user_color='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_color"]) . "', user_points='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_points"]) . "' WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_SESSION["session_username"]) . "';");
    mysqli_close($multifun_database);
}
else if (isset($_POST["submit_violet"]) && $_SESSION["session_color"] !== "violet") {
    $_SESSION["session_points"] -= 100;
    $_SESSION["session_color"] = "violet";
    mysqli_query($multifun_database, "UPDATE multifun_users SET user_color='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_color"]) . "', user_points='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_points"]) . "' WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_SESSION["session_username"]) . "';");
    mysqli_close($multifun_database);
}
else if (isset($_POST["submit_brown"]) && $_SESSION["session_color"] !== "brown") {
    $_SESSION["session_points"] -= 100;
    $_SESSION["session_color"] = "brown";
    mysqli_query($multifun_database, "UPDATE multifun_users SET user_color='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_color"]) . "', user_points='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_points"]) . "' WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_SESSION["session_username"]) . "';");
    mysqli_close($multifun_database);
}
?>
<!DOCTYPE html>
<html style="<?php echo "background-color: " . $_SESSION["session_color"] . ";"; ?>">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="multifun_style.css">
        <title>MULTIFUN</title>
    </head>
    <body>
        <header class="webpage_header">
            <a class="home_link" href="multifun_home.php">MULTIFUN</a>
            <div class="webpage_name">PROFILE</div>
            <table class="user_display">
                <tr>
                    <td>
                        <div class="user_points"><?php echo $_SESSION["session_points"]; ?></div>
                    </td>
                    <th>
                        <a class="user_link" href="multifun_profile.php"><?php echo $_SESSION["session_username"]; ?></a>
                    </th>
                </tr>
                <tr>
                    <td colspan="2">
                        <a class="user_logout" href="multifun_logout.php">LOGOUT</a>
                    </td>
                </tr>
            </table>
        </header>
        <h1 id="name_label"><?php echo $_SESSION["session_first_name"] . " " . $_SESSION["session_last_name"];?></h1>
        <form id="backgrounds_form" method="post">
            <table id="user_backgrounds">
                <tr>
                    <th colspan="2">
                        <div class="backgrounds_label">BACKGROUNDS</div>
                    </th>
                </tr>
                <tr>
                    <td>
                        <input name="submit_red" id="red_background" class="background_selector" type="submit" value="<?php if($_SESSION["session_color"] === "red") { echo "SELECTED";} else { echo "100";} ?>">
                    </td>
                    <td>
                        <input name="submit_blue" id="blue_background" class="background_selector" type="submit" value="<?php if($_SESSION["session_color"] === "blue") { echo "SELECTED";} else { echo "100";} ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="submit_yellow" id="yellow_background" class="background_selector" type="submit" value="<?php if($_SESSION["session_color"] === "yellow") { echo "SELECTED";} else { echo "100";} ?>">
                    </td>
                    <td>
                        <input name="submit_green" id="green_background" class="background_selector" type="submit" value="<?php if($_SESSION["session_color"] === "green") { echo "SELECTED";} else { echo "100";} ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="submit_orange" id="orange_background" class="background_selector" type="submit" value="<?php if($_SESSION["session_color"] === "orange") { echo "SELECTED";} else { echo "100";} ?>">
                    </td>
                    <td>
                        <input name="submit_indigo" id="indigo_background" class="background_selector" type="submit" value="<?php if($_SESSION["session_color"] === "indigo") { echo "SELECTED";} else { echo "100";} ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="submit_violet" id="violet_background" class="background_selector" type="submit" value="<?php if($_SESSION["session_color"] === "violet") { echo "SELECTED";} else { echo "100";} ?>">
                    </td>
                    <td>
                        <input name="submit_brown" id="brown_background" class="background_selector" type="submit" value="<?php if($_SESSION["session_color"] === "brown") { echo "SELECTED";} else { echo "100";} ?>">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>