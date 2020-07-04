<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="t[]" id="">
        <?php
        if (isset($_POST["t"]))
            foreach ($_POST["t"] as $t)
                echo ('<input name = "t[]" type="text" value="' . $t . '">');
        ?>
        <input type="submit" value="submit">
    </form>
</body>

</html>