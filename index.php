<?php
$weeks = array();
define("WEEKDAYS", ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]);

function drawSelectlist($dayOfWeek)
{
    echo ('<td><select name="' . $dayOfWeek . '[]" multiple size=15>');

    //add am time slots
    for ($h = 7; $h <= 11; $h++) {
        for ($m = 0; $m <= 1; $m++) {
            $minutes = "";
            if ($m == 0) $minutes = "00";
            else $minutes = "30";

            $timecode = 't' . $h . $minutes . "am";
            $timeoclock = $h . ':' . $minutes . "am";

            echo ('<option value = "' . $timecode . '">' . $timeoclock . '</option>');
        }
    }
    //add midday time slot
    echo ('<option value=t1200pm>12:00pm</option>');

    //add pm time slots
    for ($h = 1; $h <= 10; $h++) {
        for ($m = 0; $m <= 1; $m++) {
            $minutes = "";
            if ($m == 0) $minutes = "00";
            else {
                if ($h == 10) break;
                $minutes = "30";
            }

            $timecode = 't' . $h . $minutes . "pm";
            $timeoclock = $h . ':' . $minutes . "pm";

            echo ('<option value = "' . $timecode . '">' . $timeoclock . '</option>');
        }
    }

    echo ("</select></td>");
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
    <div id="main">
        <h1>Office Hours Setup Form</h1>
        <form method='post' id='thisform' action="calendar.php">
            <table id="calendar-table">
                <tr id="weekdays">
                    <th>Day</th>
                    <?php foreach (WEEKDAYS as $dayOfWeek) echo "<th>$dayOfWeek</th>"; ?>
                </tr>
                <tr>
                    <td>
                        Day:
                    </td>

                    <?php

                    foreach (WEEKDAYS as $dayOfWeek) {
                        drawSelectlist($dayOfWeek);
                    }

                    ?>
                </tr>


            </table>
            <div id="buttons">
                <button type="clear" form="thisform" value="Clear">Clear</button>
                <button type="submit" form="thisform" value="Submit">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>