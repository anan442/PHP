<?php
    session_start();
?>

<?php

    $sUser = $_GET["sUser"];

    $firstID = "chair";
    $firstPwd = "123";

    $secondID = "reviewer";
    $secondPwd = "234";

    $thirdID = "author";
    $thirdPwd = "345";

    $uID = $_GET["uID"];
    $uPwd = $_GET["uPwd"];

    if($firstID == $uID && $firstPwd == $uPwd && $sUser == $firstID){
        $_SESSION["check"] = "Chair";
        header("Location:chair.php");
    }
    else if($secondID == $uID && $secondPwd == $uPwd && $sUser == $secondID){
        $_SESSION["check"] = "Reviewer";
        header("Location:reviewer.php");
    }
    else if($thirdID == $uID && $thirdPwd == $uPwd && $sUser == $thirdID){
        $_SESSION["check"] = "Author";
        header("Location:author.php");
    }else{
        $_SESSION["check"] = "No";
        header("Location:fail.php");
    }
?>