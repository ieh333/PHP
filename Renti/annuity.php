<!DOCTYPE html>
<!--
Създаване на форма и скрипт за изчисление на РЕНТА С ПЕРИОД ПО-ГОЛЯМ ОТ 1 ГОДИНА.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/annuity.css" />
        <title>Рента с период по-голям от 1 година</title>
    </head>
    <body class="color">
        <h1 class="text">Рента с период по-голям от 1 година</h1>
        <form name="form1" action="#" method="post">
            <table>
                <tr><td>
                        <label class="text">Член на рентата, изплащана след r-година:</label></td>
                    <td><input type="number" name="Rr" step="0.01" min="0" /> лв.</td></tr>
                <tr><td>
                        <label class="text">Период на рентата:</label></td>
                    <td><input type="number" name="r" step="1" min="1" /> год.</td></tr>
                <tr><td>
                        <label class="text">Срок на рентата:</label></td>
                    <td><input type="number" name="n" step="1" min="1" /> год.</td></tr>
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
            $Rr = filter_input(INPUT_POST, 'Rr');
            $r = filter_input(INPUT_POST, 'r');
            $n = filter_input(INPUT_POST, 'n');
            $i = filter_input(INPUT_POST, 'i');
            $calclulate = filter_input(INPUT_POST, 'calculate');
			$save=filter_input(INPUT_POST,'save');
			$load=filter_input(INPUT_POST,'load');
            $j = $i / 100;
            $q = $j + 1;
			$S=0;
            if (isset($calclulate)) {
                $S = round($Rr * (pow($q, $n) - 1) / (pow($q, $r) - 1), 2);
				echo '<h3>';
                echo "Нарасналата сума S е: ";
                echo "$S лв.";
                echo '</h3>';
            }
			if(isset($save)) {
				$S = round($Rr * (pow($q, $n) - 1) / (pow($q, $r) - 1), 2);
				$sql_annuity="INSERT INTO annuity (username, Rr, r, n, q, S) VALUES ('" . $username . "','" . $Rr . "','" . $r . "','" . $n . "','" . $q . "','".$S."')";
                $connect->query($sql_annuity);
				$annuity = array('username'=>$username, 'Rr'=>$Rr, 'r'=> $r, 'n'=>$n,'q'=>$q, 'S'=>$S);
				$filename="annuity.txt";
				if(!file_exists($filename)) {
				$annuity_file=fopen($filename,"w");
				foreach($annuity as $key=>$value) {
					fwrite($annuity_file,$value);
					fwrite($annuity_file,"\t");
					}
				fclose($annuity_file);
				}
			else {
					$annuity_file=fopen($filename,"a");
					fwrite($annuity_file,"\n");
					foreach($annuity as $key=>$value) {
					fwrite($annuity_file,$value);
					fwrite($annuity_file,"\t");
					}
				fclose($annuity_file);
				}
				echo '<h3>';
                echo "Файлът е създаден успешно!";
                echo '</h3>';
			}
			if(isset($load)) {
				$select="select * from annuity where username='$username'";
			    $result=$connect->query($select);
			    if($result->num_rows>0) {
					echo "<table border='1'><tr><th>№</th><th>Потребителско име</th><th>Член на рентата, изплащана след r-година (лв.)</th><th>Период на рентата (год.)</th><th>Срок на рентата (год.)</th><th>Годишна лихва</th><th>Нарасналата сума (лв.)</th></tr>";
				    while($annuity = $result->fetch_assoc()) {
						echo "<tr><td>".$annuity["id"]."</td><td>".$annuity["username"]."</td><td>".$annuity["Rr"]."</td><td>".$annuity["r"]."</td><td>".$annuity["n"]."</td><td>".$annuity["q"]."</td><td>".$annuity["S"]."</td></tr>";
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
