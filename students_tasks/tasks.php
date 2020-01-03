<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Уеб-базирана система за разпределение и изпращане на курсови задачи към студентите</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>

<body>
    <h2>Форма за въвеждане на курсовите задачи</h2>
    <div class="tasks">
        <form method="POST" action="input_tasks.php">
            <label for="Условие">Условие на задачата</label>
            <textarea id="uslovie" name="uslovie" rows="10" cols="5"></textarea>
            <input type="submit" id="submit" value="Съхрани">
            <input type="reset" id="reset" value="Изчисти">
        </form>
    </div>
    <div class="footer">
        Ако желаете да се върнете кън началната страница, моля натиснете този <a href="index.php">линк</a>!
    </div>
</body>

</html>