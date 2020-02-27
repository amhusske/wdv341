
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Test Emailer</title>
</head>
<style>

    body{
        background-color: lightgoldenrodyellow;
    }

    #container{
        width: 300px;
        display: block;
        margin: 0 auto;
        text-align: center;
        background-color: lightskyblue;
        padding: 25px;
    }
</style>
<body>
    <h1> Testing Emailer Class </h1>

    <div id="container">
    <?php
        require 'Emailer.php';

        $emailTest = new Emailer();

        $emailTest->set_senderEmail("amhusske1@gmail.com");
        echo "Sender: " . $emailTest->get_senderEmail();
        echo "<br>";

        $emailTest->set_recipientEmail("amhusske1@gmail.com");
        echo "Recipient: " . $emailTest->get_recipientEmail();
        echo "<br>";

        $emailTest->set_subject("Grade Attempt");
        echo "Subject: " . $emailTest->get_subject();
        echo "<br>";

        $emailTest->set_message("Message: I am contacting you regarding your program requirements");
        echo $emailTest->get_message();

       // echo $emailTest->get_recipientEmail();

        $result = $emailTest->sendEmail();  // send email to SMTP server
        
        //echo $result;

        
        if($result == true){
            echo('<style>
                #container{
                    background-color: green;
                }
            </style>');

            echo('<h1>Success!</h1>');

        }else{
            echo('<style>
            #container{
                background-color:blue;
            }
            </style>');
        }
        
    ?>
    </div>
</body>
</html>