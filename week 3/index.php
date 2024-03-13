<!DOCTYPE html>

<html>
    <head>
        <meta charset = "UTF-8">
        <title>Week2 Homework</title>
        <style>
        body{
                background-image: url("background.jpg");
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }
        img {
                max-width: 25%;
        	    height: auto; border: 2px solid #333;
        	    margin: 10px 0;
            }
        table{
                width: 100%;
        		border-collapse: collapse;
        		margin-top: 20px;
            }
        th, td{
                border: 1px solid #ddd;
        		padding: 8px;
        		text-align: left;
            }

        th { background-color: #f2f2f2; }
        </style>
    </head>

    <body>
        <center><h1>履歷表</h1></center><hr>

        <h2>個人資料</h2>
        <ul>
            <li>姓名：李曜安</li>
            <li>就讀學校：<a href="https://maps.app.goo.gl/rCLvjJ5PwUYG6TDFA" target="_blank">國立高雄大學</a></li>
            <li>科系：資訊管理學系</li>
        </ul>

        <br><h2>照片</h2>
        <img src="selfie_for_php.jpg" alt="照片"> 

        <br><h2>個人年譜</h2>
        <table>
            <tr>
                <th>年份</th>
                <th>事件</th>
            </tr>
            <tr>
                <td>2003</td>
                <td>出生</td>
            </tr>
            <tr>
                <td>2016</td>
                <td>畢業於新北市立頂埔國民小學</td>
            </tr>
            <tr>
                <td>2019</td>
                <td>畢業於新北市立土城國民中學</td>
            </tr>
            <tr>
                <td>2022</td>
                <td>畢業於新北市立永平高級中學</td>
            </tr>
        </table>
    </body>
</html>