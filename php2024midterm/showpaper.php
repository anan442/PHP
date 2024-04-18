<?php
    include("include.inc")
?>

<?php
    session_start();

    if(isset($_SESSION["check"])){
        if($_SESSION["check"] == "Author"){
            echo "<h1>Author您好，歡迎進入論文評論網頁</h1>";
        }else{
            header("Refresh:0;url=fail.php");
        }
    }else{
        header("Refresh:0;url=fail.php");
    }
    if (isset($_GET["logout"])) {
        header("Location:logout.php");
    }

    if (isset($_GET["logout"])) {
        header("Location:logout.php");
    }
?>

<?php
$sTitle = $_GET["sTitle"];
echo "論文標題：$sTitle<br>";

$sName = $_GET["sName"];
echo "作者姓名：$sName<br>";

$sEmail = $_GET["sEmail"];
echo "作者Email：$sEmail<br>";

$sTextarea = $_GET["comment"];
echo "<br>論文摘要：$sTextarea<br>";
?>

<form method = "get">
    <input type="submit" name="logout" value="登出">
</form>