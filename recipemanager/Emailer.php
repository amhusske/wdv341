<?php

class Emailer {
    // This class will process a PHP email and send it

    //Properties
    private $message = "";
    
    private $recipientEmail = "";

    private $senderEmail = "";
    
    private $subject = "";

    //Constructor
        //-does NOT make a new object
        //-intializes the new object default values

   function public__construct(){

   }
    //Methods
        //setters- used to set property values
        public function set_message($inVal) {
            $this->message = $inVal;                  //assigns input to message 
          }

        public function set_recipientEmail($inVal) {
            $this->recipientEmail = $inVal;                  //assigns input to recipientEmail 
        }

        public function set_senderEmail($inVal) {
            $this->senderEmail = $inVal;                  //assigns input to sendersEmail
        }
        
        public function set_subject ($inVal) {
            $this->subject = $inVal;                  //assigns input to subject
        }

        //getters- return the property value from object
        public function get_message(){
            return $this->message;
        }
        public function get_recipientEmail(){
            return $this->recipientEmail;
        }
        public function get_senderEmail(){
            return $this->senderEmail;
        }
        public function get_subject(){
            return $this->subject;
        }
        
        //processing- everything else

        public function sendEmail(){
            //This will format and send an email to the SMTP server
            //it will use the PHP mail()
            $to = $this->get_recipientEmail();
            $subject = $this->get_subject();
            $message = $this->get_message();
            $headers = 'From: <abbyhusske@abbyhusske.com>';
            
            return mail($to,$subject,$message,$headers);

        }
}

?>