<?php
    session_start();
    session_destroy();
    $_SESSION["check"]="No";
    header("Location: index.php");
?>