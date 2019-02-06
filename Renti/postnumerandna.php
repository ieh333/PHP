<!DOCTYPE html>
<!--
Създаване на форма и скрипт за изчисление на ПОСТНУМЕРАНДНА РЕНТА.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/postnumerandna.css" />
        <title>Постнумерандна рента</title>
    </head>
    <body class="color">
        <h1 class="text">Постнумерандна рента</h1>
        <form name="form1" action="#" method="post">
            <table>
                <tr><td>
                        <label class="text">Продължителност на рентните плащания:</label></td>
                    <td><input type="number" name="n" step="1" min="1" required /> год.</td></tr>
                <tr><td>
                        <label class="text">Сумата на всяко едно рентно плащане:</label></td>
                    <td><input type="number" name="R" step="0.01" min="0" required /> лв.</td></tr>
                <tr><td>
                        <label class="text">Годишна лихва:</label></td>
                    <td><input type="number" name="i" step="0.01" min="0" required /> %</td></tr>
                <tr><td><input type="submit" name="calculate" value="Изчисли" />
				<input type="submit" name="save" value="Запиши" />
                <input type="reset" value="Изчисти" /></td></tr><br />
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
			$postnumerandna = array();
            $username = $_SESSION['username'];
            $n = filter_input(INPUT_POST, 'n');
            $R = filter_input(INPUT_POST, 'R');
            $i = filter_input(INPUT_POST, 'i');
            $calclulate = filter_input(INPUT_POST, 'calculate');
			$save=filter_input(INPUT_POST,'save');
			$load=filter_input(INPUT_POST,'load');
            $exit = filter_input(INPUT_POST, 'exit');
            $j = $i / 100;
            $q = $j + 1;
			$S=0;
			$count=1;
            if (isset($calclulate)) {
                $S = round($R * ((pow($q, $n) - 1) / ($q - 1)), 2);
				echo '<h3>';
                echo "Нарасналата сума S за $n години е: ";
                echo "$S лв.";
                echo '<br />';
                echo '</h3>';
            }
			if(isset($save)) {
				$S = round($R * ((pow($q, $n) - 1) / ($q - 1)), 2);
				$sql_post = "INSERT INTO postnumerandna (username, n, R, q, S) VALUES ('" . $username . "','" . $n . "','" . $R . "','" . $q . "','" . $S . "')";
                $connect->query($sql_post);
				$postnumerandna = array('username'=>$username, 'n'=>$n, 'R'=> $R, 'q'=>$q, 'S'=>$S);
				$filename="postnumerandna.txt";
				if(!file_exists($filename)) {
				$post_file=fopen($filename,"w");
				foreach($postnumerandna as $key=>$value) {
					fwrite($post_file,$value);
					fwrite($post_file,"\t");
				    }
			    fclose($post_file);
				} 
			else {
					$post_file=fopen($filename,"a");
					fwrite($post_file,"\n");
					foreach($postnumerandna as $key=>$value) {
					fwrite($post_file,$value);
					fwrite($post_file,"\t");
				    }
				fclose($post_file);
				}
				
				echo '<h3>';
                echo "Файлът е създаден успешно!";
                echo '</h3>';
			}
			if(isset($load)) {
				$select="select * from postnumerandna where username='$username'";
			    $result=$connect->query($select);
			    if($result->num_rows>0) {
					echo "<table border='1'><tr><th>№</th><th>Потребителско име</th><th>Продължителност на рентните плащания (год.)</th><th>Сумата на всяко едно рентно плащане (лв.)</th><th>Годишна лихва</th><th>Нараснала сума (лв.)</th></tr>";
				    while($postnumerandna = $result->fetch_assoc()) {
						echo "<tr><td>".$postnumerandna["id"]."</td><td>".$postnumerandna["username"]."</td><td>".$postnumerandna["n"]."</td><td>".$postnumerandna["R"]."</td><td>".$postnumerandna["q"]."</td><td>".$postnumerandna["S"]."</td></tr>";
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
