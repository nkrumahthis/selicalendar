<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<form action="" method="post">
<input type="radio" name="radio" value="Radio 1">Radio 1
<input type="radio" name="radio" value="Radio 2">Radio 2
<input type="radio" name="radio" value="Radio 3">Radio 3
<input type="submit" name="submit" value="Get Selected Values" />
</form>
<?php
if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
echo "You have selected :".$_POST['radio'];  //  Displaying Selected Value
}
?>
</body>

</html>