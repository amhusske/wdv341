<?php

	//default values
	$event_name = "";
	$event_description = "";
	$event_presenter = "";
	$event_date = "";
    $event_time = "";
    $submitConfirm = "";

	//default Err values
	$eventNameErrMsg = "";
	$eventDescriptionErrMsg = "";
	$presenterErrMsg = "";
	$dateErrMsg = "";
    $timeErrMsg = "";
    $submitConfirmErr = "";
    


    $todaysDate = date("Y-m-d");		//use today's date as the default input to the date( )


    $validForm = false;

	if(isset($_POST["submitButton"])){	
		
        $event_name = $_POST['event_name'];		
        $event_description = $_POST['event_description'];	 
        $event_date = $_POST['event_date'];			
        $event_time = $_POST['event_time'];
        $event_presenter =  $_POST['event_presenter'];
        
    
        /*    FORM VALIDATION PLAN
        
                FIELD NAME      VALIDATION TESTS & VALID RESPONSES
                
                Event Name            Required Field        May not be empty
                Event Desciption      Required Field        May not be empty 
                                                            Between 
                Event Date          Required Field    Format 
                Event time          Required Field    Format
                Event Presenter     Required Field    name space name, cannot be empty

      */

      //VALIDATION FUNCTIONS		Use functions to contain the code for the field validations.  

      function validateEventName($inEventName)
			{
                //Use the GLOBAL Version of these variables instead of making them local
				global $validForm, $eventNameErrMsg;		
				$eventNameErrMsg = "";
                $inEventName = trim($inEventName);
                
				if($inEventName == "")
				{
					$validForm = false;
                    $eventNameErrMsg = "Name cannot be spaces";
				}
            }//end validateName()


            function validateDescription($inDescription){

                global $validForm, $eventDescriptionErrMsg;
                $inDescription = trim($inDescription);

                if ($inDescription == "") {

                    $validForm = false;
                    $eventDescriptionErrMsg = 'Please enter a description of your event.';
                }
            }


            function validatePresenter($inPresenter){
                global $validForm, $presenterErrMsg;
                $inPresenter = trim($inPresenter);

                if($inPresenter == "") {

                    $validForm = false;
                    $presenterErrMsg = 'You must enter a presenter for the event';
                }

            }
            

      $validForm = true;

      validateEventName($event_name);
      validateDescription($event_description);
      validatePresenter($event_presenter);


      if($validForm)
		{
            $message = "All good";
            
            try {
				
				require 'dbconnect.php';	//CONNECT to the database
               
                // PDO Prepared Statements 

                 //1. Create sql statement w/ name placeholders
                    $sql = "INSERT INTO wdv341_event(event_name, event_description, event_date, event_time, event_presenter)
                    VALUES(:eventName, :eventDescription, :eventDate, :eventTime, :eventPresenter)";
     
                 //2. Create the prepared statment object by passing the statement into the prepare function
                    $stmt = $conn->prepare($sql);
                 
                 //3. Bind paramters to the prepared statment object

                    $stmt->bindParam(':eventName', $event_name);
                    $stmt->bindParam(':eventDescription', $event_description);
                    $stmt->bindParam(':eventDate', $event_date);
                    $stmt->bindParam(':eventTime', $event_time);
                    $stmt->bindParam(':eventPresenter', $event_presenter);
            

                 //4. EXECUTE the prepared statement
                    $stmt->execute();
                    
                //Update message
                $message = "The event has been added.";
            }

            catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());	//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
				//header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
			}
        }	
        else
		{
			$message = "Something went wrong";
		}//ends check for valid form		
    }   
    else
    {
		//Form has not been seen by the user.  display the form
		
	}// ends if submit


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Events Self- Posting Form</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  
  <style>
	.errMsg{
        color: #fc1303;
    }
	
  </style>
  

  
</head>

<script>
$(document).ready(function(){
    $(".req").hide();
});

</script>
<body>

  <h1>Add a new Event</h1>

        <?php
            //If the form was submitted and valid and properly put into database display the INSERT result message
			if($validForm)
			{
		?>
		
            <h1><?php echo "HELLO" . $message . $validForm?></h1>
        
        <?php
			}
			else	//display form
			{
        ?>
    
    <form id="form1" name="form1" method="post" action="processEvents.php">

    <span><?php echo $validForm; ?> </span>
         <p>
           <label for='event_name'>Event Name:</label>
           <input type="text" name="event_name" id="eventName"  value="<?php echo $event_name;  ?>" required/>
           <span class="errMsg"> <?php echo $eventNameErrMsg; ?> </span>
         </p>
         
         <p>
           <label for='event_description'>Even Decription (Up to 50 Characters): </label>
           <br>
           <textarea rows='4' cols='50' maxlength="50" name="event_description" id="eventDescription" required> <?php echo $event_description;  ?></textarea>
           <span class="errMsg"> <?php echo $eventDescriptionErrMsg; ?> </span>

         </p> 
   
         <p>
           <label for="event_presenter">Event Presenter: </label>
           <input type="text" name="event_presenter" id="eventPresenter"  value="<?php echo $event_presenter;  ?>"required />
           <span class="errMsg"> <?php echo $presenterErrMsg; ?></span>
         </p>
       
         <p>
           <label for="event_date"> Date(dd/mm/YYYY):  </label>
           <input type="date" name="event_date" id="eventDate"  min="<?php echo $todaysDate; ?>" max="2021-12-30" value="<?php echo $event_date;  ?>"required/>
           <span class="errMsg"> <?php echo $dateErrMsg; ?></span>
   
         </p>
     
          <p>
            <label for="event_time">Event Time: </label>
           <input type="text" name="event_time" id="eventTime" value="<?php echo $event_time;  ?>" required/>
         </p>

         <span class="errMsg"> <?php echo $timeErrMsg; ?></span>



         <div class='req'>
			<label>Leave Blank</label>
			<input type="hidden" name="inTest" id="inTest" class="inTest" />
         </div>

		<input type="hidden" id="submitConfirm" name="submitConfirm" value="submitConfirm"/>
		
        <input type="submit" name="submitButton" id="button" value="Submit" />
	
		
	</form>
    <?php
            
        }//end else
        
    ?>  


</body>

</html>
