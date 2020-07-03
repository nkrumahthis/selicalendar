<?php

$thismonth = date('F, Y');
$daycount = date('t');
define("WEEKDAYS", ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]);
define("WHOLEWEEK", ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]);


//try to send mail
function sendmail($month, $pickedSlot)
{
    if (isset($_POST['studentname']) && isset($_POST['studentemail'])) {
        $to = $_POST['studentemail'];
        $subject = "My subject";
        $name = $_POST["studentname"];
        $txt = "Hello $name,
        This month of $month, you have set up an appointment at $pickedSlot";
        $headers = "From: webmaster@example.com";

        if (@mail($to, $subject, $txt, $headers)) {
            return "<p>Email Sent Successfully";
        } else {
            return "<p>Error when sending email";
        }
    } else {
        return "";
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    for ($i = 0; $i < $daycount; $i++) {
        if (isset($_POST["day.$i"])) echo $_POST["day.$i"];
    }

    $pickedSlot = $_POST["slots"] ?? '';

    $emailmessage = sendmail($thismonth, $pickedSlot);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Office Hours Calendar</title>
</head>

<body>
    <a href="index.php">👈 SETUP FORM</a>
    <div id="main">
        <h1>Office Hours Sign Up</h1>
        <form id="studentform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="studentname">Student name:</label>
            <input type="text" id="studentname" name="studentname">
            <label for="studentname">Student email:</label>
            <input type="text" id="studentemail" name="studentemail">
            <button type="submit" form="studentform" value="Submit">Submit</button>
            <button type="clear" form="studentform" value="clear">Clear</button>
            <p><?php echo $emailmessage ?? '' ?></p>
            <table id="calendar-table">
                <tr id="month">
                    <th colspan="7"> <?php echo $thismonth ?></th>
                </tr>
                <tr id="wholeweek"><?php foreach (WHOLEWEEK as $dayOfWeek) echo "<th>$dayOfWeek</th>" ?></tr>
                <?php

                //get first day of the month
                $first = date('01-m-Y');
                $dayOfFirst = date("w", strtotime($first)); //get day of the week it is

                $week = '';

                //step 1: add empty cells to beginning of the month
                $week .= str_repeat('<td></td>', $dayOfFirst);

                //now start on weekday
                $weekday = $dayOfFirst;

                for ($day = 1; $day <= $daycount; $day++, $weekday++) {

                    $dayOfWeek = $weekday % 7;

                    $dayentry = '<p>' . $day . '</p>';

                    $aWeekDay = $dayOfWeek - 1;

                    if ($aWeekDay >= 0 && $aWeekDay < 5) {
                        $aWeekDayName = WEEKDAYS[$aWeekDay];

                        if (isset($_POST[$aWeekDayName])) {
                            foreach ($_POST[$aWeekDayName] as $slot) {
                                $radiobutton = '<input type="radio" name="slots" value="' . $slot . '">
                                    <label for="' . $slot . '">' . $slot . '</label><br>';
                                $dayentry .= $radiobutton;
                            }
                        }
                    }

                    $week .= "<td>$dayentry</td>";

                    //if end of month or week ends, 
                    if ($dayOfWeek == 6 || $day == $daycount) {
                        if ($day == $daycount) {
                            //add empty cell to table
                            $week .= str_repeat('<td></td>', 6 - $dayOfWeek);
                        }

                        //go to the next week
                        $weeks[] = '<tr>' . $week . '</tr>';

                        //fresh week
                        $week = '';
                    }
                }

                foreach ($weeks as $week) {
                    echo $week;
                }
                ?>
            </table>

            <?php
            //save data in hidden fields
            foreach (WEEKDAYS as $wkday)
                if (isset($_POST[$wkday]))
                    foreach ($_POST[$wkday] as $y) {
                        echo '<input type="hidden" name="' . $wkday . '[]" value="' . $y . '">';
                    }
            ?>

        </form>
    </div>

    <table>
        <?php


        foreach ($_POST as $key => $value) {
            echo "<tr>";
            echo "<td>";
            echo ($key);
            echo "</td>";
            echo "<td>";
            echo '<table style = "border: black solid 2px">';
            foreach ($value as $k => $v) {
                echo "<tr>";
                echo '<td style = "border: black solid 1px">>';
                echo ($k);
                echo "</td>";
                echo '<td style = "border: black solid 1px">>';
                print_r($v);
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</td>";
            echo "</tr>";
        }


        ?>
    </table>

</body>

</html>