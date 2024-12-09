	<table>
	<? 
						 if (isset ($prefix))	{$base = $prefix;}
								$base .= 'photo_list';
						 if (isset ($prefix))	{$base1 = $prefix;}
								$base1 .= 'photo_dir';

	$curent_dir = $_GET['dir'];
	if ($curent_dir == "base") $curent_dir="";
	
	$action = $_GET['action'];
	$dir_name = "../photos/".$curent_dir;
	$up_dir = "<a href = 'photos_in.php'>up</a><br>";
	If (!isset($_GET['dir']))
		{
		$dir_name = "../photos";
		
		}
		else
		{
			echo $up_dir;	
		}
	If (!isset($curent_dir))
		{
		$curent_dir = "base";
		
		}
	$dir = opendir ("$dir_name");
	$i=0;
	 while ($file = readdir ($dir)) 
		{
		
		 if (( $file != ".") && ($file != ".."))
    {
     
		if ($i%3 == 0)
			{echo "<tr>";
			
			}
		else
			{
			echo "<td></td>";
			}
			
			$check_d = '';
			$check_p = '';
			if (isset($_POST["d$i"])) $check_d = 'checked';
			if (isset($_POST["p$i"])) $check_p = 'checked';
			 $ft =  "file";
			 $path = $dir_name . "/" . $file;
			
			if (is_dir($path)==true)
				{
					$ft =  "dir";
					echo "<td><div align = center><a href = 'photos_in.php?dir=$file&par=$curent_dir'>$file | $ft</a></div>";
				}
				else
					{
					echo "<td><div align = center>$file | $ft</div>";
					}
			
			echo "</td>";
		
		
		
		
		$i++;
		}
		}
		$n=$i;
		 closedir ($dir);
	
		if ($action == "save")
			{
				 $dir = opendir ("$dir_name");
				$i=0;
				//Добавление записи в таблицу папок с фотографиями
				if ($curent_dir == "")	{$name = "base";}
					else	{$name = $curent_dir;}
					
								//$name = "base";
								$description = "Описание";
								$n_photo = $n;
								$parent = 0;
								$date = date("c");
								$query = "INSERT INTO $base1 (name, description, n_photo, parent, date) VALUES ('$name', '$description', '$n_photo', '$parent', '$date');";
								echo $query."<br>";
								mysql_query($query) or DIE(mysql_error());
					
								$query = "SELECT id from $base1 where name = '$name'";
								
								$result = MYSQL_QUERY($query);
								$id = mysql_result($result,0,"id");

								
				 while ($file = readdir ($dir)) 
					{
					 if (( $file != ".") && ($file != ".."))
						{
							
							
						 $path = $dir_name . "/" . $file;
						if (is_dir($path)!=true)
							{
							//Добавление информации о фотографиях
								$name = $file;
								$description = "Описание";
								$dir_in = $curent_dir;
								$raiting = 0;
								$query = "INSERT INTO $base (name, description, dir, raiting) VALUES ('$name', '$description', '$id', '$raiting');";
								echo $query."<br>";
								mysql_query($query) or DIE(mysql_error());			
							//Добавление информации о папке
								
							
							}
							else
							{
							echo "<td><div align = center>$file | $ft</div>";
							}
						
						echo "</td>";
					
					
					
					
					$i++;
					}
		}
		
					 closedir ($dir);
				/*	 if (isset ($prefix))	{$base = $prefix;}
								$base .= 'photos_dir';
								$query = "INSERT INTO $base (";
								
								for ($i=1;$i<$n;$i++)
									{$query .= "$name[$i], ";}
									 $query .= "$name[$n]) VALUES (";
								for ($i=1;$i<$n;$i++)
									{$out = mysql_real_escape_string($_POST["$name[$i]"]);
									$query .= "'{$out}', ";}
									$query .= "NOW())";
					
				
				mysql_query($query) or DIE(mysql_error());					

		 */
		 
		 }
		 
		$query = "SELECT * FROM $base1 where name = '$curent_dir';";
		echo $query ;
		$result = MYSQL_QUERY($query);
		$number = MYSQL_NUMROWS($result);
		
	?>
		</table>
		<hr>
		<?if ($number==0)	{
		?>
		<a href = 'photos_in.php?action=save&dir=<?php echo $curent_dir; ?>'>Сохранить</a><br> 
	
		<?php 
		}
		else echo "сохранено";
			
		?>