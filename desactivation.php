<?php
session_start();
// var_dump($_SESSION['mail']);
if (!isset($_SESSION['mail'])) {
    header("location: sign_in.html");
}
else {
    header("location: desactivation.html");
}