<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Уеб-базирана система за разпределение и изпращане на курсови задачи към студентите</title>
    <script src="javascript/select_options.js"></script>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link href="images/favicon.ico" rel="icon" type="image/x-icon" />
</head>

<body>
    <h1>Уеб-базирана система за разпределение и изпращане на курсови задачи към студентите</h1>
    <h2>Форма за избор на страница от приложението</h2>
    <div class="home">
        <form>
            <input type="radio" name="page" value="students" />Покажи формата за въвеждане на данните за студентите
            <br />
            <input type="radio" name="page" value="tasks" />Покажи формата за въвеждане на курсовите задания
            <br />
            <input type="radio" name="page" value="results" />Покажи разпределените курсови задачи на всеки един студент
            <br />
            <input type="button" id="show" value="Покажи" onclick="selectOptions()" ;>
        </form>
    </div>
</body>


</html>