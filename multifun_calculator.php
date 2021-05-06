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
            <div class="webpage_name">CALCULATOR</div>
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
        <form method="post">
            <table class="school_table">
                <tr>
                    <td>
                        <input name="calculate_input_1" class="school_answer" type="tel" placeholder="MULTIPLIER" value="<?php echo $_POST["calculate_input_1"]; ?>">
                    </td>
                    <td>
                        <input name="calculate_submit" id="multiply_button" type="submit" value="X">
                    </td>
                    <td>
                        <input name="calculate_input_2" class="school_answer" type="tel" placeholder="MULTIPLICAND" value="<?php echo $_POST["calculate_input_2"]; ?>">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if (isset($_POST["calculate_submit"]) && (!empty($_POST["calculate_input_1"]) || $_POST["calculate_input_1"] === "0") && (!empty($_POST["calculate_input_2"]) || $_POST["calculate_input_2"] === "0")) {
        ?>
        <table class="calculation_table">
            <tr>
                <th colspan="2">
                    <div id="calculate_answer">
                        <?php echo (int)$_POST["calculate_input_1"] * (int)$_POST["calculate_input_2"];?>
                    </div>
                </th>
            </tr>
            <tr>
                <th>
                    <div class="calculation_label">
                        STEP
                    </div>
                </th>
                <th>
                    <div class="calculation_label">
                        COUNT
                    </div>
                </th>
            </tr>
        <?php
                for ($a = 0; $a <= (int)$_POST["calculate_input_2"]; $a++) {
        ?>
        <tr>
            <td>
                <div class="calculation_output">
                    <?php echo $a . ":"; ?>
                </div>
            </td>
            <td>
                <div class="calculation_output">
                    <?php
                    if ($a > 0) {
                        $counter += (int)$_POST["calculate_input_1"];
                        echo $counter;
                    }
                    else {
                        $counter = 0;
                        echo $counter;
                    }
                    ?>
                </div>
            </td>
        </tr>
        <?php                
                }
            }
        ?>
        </table>
    </body>
</html>