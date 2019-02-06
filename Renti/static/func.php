<?php
//  Функции, които се извикват многократно при работа със системата.
//
// Функция за проверка дали зададената заявка дава резултат, засича времето за изпълнение 
// и броя на редовете върнати като резултат.
	function get_resultsInfo ($query) {
			
			$time = microtime(); 
			// echo "before".$time."<br />";
			$time = explode(" ", $time); 
			$time = $time[1] + $time[0]; 
			$time1 = $time;			
			
		$query_res = mysql_query($query);
	
			$time = microtime(); 
			// echo "after".$time;
			$time = explode(" ", $time); 
			$time = $time[1] + $time[0]; 
			$time2 = $time;
		
			if (!$query_res) {
				echo("<strong>Грешка в заявката:</strong> " . mysql_error(). "<br>");
				return null;
			}
			$duration= round(($time2 - $time1),4);
//			round(abs($timeafter - $timebefore),4);
			// echo ("duration" . $duration);			
		$row_count = @mysql_num_rows($query_res);
		
		if ($row_count == 0) 
			{ echo( "<br>Няма записи отговарящи на заявката!<br>"); 
			return null;
			}
			
			$arrRet = array($query_res,$duration,$row_count);
			return $arrRet;
	}
		

// Динамично изчертаване на таблица с резултатите от въведената заявка.	
	function display_query($query_res)
		{				
		
			$column_count = @mysql_num_fields($query_res);
			
			if (!$column_count) {
			 echo("<br>Заявката не даде резултат: ".mysql_error());
			 return;
			 }
			
			$width = (($column_count * 25) < 100) ? ($column_count * 25) : 100 ;
			echo "<br><TABLE width={$width}% border=\"1\" bordercolor=black align=center cellspacing=1>";
				
			
			echo "<tr bgcolor=#AAAA44>";
			for ($column_num = 0; $column_num < $column_count; $column_num++)
			{
				$field_name = mysql_field_name($query_res, $column_num);
				echo "<th align=center><font color=white>$field_name</th>";
			}
			echo "</tr>" ;
			
			$cv=0;
		  while ($row = mysql_fetch_row($query_res))
		    { $cv++; 
					if (bcmod($cv,2)==0) 
					echo "<tr align=center bgcolor=#DDDD77><font color=#003399>" ;
									else echo "<tr align=center bgcolor=#FEFBC7>";
									
			for ($column_num=0; $column_num < $column_count; $column_num++){
			if (($row[$column_num])=="")  echo "<td> &nbsp </td>";
				else echo "<td><font color=#003399>$row[$column_num]</font></td>";
				 }
		  	echo "</tr>";
			if ($cv > 50) break;
		    }
		  echo "</table>";
}
?>