<?php

require '../bootloader.php';

if(!empty($_SESSION)) {
    $_SESSION = [];
}

header("Location: /login.php");