<?php
$weeks = array();
define("WEEKDAYS", ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]);

function drawSelectlist($dayOfWeek)
{
    echo ('<td><select name="' . $dayOfWeek . '[]" multiple size=15>');


    $index = 0;

    //add am time slots
    $hour = 7;
    while ($hour <= 22) {
        if ($hour < 12) $m = "am";
        else $m = "pm";

        if ($hour > 12) $h = $hour % 12;
        else $h = $hour;

        $slotId = "$dayOfWeek" . "[" . $index . "]";
        $index += 1;
        $timeoclock = "$h:00$m";

        echo ('<option value = "' . $timeoclock . '">' . $timeoclock . '</option>');

        if ($hour != 22) {
            $slotId = "$dayOfWeek" . "[" . $index . "]";
            $index += 1;
            $timeoclock = "$h:30$m";

            echo ('<option value = "' . $timeoclock . '">' . $timeoclock . '</option>');
        }

        $hour++;
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