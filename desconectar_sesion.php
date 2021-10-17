<?php
session_start();
$_SESSION["code"] = "";
session_destroy();
header("location: index.php");
