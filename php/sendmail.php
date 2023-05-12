<?php

if (isset($_POST['send'])) {

    $objet = $_POST['objet'];
    $mailFrom = $_POST['email'];
    $message = $_POST['message'];
    
    $mailTo = "thedrawman914@gmail.com";
    $subject = "From: ".$mailFrom;
    $txt = "Message recu de ". $mailFrom ." via onthefluss.com".".\n\n".$message;
    
    
    mail($mailTo, $objet, $txt, $subject);
    header("location: contact.php?mailsent");

}

?>