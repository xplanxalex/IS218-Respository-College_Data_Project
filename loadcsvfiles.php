<?php	
	//header("Content-Type: text/plain");
	$file = new file();
	$file->read_csv();
	
	class file 
	{
		//public $file_name = 'countrylist.csv';
		
		public function read_csv()
		{
			$row = 1;
			/*
			 * 			if (($handle = fopen("collegenames.csv", "r")) !== FALSE) 
			 * 
			 * 			if (($handle = fopen("students2010.csv", "r")) !== FALSE) 
			 * 
			 * 			if (($handle = fopen("students2011.csv", "r")) !== FALSE) 
			 * 
			 * 			if (($handle = fopen("finances2010.csv", "r")) !== FALSE) 
			 * 
			 * 			if (($handle = fopen("finances2011.csv", "r")) !== FALSE) 
			 * 
			 */
			if (($handle = fopen("enrollment_2010.csv", "r")) !== FALSE) 
			{
			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
			    {
			        $num = count($data);
			       
			        if($row == 1) 
					{
						$field_names = $this->create_field_names($data);
						
					}
					else 
					{
						$records[] = $this->create_record($data, $field_names);	
					}
			        $row++;
			        /*for ($c=0; $c < $num; $c++) {
			            echo $data[$c] . "<br />\n";
			        }*/
			    }
			    fclose($handle);
				database::loadIntoTable($records);
				//print_r($records);
				/*foreach($records as $record)
				{
					foreach($records as $label => $value) 
					{
						echo $label . ': ' . $value . '</br>';
					}
				}*/
				$this->writeCSV($records);
			}
		}
		public function create_field_names($data)
		{
			return $data;
		}
		public function create_record($data, $field_names)
		{
			$data = array_combine($field_names, $data);
			return $data;
		}
		public function writeCSV($data)
		{
			$fp = fopen('file.csv', 'w');
			foreach($data as $fields)
			{
				fputcsv($fp, $fields);
			}
		fclose($fp);
		}
	}

	class html 
	{
		public static function createTable($data)
		{
			$firstRow = 1;
			echo "<table>";
			foreach($data as $key=>$row)
			{
				echo "<tr>";
				if($firstRow == 1)
				{
					foreach($row as $key2=>$row2)
					{	
							echo "<th>" . $key2 . "</th>\n";					
					}
					echo "</tr>\n";
					echo "<tr>";
				}
				foreach($row as $key2=>$row2)
				{
					echo "<td>" . $row2 . "</td>\n";	
				}
				$firstRow++;
				echo "</tr>\n";	
			}
			echo "</table>";
		}	
	}
	
	class database
	{
		public static function loadIntoTable($data)
		{
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);			
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
			
			$firstRow = 1;
			//$assocArray = array();
			//echo "<table>";
			foreach($data as $key=>$row)
			{
				//echo "<tr>";
				$arr = array();
				if($firstRow == 1)
				{
					foreach($row as $key2=>$row2)
					{	
							//echo "<th>" . $key2 . "</th>\n";					
					}
					//echo "</tr>\n";
					//echo "<tr>";
				}
				foreach($row as $key2=>$row2)
				{
					//echo "<td>" . $row2 . "</td>\n";	
					array_push($arr, $row2);
					
				}
				$firstRow++;
				//USED FOR CREATING COLLEGE NAMES
				/*
				echo "University ID: " . $arr[0];
				echo "Liabilities: " .$arr[1];
				echo "Assets: " .$arr[2];
				echo "<br><br>";
				$STH = $DBH->prepare("INSERT INTO college_name (cid, name, state) VALUES (:cid, :name, :state)");
				$STH->bindParam(':cid', $arr[0]);
				$STH->bindParam(':name', $arr[1]);
				$STH->bindParam(':state', $arr[2]);
				*/
				

				// USED FOR CREATING financial_2010 
				/*
				echo "University ID: " . $arr[0];
				echo "Liabilities: " .$arr[1];
				echo "Assets: " .$arr[2];
				echo "Revenue: " .$arr[3];
				echo "<br><br>";
				$STH = $DBH->prepare("INSERT INTO financial_2011 (cid, liabilities, assets, revenues) VALUES (:cid, :liabilities, :assets, :revenues)");
				$STH->bindParam(':cid', $arr[0]);
				$STH->bindParam(':liabilities', $arr[1]);
				$STH->bindParam(':assets', $arr[2]);
				$STH->bindParam(':revenues', $arr[3]);
				*/
				
				
				
				// USED FOR ENROLLMENT 2011 and 2010
				/*
				echo "Univeristy ID: " .$arr[0];
				$assocArray[$arr[0]]=$assocArray[$arr[0]] + $arr[1];
				echo "Enrollment: ".$arr[1];
				echo "<br><br>";
				/*$STH = $DBH->prepare("INSERT INTO enrollment_2011 (cid, total) VALUES (:cid, :total)");
				$STH->bindParam(':cid', $arr[0]);
				$STH->bindParam(':total', $arr[1]);
				*/
				
				
				//echo "</tr>\n";	
				//$STH->execute();
				
				unset($arr);
			}
			// ALSO USED FOR ENROLLMENT_2010/2011
			/*
			foreach($assocArray as $key=>$row)
			{
				echo $key." enrollment total is: ".$row;
				echo "<br><br>";
				$STH = $DBH->prepare("INSERT INTO enrollment_2010 (cid, total) VALUES (:cid, :total)");
				$STH->bindParam(':cid', $key);
				$STH->bindParam(':total', $row);
				
				$STH->execute();
			}
			*/
		}
		
		
	}
?>