<?php
include_once "multifun_database.php";
session_start();
if (!isset($_SESSION["session_first_name"]) || !isset($_SESSION["session_last_name"]) || !isset($_SESSION["session_username"]) || !isset($_SESSION["session_points"]) || !isset($_SESSION["session_color"])) {
    header("location: multifun_login.php");
    exit();
}
if (isset($_POST["test_1"])) {
    $_SESSION["test"] = 1;
    $_SESSION["test_question"] = 1;
}
else if (isset($_POST["school_submit"]) && (!empty($_POST["answer_input"]) || $_POST["answer_input"] === "0") && $_POST["answer_input"] == $_SESSION["test_variable_1"] * $_SESSION["test_variable_2"]) {
    $_SESSION["test_question"] += 1;
    $_SESSION["test_correct_answer"] += 1;
    unset($_SESSION["test_variable_1"]);
    unset($_SESSION["test_variable_2"]);
}
else if (isset($_POST["school_submit"]) && (!empty($_POST["answer_input"]) || $_POST["answer_input"] === "0")) {
    $_SESSION["test_question"] += 1;
    unset($_SESSION["test_variable_1"]);
    unset($_SESSION["test_variable_2"]);
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
            <div class="webpage_name">TESTS</div>
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
                    <th>
                        <input name="test_1" class="work_selector" type="submit" style="<?php if ($_SESSION["test_question"] > 0 && $_SESSION["test_question"] < 11) { echo "pointer-events: none;"; } ?>" value="SINGLE DIGIT">
                    </th>
                </tr>
                <?php
                if ($_SESSION["test_question"] > 0 && $_SESSION["test_question"] < 11) {
                ?>
                <tr>
                    <th>
                        <?php echo "<div class='school_page_index'>QUESTION " . $_SESSION["test_question"] . "</div>"; ?>
                    </th>
                </tr>
                <?php
                }
                 switch ($_SESSION["test"]) {
                    default:
                ?>
                <tr>
                    <td colspan="2">
                        <h1 class="input_message">WELCOME TO MULTIFUN LESSONS!</h1>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>PLEASE PICK A TEST TO START!</p>
                    </td>
                </tr>
                <?php
                        break;
                    case 1:
                        if ($_SESSION["test_question"] < 11) {
                            if (!isset($_SESSION["test_variable_1"]) || !isset($_SESSION["test_variable_2"])) {
                                $_SESSION["test_variable_1"] = rand(0, 9);
                                $_SESSION["test_variable_2"] = rand(0, 9);   
                            }
                ?>
                <tr>
                    <td colspan="2">
                        <table class="question_table">
                            <tr>
                                <th></th>
                                <th>
                                    <div class='variable'><?php echo $_SESSION["test_variable_1"]?></div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="multiply_symbol">x</div>
                                </th>
                                <th>
                                    <div class="variable"><?php echo $_SESSION["test_variable_2"]?></div>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <input class="multiply_bar" type="button">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <input name="answer_input" class="school_answer" type="tel"  placeholder="YOUR ANSWER">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <input name="school_submit" class="school_button" type="submit" value="ANSWER">
                                </th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
                        }
                        else {
                ?>
                <tr>
                    <th colspan="2">
                        <p>
                            THIS IS THE END OF THE TEST!
                        </p>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        <div class="big_result">
                            <?php echo (($_SESSION["test_correct_answer"] / 10) * 100) . "%";?>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        <div class="big_result">
                            <?php
                            if ($_SESSION["test_correct_answer"] / 10 < 0.7) {
                                echo "PRACTICE MORE!";
                            }
                            else if ($_SESSION["test_correct_answer"] / 10 < 0.8) {
                                echo "OK!";
                            }
                            else if ($_SESSION["test_correct_answer"] / 10 < 0.9) {
                                echo "GOOD!";
                            }
                            else if ($_SESSION["test_correct_answer"] / 10 < 1) {
                                echo "GREAT!";
                            }
                            else if ($_SESSION["test_correct_answer"] / 10 >= 1) {
                                echo "AMAZING!";
                            }
                            ?>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        <p>
                            <?php echo "YOU EARNED " .  $_SESSION["test_correct_answer"] . " POINTS";?>
                        </p>
                    </th>
                </tr>
                <?php
                            $_SESSION["session_points"] += $_SESSION["test_correct_answer"];
                            mysqli_query($multifun_database, "UPDATE multifun_users SET user_points='" . mysqli_real_escape_string($multifun_database, $_SESSION["session_points"]) . "' WHERE user_username LIKE '" . mysqli_real_escape_string($multifun_database, $_SESSION["session_username"]) . "';");
                            mysqli_close($multifun_database);
                            $_SESSION["test"] = 0;
                            $_SESSION["test_question"] = 0;
                            $_SESSION["test_correct_answer"] = 0;
                        }
                        break;
                }
                ?>
            </table>
        </form>
    </body>
</html>