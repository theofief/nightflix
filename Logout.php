<?php
require("header.php");

session_destroy();
$_SESSION = [];
echo "<script>window.location.href='index.php'</script>";
