<?php
include_once "multifun_database.php";
session_start();
if (!isset($_SESSION["session_first_name"]) || !isset($_SESSION["session_last_name"]) || !isset($_SESSION["session_username"]) || !isset($_SESSION["session_points"]) || !isset($_SESSION["session_color"])) {
    header("location: multifun_login.php");
    exit();
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
            <div class="webpage_name">HOME</div>
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
        <table id="home_table">
            <tr>
                <td>
                    <a id="lessons_icon" href="multifun_lessons.php">LESSONS</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a id="tests_icon" href="multifun_tests.php">TEST</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a id="calculator_icon" href="multifun_calculator.php">CALCULATOR</a>
                </td>
            </tr>
        </table>
    </body>
</html>