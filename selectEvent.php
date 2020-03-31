<?php
	try {
	  
	  require 'dbconnect.php';	//CONNECT to the database
	  
	  
	  //Create the SQL command string
	  $sql = "SELECT ";
	  $sql .= "event_name, ";
	  $sql .= "event_description, ";
	  $sql .= "event_date, ";
	  $sql .= "event_time, ";
      $sql .= "event_presenter ";
	
      $sql .= "FROM wdv341_event WHERE event_id= 4 ";
      
	  
	  //PREPARE the SQL statement
	  $stmt = $conn->prepare($sql);
	  
	  //EXECUTE the prepared statement
	  $stmt->execute();		
	  
	  //Prepared statement result will deliver an associative array
	  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  }
  
  catch(PDOException $e)
  {
	  $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

	  error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
	  error_log($e->getLine());
	  error_log(var_dump(debug_backtrace()));
  
	  //Clean up any variables or connections that have been left hanging by this error.		
  
	  header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
  }

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Select Event</title>

</head>
<style>
    
    #container{
        text-align: center;
        width: 80%;
        margin: 0 auto;
        background-color: #a8b89c;
        border: 2px solid black;
    }

    h1{
         color: white;
    }
    td, th {
        padding: 10px;
    }
</style>
<body>

<div id="container">

	<header>
    	<h1>Intro PHP</h1>
    </header>
    
    
    <main>
    
        <h1>Display All Events</h1>
       <table>

        <tr>
            <th>Event Name</th>
            <th>Event Description</th>
            <th> Event Time </th>
            <th> Event Date</th>
            <th>Event Presenter</th>
        </tr>
      
        <?php 
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>		
            <tr>
                    <td><?php echo $row['event_name']; ?></td>
                    <td><?php echo $row['event_description']; ?></td>
                    <td><?php echo $row['event_time']; ?></td>
                    <td><?php echo $row['event_date'] ?></td>
                    <td><?php echo $row['event_presenter']  ?></td>
        <?php
			}
        ?>	

        </table>
  	
        
	</main>
    
	<footer>
    	<p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>
    
    </footer>




</div>
</body>
</html>
