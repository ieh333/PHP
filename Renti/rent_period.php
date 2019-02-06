<!DOCTYPE html>
<!--
Създаване на форма и скрипт за определяне на СРОКА НА РЕНТАТА.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/rent_period.css" />
        <title>Определяне на срока на рентата</title>
    </head>
    <body class="color">
        <h1 class="text">Определяне на срока на рентата</h1>
        <form name="form1" action="#" method="post">
            <table>
                <tr><td>
                        <label class="text">Нараснала сума на рентата след n-годишни плащания:</label></td>
                    <td><input type="number" name="S" step="0.01" min="0" /> лв.</td></tr>
                <tr><td>
                        <label class="text">Сумата на всяко едно рентно плащане:</label></td>
                    <td><input type="number" name="R" step="0.01" min="0" /> лв.</td></tr>
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
            $S = filter_input(INPUT_POST, 'S');
            $R = filter_input(INPUT_POST, 'R');
            $i = filter_input(INPUT_POST, 'i');
            $calclulate = filter_input(INPUT_POST, 'calculate');
			$save=filter_input(INPUT_POST,'save');
			$load=filter_input(INPUT_POST,'load');
            $j = $i / 100;
            $q = $j + 1;
			$n=0;
            if (isset($calclulate)) {
                $n = round(log10(($S / $R) * ($q - 1) + 1) / log10($q));
				echo '<h3>';
                echo "Срокът на рентата n е: ";
                echo "$n години.";
            }
			if(isset($save)) {
				$n = round(log10(($S / $R) * ($q - 1) + 1) / log10($q));
				$sql_period = "INSERT INTO rent_period (username, S, R, q, n) VALUES ('" . $username . "','" . $S . "','" . $R . "','" . $q . "','" . $n . "')";
                $connect->query($sql_period);
				$rent_period = array('username'=>$username, 'S'=>$S, 'R'=> $R, 'q'=>$q, 'n'=>$n);
				$filename="rent_period.txt";
				if(!file_exists($filename)) {
				$period_file=fopen($filename,"w");
				foreach($rent_period as $key=>$value) {
					fwrite($period_file,$value);
					fwrite($period_file,"\t");
				}
				fclose($period_file);
				}
			else {
				$period_file=fopen($filename,"a");
				fwrite($period_file,"\n");
				foreach($rent_period as $key=>$value) {
					fwrite($period_file,$value);
					fwrite($period_file,"\t");
				}
				fclose($period_file);
				}
				echo '<h3>';
                echo "Файлът е създаден успешно!";
                echo '</h3>';
			}
			if(isset($load)) {
				$select="select * from rent_period where username='$username'";
			    $result=$connect->query($select);
			    if($result->num_rows>0) {
					echo "<table border='1'><tr><th>№</th><th>Потребителско име</th><th>Нараснала сума на рентата след n-годишни плащания (лв.)</th><th>Сумата на всяко едно рентно плащане (лв.)</th><th>Годишна лихва</th><th>Срок на рентата (год.)</th></tr>";
				    while($rent_period = $result->fetch_assoc()) {
						echo "<tr><td>".$rent_period["id"]."</td><td>".$rent_period["username"]."</td><td>".$rent_period["S"]."</td><td>".$rent_period["R"]."</td><td>".$rent_period["q"]."</td><td>".$rent_period["n"]."</td></tr>";
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
