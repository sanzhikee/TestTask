<?php
/**
 * Created by PhpStorm.
 * User: Sarsenbi.S
 * Date: 29.01.2018
 * Time: 15:30
 *
 * @var Controller $this
 * @var string $content
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?=$content?>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>

