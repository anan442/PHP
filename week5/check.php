<?php
    session_start();
?>

<?php

    $sID = "nukim2486";
    $sPwd = "qwer";

    $uID = $_GET["uID"];
    $uPwd = $_GET["uPwd"];

    if($sID == $uID && $sPwd == $uPwd){
        $_SESSION["check"] = "Yes";
        header("Location:success.php");
    }else{
        $_SESSION["check"] = "No";
        header("Location:fail.php");
    }
?>