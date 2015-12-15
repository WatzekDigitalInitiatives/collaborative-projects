<?php

    if(isset($_POST['fred']) && $_POST['fred'] != '')
        die();

    if(isset($_POST['email'])) {

        if(!isset($_POST['name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['subject']) ||
            !isset($_POST['dlo128']) ||
            !isset($_POST['message'])) {
            die('');      
        }
         
        $name = $_POST['name']; 
        $email = $_POST['email'];
        $message = $_POST['message'];
        $email_subject = $_POST['subject'];
        $email_to = $_POST['dlo128'];
         
        $email_message = "Form details below.\n\n";
         
        function clean_string($string) {
          $bad = array("content-type","bcc:","to:","cc:","href");
          return str_replace($bad,"",$string);
        }
         
        $email_message .= "Name: ".clean_string($name)."\n";
        $email_message .= "Email: ".clean_string($email)."\n";
        $email_message .= "Message: ".clean_string($message);
         
        $headers[] = 'From: ' . $name .'<' . $email . '>' ."\r\n";
        $headers[] = 'Reply-To: ' . $email . "\r\n";

        mail($email_to, $email_subject, $email_message, $headers);
        
    }

?>