<!DOCTYPE html>
<!--
Създаване на форма и скрипт за изчисление на ПРЕНУМЕРАНДНА РЕНТА.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/prenumerandna.css" />
        <title>Пренумерандна рента</title>
    </head>
    <body class="color">
        <h1 class="text">Пренумерандна рента</h1>
        <form name="form1" action="#" method="post">
            <table>
                <tr><td>
                        <label class="text">Продължителност на рентните плащания:</label></td>
                    <td><input type="number" name="n" step="1" min="1" /> год.</td></tr>
                <tr><td>
                        <label class="text">Сумата на всяко едно рентно плащане:</label></td>
                    <td><input type="number" name="r" step="0.01" min="0" /> лв.</td></tr>
                <tr><td>
                        <label class="text">Годишна лихва:</label></td>
                    <td><input type="number" name="i" step="0.01" min="0" /> %</td></tr>
            <tr><td><input type="submit" name="calculate" value="Изчисли" />
			        <input type="submit" name="save" value="Запиши" />
                    <input type="reset" value="Изчисти" /></td></tr>
            </table>
        </form>
		<br />
		<br />
		<br />
		<form name="form2" action="#" method="post">
		<input type="submit" name="load" value="Зареждане от базата данни" />
		</form>
        <div style="text-align: center">
		<a href="javascript:history.back()"><img src="jpeg/Nazad.jpg" alt="Назад" /></a>&nbsp;&nbsp;&nbsp;
		<a href="logout.php"><img src="jpeg/Izhod.jpg" alt="Изход" /></a>
		</div>
        <div>
            <?php
            require_once 'db_connect.php';
            session_start();
            $username = $_SESSION['username'];
            $n = filter_input(INPUT_POST, 'n');
            $r = filter_input(INPUT_POST, 'r');
            $i = filter_input(INPUT_POST, 'i');
            $calclulate = filter_input(INPUT_POST, 'calculate');
			$save=filter_input(INPUT_POST,'save');
			$load=filter_input(INPUT_POST,'load');
            $j = $i / 100;
            $q = $j + 1;
			$S=0;
            if (isset($calclulate)) {
                $S = round($r * $q * ((pow($q, $n) - 1) / ($q - 1)), 2);
				echo '<h3>';
                echo "Нарасналата сума S за $n години е: ";
                echo "$S лв.";
                echo '<br />';
                echo '</h3>';
            }
			if(isset($save)) {
				$S = round($r * $q * ((pow($q, $n) - 1) / ($q - 1)), 2);
				$sql_pre = "INSERT INTO prenumerandna (username, n, r, q, S) VALUES ('" . $username . "','" . $n . "','" . $r . "','" . $q . "','" . $S . "')";
                $connect->query($sql_pre);
				$prenumerandna = array('username'=>$username, 'n'=>$n, 'r'=> $r, 'q'=>$q, 'S'=>$S);
				$filename="prenumerandna.txt";
				if(!file_exists($filename)) {
				$pre_file=fopen($filename,"w");
				foreach($prenumerandna as $key=>$value) {
					fwrite($pre_file,$value);
					fwrite($pre_file,"\t");
					}
				fclose($pre_file);
				}
			else {
					$pre_file=fopen($filename,"a");
					fwrite($pre_file,"\n");
					foreach($prenumerandna as $key=>$value) {
					fwrite($pre_file,$value);
					fwrite($pre_file,"\t");
					}
				fclose($pre_file);
				}
				echo '<h3>';
                echo "Файлът е създаден успешно!";
                echo '</h3>';
			}
			if(isset($load)) {
				$select="select * from prenumerandna where username='$username'";
			    $result=$connect->query($select);
			    if($result->num_rows>0) {
					echo "<table border='1'><tr><th>№</th><th>Потребителско име</th><th>Продължителност на рентните плащания (год.)</th><th>Сумата на всяко едно рентно плащане (лв.)</th><th>Годишна лихва</th><th>Нараснала сума (лв.)</th></tr>";
				    while($prenumerandna = $result->fetch_assoc()) {
						echo "<tr><td>".$prenumerandna["id"]."</td><td>".$prenumerandna["username"]."</td><td>".$prenumerandna["n"]."</td><td>".$prenumerandna["r"]."</td><td>".$prenumerandna["q"]."</td><td>".$prenumerandna["S"]."</td></tr>";
					}
					echo "</table>";
			    }
				else {
					echo "0 results.";
				}	
			}
            $connect->close();
            ?>
        </div>
    </body>
</html>