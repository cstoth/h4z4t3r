<?php

namespace App\Mail\Frontend;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/**
 * Class SendContact.
 */
class SendMail
{
    public static function send($params) {
        //dd($params);
        $mail = new PHPMailer(true);
        $emailAddress = 'toth.csaba.tanas@freemail.hu';
        try {
            $mail->SMTPDebug = 5;
            $mail->CharSet = 'UTF-8';
            //$mail->isSMTP();
            $mail->Host = 'smtp.webonic.hu';
            $mail->SMTPAuth = true;
            $mail->Username = 'registration@hazater.hu';
            $mail->Password = 'hOJ8SEr3JAK6';
            $mail->smtpConnect(
                array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                )
            );
            $mail->Port = 25;
        
            $mail->setFrom('registration@hazater.hu', "hazater");
            $mail->addReplyTo('registration@hazater.hu', 'hazater');
            $mail->addAddress($emailAddress);
        
            $mail->isHTML(true);
            $mail->Subject = 'Contact';
            //email
            //phone
            $mail->Body    = $params['message'];
            $mail->send();
            return true;
        } catch (Exception $e) {
            //$response['error'] = $e;
            dd($e);
            return $e;
        }        
    }
}