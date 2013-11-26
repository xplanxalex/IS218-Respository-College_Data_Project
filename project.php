<?php
	
	//Some Basic Notes on GET, POST, and REQUEST
	//GET only contains arrays for GET requests
	//POST only contains arrays for POST requests (such as no GET requests from the URL bar)
	//REQUEST gets array regardless of GET or POST array
	 
	$program = new program();
	
	class program 
	{
		function __construct()
		{
			$page = 'homepage';	
			$arg = NULL;
			if(isset($_REQUEST['page'])) 	// here we check for a page in the URL
			{
				$page = $_REQUEST['page'];
			}
			if(isset($_REQUEST['arg'])) 	// here we check for an argument in the URL
			{
				$page = $_REQUEST['arg'];
			}
			$page = new $page($arg);		// Here we instantiate page
		}	
		function __destruct()
		{
			
		}
	}
	abstract class page // abstract classes are classes that should not be able to be instantiated
	{
			
		public $menu;
		public $content;
		public $DBH;
		public $STH;
		
		function menu()
		{
			$menu = '<a href=./project.php>Home</a>'; 	// .= is used to concatenate this link to the menu
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question1>Question 1</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question2>Question 2</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question3>Question 3</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question4>Question 4</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question5>Question 5</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question6>Question 6</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question7>Question 7</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question8>Question 8</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question9>Question 9</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question10>Question 10</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question11>Question 11</a>'; 
			$menu .= '<br>';
			$menu .= '<a href=./project.php?page=question12>Question 12</a>'; 
			$menu .= '<br>';
			return $menu;
		}
		
		function __construct()
		{
			
			if($_SERVER['REQUEST_METHOD'] == 'GET')
			{
				$this->get();
			}
			else
			{
				$this->post();
			}
			//$this->loginDBH();
			
		}
		function __destruct()
		{
				
			$this->content .= $this->menu();	
			// $this->menu();		//Menu here accesses the function
			echo $this->content;	//Menu here accesses the properties
			
		}
		function get()
		{	
			$this->content .= $this->menu();
		}
		function post()
		{
			
		}
	}
	
	class homepage extends page
	{
		function get()
		{
			$this->content .= $this->addHead();
		}
	
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			return $var;
		}
	}
	
	class question1 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 1 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by enrollment</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query("SELECT college_name.name, enrollment_2011.total FROM college_name INNER JOIN enrollment_2011 ON college_name.cid = enrollment_2011.cid ORDER BY enrollment_2011.total DESC;");
			
				 // Setting the fetch mode
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				echo '<table>';
				echo '<tr><th>College Name</th><th>Enrollment 2011</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['total'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	class question2 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 2 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Total Liabilities</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query("SELECT college_name.name, financial_2011.liabilities FROM college_name INNER JOIN financial_2011 ON college_name.cid = financial_2011.cid ORDER BY financial_2011.liabilities DESC;");
			
				 // Setting the fetch mode
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				echo '<table>';
				echo '<tr><th>College Name</th><th>Total Liabilities</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['liabilities'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	class question3 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 3 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Net Assets</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query("SELECT college_name.name, financial_2011.assets FROM college_name INNER JOIN financial_2011 ON college_name.cid = financial_2011.cid ORDER BY financial_2011.assets DESC;");
			
				 // Setting the fetch mode
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				echo '<table>';
				echo '<tr><th>College Name</th><th>Net Assets</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['assets'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	class question4 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 4 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Net Assets</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query("SELECT college_name.name, financial_2011.assets FROM college_name INNER JOIN financial_2011 ON college_name.cid = financial_2011.cid ORDER BY financial_2011.assets DESC;");
			
				 // Setting the fetch mode
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				echo '<table>';
				echo '<tr><th>College Name</th><th>Net Assets</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['assets'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	class question5 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 5 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Total Revenues</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query("SELECT college_name.name, financial_2011.revenues FROM college_name INNER JOIN financial_2011 ON college_name.cid = financial_2011.cid ORDER BY financial_2011.revenues DESC;");
			
				 // Setting the fetch mode
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				echo '<table>';
				echo '<tr><th>College Name</th><th>Total Revenues</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['revenues'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	class question6 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 6 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Total Revenues per Student</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query('SELECT college_name.name, financial_2011.revenues/enrollment_2011.total FROM college_name  INNER JOIN financial_2011 ON college_name.cid = financial_2011.cid INNER JOIN enrollment_2011 ON college_name.cid = enrollment_2011.cid ORDER BY financial_2011.revenues/enrollment_2011.total DESC;');

			
				 // Setting the fetch mode
				echo '<table>';
				echo '<tr><th>College Name</th><th>Total Revenues per Student</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['financial_2011.revenues/enrollment_2011.total'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	class question7 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 7 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Net Assets per Student</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query('SELECT college_name.name, financial_2011.assets/enrollment_2011.total FROM college_name  INNER JOIN financial_2011 ON college_name.cid = financial_2011.cid INNER JOIN enrollment_2011 ON college_name.cid = enrollment_2011.cid ORDER BY financial_2011.assets/enrollment_2011.total DESC;');

			
				 // Setting the fetch mode
				echo '<table>';
				echo '<tr><th>College Name</th><th>Net Assets per Student</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['financial_2011.assets/enrollment_2011.total'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	class question8 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 8 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Total Liabilities per Student</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query('SELECT college_name.name, financial_2011.liabilities/enrollment_2011.total FROM college_name  INNER JOIN financial_2011 ON college_name.cid = financial_2011.cid INNER JOIN enrollment_2011 ON college_name.cid = enrollment_2011.cid ORDER BY financial_2011.liabilities/enrollment_2011.total DESC;');

			
				 // Setting the fetch mode
				echo '<table>';
				echo '<tr><th>College Name</th><th>Net Assets per Student</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['financial_2011.liabilities/enrollment_2011.total'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	class question9 extends page
	{
		function __destruct()
		{
			$variable = $_GET['variable'];
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery($variable);
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 8 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Total Liabilities per Student</p>';
			
			return $var;
		}
		function runQuery($arg)
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			echo '<table>';
			echo '<tr>';
			echo '<td><a href=./project.php?page=question9&variable=n>College Name</a></td>';
			echo '<td><a href=./project.php?page=question9&variable=s>Enrollment</a></td>';
			echo '<td><a href=./project.php?page=question9&variable=l>Liabilities</a></td>';
			echo '<td><a href=./project.php?page=question9&variable=a>Assets</a></td>';
			echo '<td><a href=./project.php?page=question9&variable=r>Revenues</a></td>';
			echo '<td><a href=./project.php?page=question9&variable=lps>Liabilities Per Student</a></td>';
			echo '<td><a href=./project.php?page=question9&variable=aps>Assets Per Student</a></td>';
			echo '<td><a href=./project.php?page=question9&variable=rps>Revenues Per Student</a></td>';
			echo '</tr>';
			
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				switch($arg) 
				{
					case "n":
						$STH = $DBH->prepare
						('
							SELECT college_name.name, enrollment_2011.total, financial_2011.liabilities, financial_2011.assets, financial_2011.revenues, financial_2011.liabilities/enrollment_2011.total, financial_2011.assets/enrollment_2011.total, 
							financial_2011.revenues/enrollment_2011.total
							FROM college_name
							INNER JOIN enrollment_2011
							ON college_name.cid = enrollment_2011.cid
							INNER JOIN financial_2011
							ON college_name.cid = financial_2011.cid
							ORDER BY college_name.name
							ASC
							LIMIT 5;
						');
						break;
					case "s":
						$STH = $DBH->prepare
						('
							SELECT college_name.name, enrollment_2011.total, financial_2011.liabilities, financial_2011.assets, financial_2011.revenues, financial_2011.liabilities/enrollment_2011.total, financial_2011.assets/enrollment_2011.total, 
							financial_2011.revenues/enrollment_2011.total
							FROM college_name
							INNER JOIN enrollment_2011
							ON college_name.cid = enrollment_2011.cid
							INNER JOIN financial_2011
							ON college_name.cid = financial_2011.cid
							ORDER BY enrollment_2011.total
							DESC
							LIMIT 5;
						');
						break;
					case "l":
						$STH = $DBH->prepare
						('
							SELECT college_name.name, enrollment_2011.total, financial_2011.liabilities, financial_2011.assets, financial_2011.revenues, financial_2011.liabilities/enrollment_2011.total, financial_2011.assets/enrollment_2011.total, 
							financial_2011.revenues/enrollment_2011.total
							FROM college_name
							INNER JOIN enrollment_2011
							ON college_name.cid = enrollment_2011.cid
							INNER JOIN financial_2011
							ON college_name.cid = financial_2011.cid
							ORDER BY financial_2011.liabilities
							DESC
							LIMIT 5;
						');
						break;
					case "a":
						$STH = $DBH->prepare
						('
							SELECT college_name.name, enrollment_2011.total, financial_2011.liabilities, financial_2011.assets, financial_2011.revenues, financial_2011.liabilities/enrollment_2011.total, financial_2011.assets/enrollment_2011.total, 
							financial_2011.revenues/enrollment_2011.total
							FROM college_name
							INNER JOIN enrollment_2011
							ON college_name.cid = enrollment_2011.cid
							INNER JOIN financial_2011
							ON college_name.cid = financial_2011.cid
							ORDER BY financial_2011.assets
							DESC
							LIMIT 5;
						');
						break;
					case "r":
						$STH = $DBH->prepare
						('
							SELECT college_name.name, enrollment_2011.total, financial_2011.liabilities, financial_2011.assets, financial_2011.revenues, financial_2011.liabilities/enrollment_2011.total, financial_2011.assets/enrollment_2011.total, 
							financial_2011.revenues/enrollment_2011.total
							FROM college_name
							INNER JOIN enrollment_2011
							ON college_name.cid = enrollment_2011.cid
							INNER JOIN financial_2011
							ON college_name.cid = financial_2011.cid
							ORDER BY financial_2011.revenues
							DESC
							LIMIT 5;
						');
						break;
					case "lps":
						$STH = $DBH->prepare
						('
							SELECT college_name.name, enrollment_2011.total, financial_2011.liabilities, financial_2011.assets, financial_2011.revenues, financial_2011.liabilities/enrollment_2011.total, financial_2011.assets/enrollment_2011.total, 
							financial_2011.revenues/enrollment_2011.total
							FROM college_name
							INNER JOIN enrollment_2011
							ON college_name.cid = enrollment_2011.cid
							INNER JOIN financial_2011
							ON college_name.cid = financial_2011.cid
							ORDER BY financial_2011.liabilities/enrollment_2011.total
							DESC
							LIMIT 5;
						');
						break;
					case "aps":
						$STH = $DBH->prepare
						('
							SELECT college_name.name, enrollment_2011.total, financial_2011.liabilities, financial_2011.assets, financial_2011.revenues, financial_2011.liabilities/enrollment_2011.total, financial_2011.assets/enrollment_2011.total, 
							financial_2011.revenues/enrollment_2011.total
							FROM college_name
							INNER JOIN enrollment_2011
							ON college_name.cid = enrollment_2011.cid
							INNER JOIN financial_2011
							ON college_name.cid = financial_2011.cid
							ORDER BY financial_2011.assets/enrollment_2011.total
							DESC
							LIMIT 5;
						');
						break;
					case "rps":
						$STH = $DBH->prepare
						('
							SELECT college_name.name, enrollment_2011.total, financial_2011.liabilities, financial_2011.assets, financial_2011.revenues, financial_2011.liabilities/enrollment_2011.total, financial_2011.assets/enrollment_2011.total, 
							financial_2011.revenues/enrollment_2011.total
							FROM college_name
							INNER JOIN enrollment_2011
							ON college_name.cid = enrollment_2011.cid
							INNER JOIN financial_2011
							ON college_name.cid = financial_2011.cid
							ORDER BY financial_2011.revenues/enrollment_2011.total
							DESC
							LIMIT 5;
						');
						break;
					
				}
				
				$STH->execute();
				 // Setting the fetch mode
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['total'].'</td>';
					echo '<td>'.$row['liabilities'].'</td>';
					echo '<td>'.$row['assets'].'</td>';
					echo '<td>'.$row['revenues'].'</td>';
					echo '<td>'.$row['financial_2011.liabilities/enrollment_2011.total'].'</td>';
					echo '<td>'.$row['financial_2011.assets/enrollment_2011.total'].'</td>';
					echo '<td>'.$row['financial_2011.revenues/enrollment_2011.total'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
			
		}
	}
	class question10 extends page
	{
		function __destruct()
		{
			
		}
		function get()
		{
			//$this->content .= $this->getQuery();
			$this->content .= $this->addHead();
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->addForm();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 10 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below is a form to select each college based on state initials</p>';
			
			return $var;
		}
		function addForm()
		{
			echo '<form action="project.php?page=question10" method="post"
						<p>
						<h2>Select College by State</h2>
						<LABEL for="state">State: </LABEL>
						<input type="text" name="state" id="state"><BR>
						<input type="submit" value="Send"> <INPUT type="reset">
			  			</p>
			 			</form>
			';
		}
		function post()
		{
			// print_r($_POST);
			$this->runQuery($_POST['state']);
		}
		function runQuery($state)
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				
				$STH = $DBH->prepare('SELECT name, state FROM college_name WHERE state = :state');
				$STH->bindParam(':state', $state);
				$STH->execute();
				 // Setting the fetch mode
				echo '<table>';
				echo '<tr><th>College Name</th><th>Net Assets per Student</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['state'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
			echo'<br><a href=./project.php?page=homepage>Home</a><br><br>';
			echo '<a href=./project.php?page=question10>Question 10</a>';
		}
	}
	class question11 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 11 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Total Percent Increase of Total Liabilities from 2010 to 2011</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query('SELECT college_name.name, 1-financial_2010.liabilities/financial_2011.liabilities  FROM college_name INNER JOIN financial_2010 ON college_name.cid = financial_2010.cid INNER JOIN financial_2011 ON college_name.cid = financial_2011.cid ORDER BY 1-financial_2010.liabilities/financial_2011.liabilities DESC;');

			
				 // Setting the fetch mode
				echo '<table>';
				echo '<tr><th>College Name</th><th>Percent Increase/Decrease Total Liabilities from 2010 to 2011</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					$percent = $row['1-financial_2010.liabilities/financial_2011.liabilities'] * 100;
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$percent.'%</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	class question12 extends page
	{
		function __destruct()
		{
			$this->content .= $this->menu();	
			echo $this->content;	//Menu here accesses the properties
			$this->runQuery();
		}
		function get()
		{
			
			$this->content .= $this->addHead();
			//$this->content .= $this->getQuery();
		}
		function addHead()
		{
			$var = '<h1>IS218 - College Information Project - Question 12 - Alex Koenig</h1>';
			$var .= '<p>The links below correspond to each question in the assignment (1 - 12) <br><br>';
			$var .= '<p>Below are the colleges, listed in order by Total Percent Increase of Total Student Enrollment from 2010 to 2011</p>';
			
			return $var;
		}
		function runQuery()
		{
			//set login credentials
			$host='sql2.njit.edu';
			$dbname='ahk4_proj';
			$user='ahk4_proj';
			$pass='0T8phDif';
			
			//Set up database handle
			try 
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);	
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				$STH = $DBH->query('SELECT college_name.name, 1-enrollment_2010.total/enrollment_2011.total  FROM college_name INNER JOIN enrollment_2010 ON college_name.cid = enrollment_2010.cid INNER JOIN enrollment_2011 ON college_name.cid = enrollment_2011.cid ORDER BY 1-enrollment_2010.total/enrollment_2011.total DESC;');

			
				 // Setting the fetch mode
				echo '<table>';
				echo '<tr><th>College Name</th><th>Percent Increase/Decrease Enrollment from 2010 to 2011</th></tr>';
				while($row = $STH->fetch())
				{
					echo '<tr>';
					$percent = $row['1-enrollment_2010.total/enrollment_2011.total'] * 100;
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$percent.'%</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
?>