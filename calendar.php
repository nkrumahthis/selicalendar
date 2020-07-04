<?php

$thismonth = date('F, Y');
$daycount = date('t');
define("WEEKDAYS", ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]);
define("WHOLEWEEK", ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]);


//try to send mail
function sendmail($month, $pickedSlot)
{
    if (isset($_POST['studentname']) && isset($_POST['studentemail'])) {
        $to = "sseglah@gmu.edu";
        $subject = "My subject";
        $name = $_POST["studentname"];
        $txt = "Hello $name,
        This month of $month, you have set up an appointment at $pickedSlot";
        $headers = "From:" . $_POST['studentemail'];

        if (@mail($to, $subject, $txt, $headers)) {
            return "<p>Email Sent Successfully";
        } else {
            return "<p>Error when sending email";
        }
    } else {
        return "";
    }
}

function is_slot_picked($day, $slot)
{
    $found = false;

    $slots = $_POST['pickedslots'] ?? array();
    $slots[] = $_POST["slot"] ?? null;

    foreach ($slots as $value) {
        //slot information is stored in a sentence separated by spaces
        //for example 3 3:00am John

        $vals = explode(" ", $value);

        //0 is the day, 1 is the time, 2 is the name
        //but we need only day and time, ie 1 and 0 to check

        if ($vals[0] == $day && $slot == $vals[1]) {
            $found = true;
        }
    }
    return $found;
}

function get_picked_slot_info($day, $slot)
{
    $slots = $_POST['pickedslots'] ?? array();
    $slots[] = isset($_POST["slot"]) ? $_POST["slot"] . " " . $_POST["studentname"] : null;

    $thename = "";

    foreach ($slots as $value) {
        //slot information is stored in a sentence separated by spaces
        //for example 3 3:00am John

        $vals = explode(" ", $value);

        //0 is the day, 1 is the time, 2 is the name
        //but we need only day and time, ie 1 and 0 to check

        if ($vals[0] == $day && $slot == $vals[1]) {
            $thename = $vals[2];
        }
    }
    return $vals[1] . ' -- ' . $thename;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    for ($i = 0; $i < $daycount; $i++) {
        if (isset($_POST["day.$i"])) echo $_POST["day.$i"];
    }

    $pickedSlot = $_POST["slot"] ?? '';

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


    <a class="navbutton" href="index.php">👈 SETUP FORM</a>


    <div id="main">


        <h1>OFFICE HOURS SIGN UP</h1>

        <form id="studentform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="studentname">Student name:</label>
            <input type="text" id="studentname" name="studentname">
            <label for="studentname">Student email:</label>
            <input type="text" id="studentemail" name="studentemail">

            <button type="clear" form="studentform" value="clear" class="secondary">Clear</button>
            <button type="submit" form="studentform" value="Submit" class="primary">Submit</button>

            <p><?php echo $emailmessage ?? '' ?></p>


            <table class="calendar-table">
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

                    $dayentry = '<p class="day">' . $day . '</p>';

                    $aWeekDay = $dayOfWeek - 1;

                    if ($aWeekDay >= 0 && $aWeekDay < 5) {
                        $aWeekDayName = WEEKDAYS[$aWeekDay];

                        if (isset($_POST[$aWeekDayName])) {
                            foreach ($_POST[$aWeekDayName] as $slot) {

                                $val = "$day $slot";

                                $entry = '';

                                if (!is_slot_picked($day, $slot)) {
                                    $entry = '<input type="radio" name="slot" value="' . $val . '" id=">
                                    <label for="' . $slot . '" >' . $slot . '</label><br/>';
                                } else {
                                    $entry = '<label >' . get_picked_slot_info($day, $slot) . '</label><br/>';
                                }

                                $dayentry .= $entry;
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
            if (isset($_POST["slot"])) {
                echo '<input type="hidden" name="pickedslots[]" value="' . $_POST["slot"] . ' ' . $_POST["studentname"] . '">';
            }
            if (isset($_POST["pickedslots"]))
                foreach ($_POST["pickedslots"] as $oldslot)
                    echo '<input type="hidden" name="pickedslots[]" value="' . $oldslot . '">';

            ?>

        </form>
    </div>
    <div class="project-info">
        <strong>IT 207-B03, Summer 2020
            <br> George Mason University</strong>
        <br>
        <br><strong>Instructor: </strong>Erhan Uyar
        <br><strong>Student: </strong>Selinam Seglah
        <a href="mailto:sseglah@gmu.edu"> sseglah@gmu.edu </a>
        <br />
    </div>
    <div class="lastmodified">
        <br />
        <?php
        date_default_timezone_set('EST');
        echo "<strong>Last Modified: </strong>"
            . date("H:i F d, Y", getlastmod()), "EST";
        ?>
    </div>

</body>

</html>