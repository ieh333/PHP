<?php
require 'db_connect.php';

class TableRow extends RecursiveIteratorIterator
{
    public function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    public function current()
    {
        return "<td style='border:1px solid black;'>" . parent::current() . "</td>";
    }

    public function beginChildren()
    {
        echo ("<tr>");
    }

    public function endChildren()
    {
        echo ("</tr>" . "\n");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Уеб-базирана система за разпределение и изпращане на курсови задачи към студентите</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>

<body>
    <h2>Таблица на разпределените курсови задачи за всеки един студент</h2>
    <div class="results">
        <table class="task_student">
            <tr>
                <th>Факултетен номер</th>
                <th>Име</th>
                <th>Фамилия</th>
                <th>Email</th>
                <th>Условие на задачата</th>
            </tr>
            <?php
try {
    $stmt = $conn->prepare("SELECT students.FN, students.First_name, students.Last_name, students.Email, tasks.Uslovie FROM students, tasks WHERE students.Id_task=tasks.Task_id; ");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach (new TableRow(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {

        echo ($v);
    }
} catch (PDOException $e) {
    echo ("Error: " . $e->getMessage());
}
$conn = null;
?>
        </table>
    </div>
    <div class="footer">
        Ако желаете да се върнете кън началната страница, моля натиснете този <a href="index.php">линк</a>!
    </div>
</body>

</html>
