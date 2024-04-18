<?php
    include("include.inc")
?>

<?php
    session_start();

    if(isset($_SESSION["check"])){
        if($_SESSION["check"] == "Reviewer"){
            echo "<h1>Reviewer您好，歡迎進入論文評論網頁</h1>";
        }else{
            header("Refresh:0;url=fail.php");
        }
    }else{
        header("Refresh:0;url=fail.php");
    }

    if (isset($_GET["logout"])) {
        header("Location:logout.php");
    }

    if(isset($_GET["comment"])){
        echo addslashes(nl2br($_POST["comment"]));
    }
?>

<?php
$sSelect = $_GET["sSelect"];
echo "論文評審決定：$sSelect<br>";

$sTextarea = $_GET["comment"];
echo "<br>論文評論評語：$sTextarea<br>";
?>

<form method = "get">
    <input type="submit" name="logout" value="登出">
</form>




