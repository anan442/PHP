<?php
    if($_POST["sName"] != "")
    {
        $sName = $_POST["sName"];
        echo "姓名：$sName<br>";

        $stuID = $_POST["stuID"];
        echo "學號：$stuID<br>";

        $sGender = $_POST["sGender"];
        echo "性別：$sGender<br>";

        $sGrade = $_POST["sGrade"];
        echo "系級：$sGrade<br>";

        $sEmail = $_POST["sEmail"];
        echo "e-mail：$sEmail<br>";


        $sTime = $_POST["sTime"];
        echo "欲參加時段： $sTime<br>";

        $sSelect = $_POST["sSelect"];
        echo "交通方式：";
        foreach($sSelect as $value){
            echo $value;
        }
        
        $sTextarea = $_POST["sTextarea"];
        echo "<br>其他問題：$sTextarea<br>";
    }
    else
    {
        echo "Please Enter your name!";
    }
?>