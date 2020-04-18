<?php


	//default values
	$emailToLogin = "";
	$firstName = "";
	$lastName = "";
	$program = "";
	$program2 = "";
	$websiteAddress = "";
	$email = "";
	$linkedIn = "";
	$websiteAddress2 = "";
	$hometown = "";
	$careerGoals = "";
	$threeWords = "";
	$inRobotest = "";
	$submitConfirm = "";

	//default Err values
	$emailToLoginErr = "";
	$firstNameErr = "";
	$lastNameErr = "";
	$programErr = "";
	$program2Err = "";
	$websiteAddressErr = "";
	$emailErr = "";
	$linkedInErr = "";
	$websiteAddress2Err = "";
	$hometownErr = "";
	$careerGoalsErr = "";
	$threeWordsErr = "";
	$inRobotestErr = "";
	$submitConfirmErr = "";

	$validForm = false;

	if(isset($_POST["submitBio"])){	
		
		$emailToLogin = $_POST["emailToLogin"];
		$firstName = $_POST["firstName"];
		$lastName = $_POST["lastName"];
		$program = $_POST["program"];
		$program2 = $_POST["program2"];
		$websiteAddress = $_POST["websiteAddress"];
		$email = $_POST["email"];
		$linkedIn = $_POST["linkedIn"];
		$websiteAddress2 = $_POST["websiteAddress2"];
		$hometown = $_POST["hometown"];
		$careerGoals = $_POST["careerGoals"];
		$threeWords = $_POST["threeWords"];
		$inRobotest = $_POST["inRobotest"];
		$submitConfirm = $_POST["submitConfirm"];
		
		$message = "";
		

		//Input Field validations. 

		//validateLoginEmail
			//valid email should be in a proper format  
			//Matches: bob@aol.com | bob@wrox.co.uk | bob@domain.info |123@123.123
			//Non-Matches: a@b | notanemail | bob@@.
			function validateLoginEmail($inEmail){

				global $validForm, $emailToLoginErr;
	
				if(!filter_var($inEmail, FILTER_VALIDATE_EMAIL)){
					$validForm = false;
					$emailToLoginErr = "invalid email";
				}
			}

		//validateFirstName
			// valid first name should only include letters, numbers, and spaces
			// ... must be present

		function validateFirstName($inFName){

			global $validForm, $firstNameErr;

			
			if(!preg_match("/^([a-zA-Z' ]+)$/",$inFName)){
				$validForm = false;
				$firstNameErr = "First name must only contain letter, number, or spaces";
			}

			$inFName = trim($inFName);

			if($inFName == ""){
				$firstNameErr = "Cannot be empty";
			}
		}
		//validateLastName
			// valid last name should only include letters, numbers and spaces
			// ... must be present
			function validateLastName($inLName){

				global $validForm, $lastNameErr;
	
				
				if(!preg_match("/^([a-zA-Z' ]+)$/",$inLName)){
					$validForm = false;
					$lastNameErr = "First name must only contain letter, number, or spaces";
				}
	
	
				else if($inLName == ""){
					$lastNameErr = "Cannot be empty";
				}
			}	
		//validateProgram
			//valid program must not be default options

			
			function validateProgram($inProgram, $inProgram2){
				global $validForm, $programErr, $program2Err;

				if($inProgram == "default"){
					$validForm = false;
					$programErr = "Must select a program";
				}

				else if($inProgram2 == "none"){
					$validForm = true;
//$program2Err = "Must select a program";
				}

			}

		//validateWebsiteAddress
			//valid URL format
		function validateWebsiteAddress($inWebAddress){

			global $validFrom, $websiteAddressErr;
			$websiteAddressErr = "";
			
			if($inWebAddress == ""){
				$websiteAddressErr = "Please enter a valid URL address.";

			}
			
			else if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$inWebAddress)){
				$validFrom = false;
			
				$websiteAddressErr = "Please enter a valid URL address.";
			}
		}
		


		//validateWebsiteAddress2
			//valid URL format	

			function validateWebsiteAddress2($inWebAddress){
				global $validFrom, $websiteAddressErr;

				if($inWebAddress == ""){
					$websiteAddressErr = "Please enter a valid URL address.";
	
				}
				
				else if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$inWebAddress)){
					$validFrom = false;
				
					$websiteAddressErr = "Please enter a valid URL address.";
				}
			}
			
		//validateLinkedIn
			//valid URL to linkedin.com

			function validateLinkedIn($inLinked){
				global $validFrom, $linkedInErr;
				
				if($inLinked == ""){
					$validFrom = false;
				
					$linkedInErr = "Please enter a valid LinkedIn profile address.<br>Example: www.linkedin.com/in/name";
				}
				
				else if(!preg_match("/\b(?:www\.linkedin\.com\/in\/|https?:\/\/linkedin\.com\/in\/|https?:\/\/www\.linkedin\.com\/in\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$inLinked)){
					$validFrom = false;
				
					$linkedInErr = "Please enter a valid LinkedIn profile address.<br>Example: www.linkedin.com/in/name";
				}
			}


		//validateEmail
			//valid email should be in a proper format  
			//Matches: bob@aol.com | bob@wrox.co.uk | bob@domain.info |123@123.123
			//Non-Matches: a@b | notanemail | bob@@.
		function validateEmail($inEmail){

			global $validForm, $emailErr;

			if(!filter_var($inEmail, FILTER_VALIDATE_EMAIL)){
				$validForm = false;
				$emailErr = "invalid email";
			}
		}

		//validateHometown
			// valid name should only include letters, numbers, spaces, and commas
			// ... must be present

			function validateHometown($inHometown){
				global $validForm, $hometownErr;
			
			if(!preg_match("/^[a-zA-Z 1-9,]*$/", $inHometown)){
				$validForm = false;
				
				$hometownErr = "Only letters, numbers, spaces and commas allowed";
			}
			else if($inHometown == ""){
				$validForm = false;
				
				$hometownErr = "Field can not be blank.";
				}
			}

		//validateCareerGoals
			//valid career goals should include only numbers, letters, spaces, and basic punctuation
			function validateCareerGoals($inGoals){
				global $validForm, $careerGoalsErr;
				
				if(!preg_match("/^[a-zA-Z 1-9,.']*$/", $inGoals)){
					$validForm = false;
					
					$careerGoalsErr = "Only letters, numbers, spaces and basic punctuation allowed";
				}
				else if($inGoals == ""){
					$validForm = false;
					
					$careerGoalsErr = "Field can not be blank.";
				}
			}
		//validateThreeWords
			//valid three-words should include only numbers, letters, spaces, and basic punctuation
			function validateThreeWords($inThreeWords){
				global $validForm, $threeWordsErr;
				
				if(str_word_count($inThreeWords) != 3){
					$validForm = false;
					
					$threeWordsErr = "Must be three words";
				}
				else if($inThreeWords == ""){
					$validForm = false;
					
					$threeWordsErr = "Field can not be blank.";
				}
			}


			function checkHoney($inTest){
				global $validForm, $inRobotestErr;

				if($inTest != ""){
					$validForm = false;
					$inRobotestErr = "No thank you robot";
				}
			}

			$validForm = true;

		validateLoginEmail($emailToLogin);
		validateFirstName($firstName);
		validateLastName($lastName);
		validateProgram($program, $program2);
		validateWebsiteAddress($websiteAddress);

		if($program == 'webDevelopment'){

			validateWebsiteAddress2($websiteAddress2);
		}

		validateLinkedIn($linkedIn);
		validateHometown($hometown);
		validateCareerGoals($careerGoals);
		validateThreeWords($threeWords);
		validateEmail($email);


		
	}	
	else{
		$message = "Please enter your information.";
		
	}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>DMACC Portfolio Day Bio Form</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/normalize.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  
  <!-- css3-mediaqueries.js for IE less than 9 -->

<script src="css3-mediaqueries.js"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous">
  </script>
  <script>

	$(document).ready(function(){
		if( $("select[name=program]	option:selected").val() == "webDevelopment")
		{
			$(".secondWeb").css("display", "inline");
		}
		else
		{
			$(".secondWeb").css("display", "none");
		}
		
		$("select#program").change(function(){
			if( $("select#program option:checked").val() == "webDevelopment")
			{
				$(".secondWeb").css("display", "inline");
			}
			else
			{
				$(".secondWeb").css("display", "none");
			}
		});
		
		function resetForm(){
			$("#firstName").val("");
			$("#lastName").val("");
			$("#program").val("default");
			$("#websiteAddress").val("");
			$("#websiteAddress2").val("");
			$("#email").val("");
			$("#hometown").val("");
			$("#careerGoals").val("");
			$("#threeWords").val("");
		}
	});
	
	
	</script>
  
  <style>
	img{
		display: block;
		margin: 0 auto;
	}
	.frame{
		background-image: url("orange popsicle.jpg");
		padding: 1em;	
	}
	.frame2{
		background-image: url("citrus.jpg");
		padding: 1.3em;	
	}	
	body{
		background-image: url("bodacious.png");
		margin: 1.5em;
	}
	
	.main {
		padding: 1em;
		background-color: white;
	}
	form{
		text-align: center;
	}
	h2 {
		text-align: center;
	}
	.robotic{
		display: none;
	}

	.form {
		background-color:white;
		padding-left: 5em;
	}
	p {
		align:left;
	}	
	.citrus{
		margin: auto;
		background-image: url("raspberry.jpg");
		padding: 1.3em;	
		width: 70%;
	}
	.bamboo{
		background-image: url("bamboo.jpg");
		padding: 1em;	
	}	
	.violet{
		background-image: url("ultra violet.png");
		padding: .5em;	
	}	
	.secondWeb{
		display: none;
	}
	table{
		margin: auto;
	}
	table td{
		padding-bottom: .75em;
	}
	.error{
		font-style: italic;
		color: #d42a58;
		font-weight: bold;
	}

@media only screen and (max-width:620px) {
  /* For mobile phones: */
  img {
    width:100%;
  }
  .form {
	width:100%; 
	padding-left: .1em;
	padding-top: .1em;
  }
  .citrus {
	background-image:none;  
  }
  .bamboo {
	background-image:none;  
  } 
  .violet {
	background-image:none;  
  }  
  .secondWeb{
		display: none;
	}  
  table{
		margin: auto;
	}
  table td{
		padding-bottom: .5em;
	}
}
	
  </style>
  

  
</head>

<section class="orange">
<body>
<div class="frame2">
<div class="frame">

  <div class="main">
  <div><img src="madonna.gif" alt="Mix gif" ></div>
  <br>

<!--<a href = 'dmaccPortfolioDayLogout.php'>Log Out</a>-->

<section class="citrus">
<section class="bamboo">
<section class="violet">

	<div class="main form">
	
	
	<?php
			if($validForm)
			{
		?>

			<h1 style="text-align:center;"><?php echo $message . "Thank you for registering" ?></h1>
        
        <?php
			}
			else	//display form
			{
        ?>
	</table>
	<form id="portfolioBioForm" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
		<h1 style="font-size: 20px;"><?php echo $message ?></h1>
		<table>
		<tr>
		<td>Login Email:<br> <input type="text" id="emailToLogin" name="emailToLogin" value="<?php echo $emailToLogin ?>"/><span class="error" id="emailToLogin"><?php echo $emailToLoginErr ?></span></td>
		</tr>
		<tr>
		<td>First Name:<br> <input type="text" id="firstName" name="firstName" value="<?php echo $firstName ?>"/><br><span class="error" id="firstNameError"><?php echo $firstNameErr ?></span></td>
		</tr>
		<tr>
		<td>Last Name:<br> <input type="text" id="lastName" name="lastName" value="<?php echo $lastName ?>" /><br><span class="error" id="lastNameError"><?php echo $lastNameErr ?></span></td>
		</tr>
		<tr>
		<td >Program:<br> <select id="program" name="program">
				<option value="default">---Select Your Program---</option>
				<option value="animation" <?php if ($program == "animation") echo "selected"; ?>>Animation</option>
				<option value="graphicDesign" <?php if ($program == "graphicDesign") echo "selected"; ?>>Graphic Design</option>
				<option value="photography" <?php if ($program == "photography") echo "selected"; ?>>Photography</option>
				<option value="videoProduction" <?php if ($program == "videoProduction") echo "selected"; ?>>Video Production</option>
				<option value="webDevelopment" <?php if ($program == "webDevelopment") echo "selected"; ?>>Web Development</option>
			</select><br><span class="error" id="programError"><?php echo $programErr ?></span><td>
		</tr>
		<tr>
		<td >Secondary Program:<br> <select id="program2" name="program2">
				<option value="none" >---No Secondary Program---</option>
				<option value="animation" <?php if ($program2 == "animation") echo "selected"; ?>>Animation</option>
				<option value="graphicDesign" <?php if ($program2 == "graphicDesign") echo "selected"; ?>>Graphic Design</option>
				<option value="photography" <?php if ($program2== "photography") echo "selected"; ?>>Photography</option>
				<option value="videoProduction" <?php if ($program2 == "videoProduction") echo "selected"; ?>>Video Production</option>
				<option value="webDevelopment" <?php if ($program2 == "webDevelopment") echo "selected"; ?>>Web Development</option>
			</select><br><span class="error" id="program2Error"><?php echo $program2Err ?></span><td>
		</tr>
		<tr>
		<td>Website Address:<br> <input type="text" id="websiteAddress" name="websiteAddress" value="<?php echo $websiteAddress ?>"/><br><span class="error" id="websiteAddressError"><?php echo $websiteAddressErr ?></span></td>
		</tr>
		<tr>
		<td>Personal Email:<br><input type="text" id="email" name="email" value="<?php echo $email ?>" /><br><span class="error" id="emailError"><?php echo $emailErr ?></span></td>
		</tr>
		<tr>
		<td>LinkedIn Profile:<br><input type="text" id="linkedIn" name="linkedIn" value="<?php echo $linkedIn ?>" /><br><span class="error" id="linkedInError"><?php echo $linkedInErr ?></span></td>
		<tr>
		<td><span class="secondWeb">Secondary Website Address (git repository, etc.):<br> <input type="text" id="websiteAddress2" name="websiteAddress2" value="<?php echo $websiteAddress2 ?>"/></span><br><span class="error" id="websiteAddress2Error"><?php echo $websiteAddress2Err ?></span></td>
		</tr>
		<tr>
		<td>Hometown:<br> <input type="text" id="hometown" name="hometown" value="<?php echo $hometown ?>"/><br><span class="error" id="hometownError"><?php echo $hometownErr ?></span></td>
		</tr>
		<tr>
		<td>Career Goals:<br> <textarea id="careerGoals" name="careerGoals" ><?php echo $careerGoals ?></textarea><br><span class="error" id="careerGoalsError"><?php echo $careerGoalsErr ?></span></td>
		</tr>
		<tr>
		<td>3 Words that Describe You:<br> <input type="text" id="threeWords" name="threeWords" value="<?php echo $threeWords ?>"/><br><span class="error" id="threeWordsError"><?php echo $threeWordsErr ?></span></td>
		<p class="robotic" id="pot">
			<label>Leave Blank</label>
			<input type="hidden" name="inRobotest" id="inRobotest" class="inRobotest" />
		</p>
		<input type="hidden" id="submitConfirm" name="submitConfirm" value="submitConfirm"/>
		</tr>
		<tr>
		<td><input type="submit" id="submitBio" name="submitBio" value="Submit Bio" /></td>
		</tr>
		<tr>
		<td><input type="reset" id="resetBio" name="resetBio" value="Reset Bio" onclick="resetForm()"/></td>
		</tr>
		</table>
	</form>

	</div>
	

</section>	
</section>
</section>
  
</div>


<?php
            
        }//end else
        
    ?>  
</body>
</section>

</html>
