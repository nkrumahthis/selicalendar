<?php

$thismonth = date('F, Y');
$daycount = date('t');

//getting the number of weeks
$weekcount = 0;
for ($i = 1; $i <= $daycount; $i += 7) {
    $weekcount++;
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
        <h1>Office Hours Sign Up</h1>
        <form id="studentform">
            <label for="studentname">Student name:</label>
            <input type="text" id="studentname" name="studentname">
            <label for="studentname">Student email:</label>
            <input type="text" id="studentemail" name="studentemail">
            <button type="submit" form="studentform" value="Submit">Submit</button>
            <button type="clear" form="studentform" value="clear">Clear</button>
        </form>
        <table id="calendar-table">
            <tr id="month">
                <th colspan="7"> <?php echo $thismonth ?></th>
            </tr>
            <tr id="weekdays">
                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </tr>
            <?php
            //get first day of the month
            $first = date('01-m-Y');
            $dayOfFirst = date("w", strtotime($first)); //get day of the week it is

            //add empty cells to beginning of the month
            $week = '';
            $week .= str_repeat('<td></td>', $dayOfFirst);

            //now start on weekday
            $weekday = $dayOfFirst;

            for ($day = 1; $day <= $daycount; $day++, $weekday++) {

                $week .= "<td>" . $day . "</td>";

                //if end of month or week ends, 
                if ($weekday % 7 == 6 || $day == $daycount) {
                    if ($day == $daycount) {
                        //add empty cell to table
                        $week .= str_repeat('<td></td>', 6 - ($weekday % 7));
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
    </div>

</body>

</html>