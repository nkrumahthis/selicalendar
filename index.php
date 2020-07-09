<?php
/*
Author: Selinam Seglah
*/


$weeks = array();
const WEEKDAYS = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

function drawSelectlist($dayOfWeek)
{
    echo ('<td><select name="' . $dayOfWeek . '[]" multiple size=15>');

    //add am time slots
    $hour = 7;
    while ($hour <= 22) {

        $m = ($hour < 12) ? "am" : "pm";
        $h = ($hour > 12) ?  $hour % 12 : $hour;
        echo ('<option value = "' . "$h:00$m" . '">' . "$h:00$m" . '</option>');
        echo ($hour != 22) ? ('<option value = "' . "$h:30$m" . '">' . "$h:30$m" . '</option>') : ('');


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
            <table class="calendar-table">
                <tr id="weekdays">
                    <th>Day</th>
                    <?php foreach (WEEKDAYS as $dayOfWeek) echo "<th>$dayOfWeek</th>"; ?>
                </tr>
                <tr>
                    <td class="row-title">
                        Time:
                    </td>

                    <?php

                    foreach (WEEKDAYS as $dayOfWeek) {
                        drawSelectlist($dayOfWeek);
                    }

                    ?>
                </tr>


            </table>
            <div class="buttons">
                <button type="clear" form="thisform" value="Clear" class="secondary">Clear</button>
                <button type="submit" form="thisform" value="Submit" class="primary">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>