<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Уеб-базирана система за разпределение и изпращане на курсови задачи към студентите</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>

<body>
    <h2>Форма за въвеждане на студентите</h2>
    <div class="students">
        <form method="POST" action="input_students.php">
            <label for="Факултетен номер">Факултетен номер</label>
            <input type="text" id="fac_number" name="fac_number" placeholder="Вашия факултетен номер..."> 
            <br />
            <label for="Име">Име</label>
            <input type="text" id="fname" name="firstname" placeholder="Вашето име...">
            <br /> 
            <label for="Фамилия">Фамилия</label>
            <input type="text"  id="lname" name="lastname" placeholder="Вашата фамилия...">
            <br />
            <label for="Email">Email</label>
            <input type="email" id="email" name="email" placeholder="Вашия email...">
            <br />
            <input type="submit" id="submit" value="Съхрани">
            <input type="reset" id="reset" value="Изчисти">
        </form>
    </div>
    <div class="footer">
        Ако желаете да се върнете кън началната страница, моля натиснете този <a href="index.php">линк</a>!
    </div>
</body>

</html>