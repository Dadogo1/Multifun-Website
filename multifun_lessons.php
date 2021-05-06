<?php
include_once "multifun_database.php";
session_start();
if (!isset($_SESSION["session_first_name"]) || !isset($_SESSION["session_last_name"]) || !isset($_SESSION["session_username"]) || !isset($_SESSION["session_points"]) || !isset($_SESSION["session_color"])) {
    header("location: multifun_login.php");
    exit();
}
if (isset($_POST["lesson_1"])) {
    $_SESSION["lesson"] = 1;
    $_SESSION["lesson_page"] = 1;
}
else if (isset($_POST["school_submit"]) && $_POST["answer_input"] == 2 * 2) {
    $_SESSION["lesson_page"] += 1;
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
            <div class="webpage_name">LESSONS</div>
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
                        <input name="lesson_1" class="work_selector" type="submit" value="SINGLE DIGIT">
                    </th>
                </tr>
                <?php
                if ($_SESSION["lesson_page"] > 0) {
                ?>
                <tr>
                    <th>
                        <?php echo "<div class='school_page_index'>PAGE " . $_SESSION["lesson_page"] . "</div>"; ?>
                    </th>
                </tr>
                <?php
                }
                switch ($_SESSION["lesson"]) {
                    default:
                ?>
                <tr>
                    <td colspan="2">
                        <h1 class="input_message">WELCOME TO MULTIFUN LESSONS!</h1>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>PLEASE PICK A LESSSON YOU WANT TO LEARN!</p>
                    </td>
                </tr>
                <?php
                        break;
                    case 1:
                        switch ($_SESSION["lesson_page"]) {
                            case 1:
                ?>
                <tr>
                    <td colspan="2">
                        <table class="question_table">
                            <tr>
                                <th></th>
                                <th>
                                    <div class='variable'>2</div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="multiply_symbol">x</div>
                                </th>
                                <th>
                                    <div class="variable">2</div>
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
                            <?php
                            if (isset($_POST["school_submit"]) && $_POST["answer_input"] != 2 * 2) {
                            ?>
                            <tr>
                                <td colspan="2">
                                    <div class="lesson_response">TRY AGAIN!</div>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>🟥 🟥  + 🟦 🟦</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="teacher_comment">IN THIS PROBLEM THER ARE TWO NUMBERS WHICH ARE 2 TIMES 2. YOU THINK OF THEM AS HAVING TWO GROUPS OF BOXES AND EACH GROUP CONTAINS TWO BOXES. IF YOU ADD ALL THE BOXES TOGETHER HOW MUCH WILL IT BE?</p>
                    </td>
                </tr>
                <?php
                                break;
                            case 2:
                ?>
                <tr>
                    <th colspan="2">
                        <div class="input_message">
                            GOOD JOB, THIS IS THE END OF THE LESSON!
                        </div>
                    </th>
                </tr>
                <?php
                                $_SESSION["lesson"] = 0;
                                $_SESSION["lesson_page"] = 0;
                                break;
                        }
                        break;
                }
                ?>
            </table>
            
        </form>
    </body>
</html>