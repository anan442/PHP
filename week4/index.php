<html>
    <head>
        <meta charset = "utf-8">
        <title>資管系晚會報名表</title>
    </head>

    <body>
        <center><h1>資管系晚會報名表</h1></center><hr>
    </body>
    
    <form action = "result.php" method = "post">
        姓名: <input tpye = "text" name = "sName" value = "" placeholder = "Enter your name" required><br><br>
        學號： <input type = "text" name = "stuID" vaule = "" required><br><br>
        
        性別：
        <input type = "radio" name = "sGender" value = "男" checked>男
        <input type = "radio" name = "sGender" value = "女">女<br><br>

        系級：
        <input type = "radio" name = "sGrade" value = "116" checked>116
        <input type = "radio" name = "sGrade" value = "115">115
        <input type = "radio" name = "sGrade" value = "114">114
        <input type = "radio" name = "sGrade" value = "113">113<br><br>

        Email: <input type = "email" name = "sEmail" value = "" required><br><br> 

        <input type = "checkbox" name = "sCheck" required>我不是機器人<br><br>



        欲參加場次：
        <select name = "sTime">
            <option value = "星期五">星期五</option>
            <option value = "星期六">星期六</option>
            <option value = "星期日">星期日</option>
        </select><br><br>

        交通方式：（酒後不開車！）
        <select name = "sSelect[]" multiple>
            <option value = "走路">走路</option>
            <option value = "騎車">騎車</option>
            <option value = "開車">開車</option>
        </select><br><br>

        <input type = "file" name = "sFlie"><br><br>

        其他問題：<br>
        <textarea name = "sTextarea" value = "" rows = "10" cols = "50"></textarea><br><br>

        <input type = "submit" value = "send">
        <input type = "reset" value = "reset">
    </form>
</html>