<!DOCTYPE html>
<!--
Създаване на форма и скрипт за изчисление на P-СРОЧНА РЕНТА.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/p_term.css" />
        <title>P-срочна рента</title>
    </head>
    <body class="color">
        <h1 class="text">P-срочна рента</h1>
        <form name="form1" action="#" method="post">
            <table>
                <tr><td>
                        <label class="text">Срок на рентата:</label></td>
                    <td><input type="number" name="p" step="1" min="1" max="12" /> мес.</td></tr>
                <tr><td>
                        <label class="text">Продължителност на рентните плащания:</label></td>
                    <td><input type="number" name="n" step="1" min="1" /> год.</td></tr>
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
            $p = filter_input(INPUT_POST, 'p');
            $n = filter_input(INPUT_POST, 'n');
            $R = filter_input(INPUT_POST, 'R');
            $i = filter_input(INPUT_POST, 'i');
            $calclulate = filter_input(INPUT_POST, 'calculate');
			$save=filter_input(INPUT_POST,'save');
			$load=filter_input(INPUT_POST,'load');
            $j = $i / 100;
            $q = $j + 1;
			$S=0;
            if (isset($calclulate)) {
                $s = (pow($q, $n) - 1) / ($p * (pow($q, ($j / $p)) - 1));
                $S = round($R * $s, 2);
				echo '<h3>';
                echo "Нарасналата сума S за $n години е: ";
                echo "$S лв.";
                echo '</h3>';
            }
            if(isset($save)) {
				$s = (pow($q, $n) - 1) / ($p * (pow($q, ($j / $p)) - 1));
                $S = round($R * $s, 2);
				$sql_term = "INSERT INTO p_term (username, p, n, R, q, S) VALUES ('" . $username . "','" . $p . "','" . $n . "','" . $R . "','" . $q . "','".$S."')";
                $connect->query($sql_term);
				$p_term = array('username'=>$username, 'p'=>$p, 'n'=>$n, 'R'=> $R, 'q'=>$q, 'S'=>$S);
				$filename="p_term.txt";
				if(!file_exists($filename)) {
				$term_file=fopen($filename,"w");
				foreach($p_term as $key=>$value) {
					fwrite($term_file,$value);
					fwrite($term_file,"\t");
					}
				fclose($term_file);
				}
			else {
					$term_file=fopen($filename,"a");
					fwrite($term_file,"\n");
					foreach($p_term as $key=>$value) {
					fwrite($term_file,$value);
					fwrite($term_file,"\t");
					}
				fclose($term_file);	
				}
				echo '<h3>';
                echo "Файлът е създаден успешно!";
                echo '</h3>';
			}
			if(isset($load)) {
				$select="select * from p_term where username='$username'";
			    $result=$connect->query($select);
			    if($result->num_rows>0) {
					echo "<table border='1'><tr><th>№</th><th>Потребителско име</th><th>Срок на рентата (мес.)</th><th>Продължителност на рентните плащания (год.)</th><th>Сумата на всяко едно рентно плащане (лв.)</th><th>Годишна лихва</th><th>Нараснала сума (лв.)</th></tr>";
				    while($p_term = $result->fetch_assoc()) {
						echo "<tr><td>".$p_term["id"]."</td><td>".$p_term["username"]."</td><td>".$p_term["p"]."</td><td>".$p_term["n"]."</td><td>".$p_term["R"]."</td><td>".$p_term["q"]."</td><td>".$p_term["S"]."</td></tr>";
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
