<?php

require '../bootloader.php';

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OOP</title>
        <link rel="stylesheet" href="media/css/normalize.css">
        <link rel="stylesheet" href="media/css/style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <script defer src="media/js/app.js"></script>
    </head>
    <body>
        <?php require ROOT . '/app/templates/navigation.tpl.php'; ?>

        <div class="content">
           <h1 class="vakaro-meniu">Kalvarkes</h1>            
     
           <?php require ROOT . '/core/templates/form/form.tpl.php'; ?> 
        </div>
    </body>
</html>