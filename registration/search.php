<html>
<head>
<Title>Registration Form</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: center; border: none; padding: 1em; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; text-align: center; }
</style>
</head>
<body>

<h1>Search by Company</h1>
<p>Enter the company name of the employees to view their details.</p>
<form method="post" action="search.php" enctype="multipart/form-data" >
     
	   Name <input type="text" name="company_name" id="company_name" /></br></br>
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b4c5c88459dd34";
    $pwd = "e3918f6d";
    $db = "mem0AuFGqOiGNi3J";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Insert registration info
    if(!empty($_POST)) {
    try {
        
		$company_name = $_POST['company_name'];
		
		$sql_select = "SELECT * FROM registration_tbl WHERE company_name= '$company_name'";
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
        echo "<h2>People who work at the specified company: </h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Email</th>";
		echo "<th>company_name</th>";
        echo "<th>Date</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
			echo "<td>".$registrant['company_name']."</td>";
            echo "<td>".$registrant['date']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>No one is employed at the specified company.</h3>";
    }
       }
    catch(Exception $e) {
        die(var_dump($e));
    }
    echo "<h3>Search complete!</h3>";
    }    
?>

<a href="index.php"> Click Here to return to Index </a>
</body>
</html>