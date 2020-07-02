<?php
$weeks = array();
for ($weekday = 1; $weekday <= 7; $weekday++) {
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
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                </tr>
                <tr>
                    <td>
                        Day:
                    </td>
                    <td>
                        <select name="mondaytimes" multiple size=15>
                            <?php
                            for ($h = 7; $h <= 11; $h++) {
                                for ($m = 0; $m <= 1; $m++) {
                                    $minutes = "";
                                    if ($m == 0) $minutes = "00";
                                    else $minutes = "30";

                                    $timecode = 't' . $h . $minutes . "am";
                                    $timeoclock = $h . ':' . $minutes . "am";

                                    echo ('<option value = "t' . $timecode . '">' . $timeoclock . '</option>');
                                }
                            }
                            echo ('<option value=t1200pm>12:00pm</option>');
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

                                    echo ('<option value = "t' . $timecode . '">' . $timeoclock . '</option>');
                                }
                            }
                            ?>
                        </select>

                    </td>
                    <td>
                        <select name="tuesdaytimes" multiple size=15>
                            <?php
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
                            echo ('<option value=t1200pm>12:00pm</option>');
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
                            ?>
                        </select>

                    </td>
                    <td>
                        <select name="wednesdaytimes" multiple size=15>
                            <?php
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
                            echo ('<option value=t1200pm>12:00pm</option>');
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
                            ?>
                        </select>

                    </td>
                    <td>
                        <select name="thursdaytimes" multiple size=15>
                            <?php
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
                            echo ('<option value=t1200pm>12:00pm</option>');
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
                            ?>
                        </select>

                    </td>
                    <td>
                        <select name="fridaytimes" multiple size=15>
                            <?php
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
                            echo ('<option value=t1200pm>12:00pm</option>');
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
                            ?>
                        </select>

                    </td>
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