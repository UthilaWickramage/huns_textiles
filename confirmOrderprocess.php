<?php
require "connection.php";
use PHPMailer\PHPMailer\PHPMailer;

require './phpMailer/Exception.php';
require './phpMailer/PHPMailer.php';
require './phpMailer/SMTP.php';
$oid = $_GET["oid"];


$irs = Database::select("SELECT * FROM `invoice` WHERE `order_id`='".$oid."'");
$irnum = $irs->num_rows;

if($irnum==1){
    $iirow = $irs->fetch_assoc();
    Database::uid("UPDATE `invoice` SET `status`=2 WHERE `order_id`='".$oid."'");
    $users = Database::select("SELECT * FROM `user` WHERE `email`='" . $iirow["user_email"] . "'");
    $userrow = $users->fetch_assoc();
    $email = $userrow["email"];
    
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com'; //our email provider company use this for gmail only
    $mail->SMTPAuth = true;
    $mail->Username = 'hansasolutions00@gmail.com'; //sending email(my email)
    $mail->Password = 'UthilaMSI2021'; //sending email(my email) password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('hansasolutions00@gmail.com', 'hunsTextiles'); //sending email
    $mail->addReplyTo('hansasolutions00@gmail.com', 'hunsTextiles'); //reply mail
    $mail->addAddress($email); //recieving email
    $mail->isHTML(true);
    
    $mail->Subject = 'HunsTextiles, Your Order is Verified and Packed'; //email subject
    $bodyContent = '<div style=" padding: 25px;">
    <div style="text-align: center;">
    <img src="https://files.fm/thumb_show.php?i=jkd8vrs7v" alt="" height="100px" width="auto">
   
    <div style="text-align: center;">
    <h2>Hey!&nbsp;' . $userrow["fname"] . " " . $userrow["lname"] . '</h2>
    
    
    </div>
    <div style="text-align: center;">
    <h3>Order No:'. $oid.'</h3>
    <p style="font-size="34px">We are so exited to tell you that your order has been verifed, packed and will handed over to our logistic partner. </p>
    
    <p>Expect your package to arrive within 3-4 Days.</p>
    
    </div>
    
    
    
    
    <button style="font-size:20px; color: white; background-color: rgb(50, 50, 255); padding: 15px; border: none; border-radius: 5px;">Track My order</button>
    
  
    <p>&copy; 2021 HunsTextiles.store All Rights Reserved</p>
   
    </div>'; //email content
    $mail->Body    = $bodyContent;
    
    if (!$mail->send()) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'success';
    }
}else{

}

?>