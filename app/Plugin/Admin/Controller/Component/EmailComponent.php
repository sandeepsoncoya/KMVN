<?php
 
App::uses('Component', 'Controller');
App::import('Vendor', 'phpmailer', array('file' => 'phpmailer'.DS.'class.phpmailer.php'));
 
class EmailComponent extends Component {
 
    public function send($to, $subject, $message) { 

        $sender = "sandeep.kumar@soncoya.in"; // this will be overwritten by GMail   
        $header = "X-Mailer: PHP/".phpversion() . "Return-Path: $sender"; 
        $mail = new PHPMailer(); 
        $mail->IsSMTP();
        $mail->Host = "smtp.zoho.com"; 
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        //$mail->SMTPDebug  = 2; // turn it off in production
        $mail->Username   = "sandeep.kumar@soncoya.in";  
        $mail->Password   = "san@man@1985";      
        $mail->FromName = "Soncoya Solutions"; 
        $mail->From = $sender;
        $mail->AddReplyTo = $sender;
        $mail->AddAddress($to); 
        $mail->IsHTML(true);
        $mail->CreateHeader($header); 
        $mail->Subject = $subject;
        $html = "";
        $html .='<html lang="en">';
           $html .='<head>';
                $html .='<meta content="text/html; charset=utf-8" http-equiv="Content-Type">';
                $html .='<title>Classical';
                $html .='</title>';
                $html .='<style type="text/css">a:hover { text-decoration: none !important; }.header h1 ';
                $html .='{color:#fff !important; font: normal 33px Georgia, serif; margin: 0; padding: 0; line-height: 33px;}
                    .header p {color: #dfa575; font: normal 11px Georgia, serif; margin: 0; padding: 0; line-height: 11px; letter-spacing: 2px}
                    .content h2 {color:#8598a3 !important; font-weight: normal; margin: 0; padding: 0; font-style: italic; line-height: 30px; font-size: 30px;font-family: Georgia, serif; }
                    .content p {color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px;font-family: Georgia, serif;}
                    .content a {color: #d18648; text-decoration: none;}
                    .footer p {padding: 0; font-size: 11px; color:#fff; margin: 0; font-family: Georgia, serif;}
                    .footer a {color: #f7a766; text-decoration: none;}';
                $html .='</style>';
            $html .=' </head>';
            $html .='<body style="margin: 0; padding: 0; background: #bccdd9;">';
                $html .='<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">';
                    $html .='<tr>';
                        $html .='<td align="center" style="margin: 0; padding: 0; padding: 35px 0">';
                            $html .='<table cellpadding="0" cellspacing="0" border="0" align="center" width="650" style="font-family: Georgia, serif;" class="header">';
                                $html .='<tr>';
                                    $html .='<td bgcolor="#116fa0" height="115" align="center">';
                                        $html .='<h1 style="color: #fff; font: normal 33px Georgia, serif; margin: 0; padding: 0; line-height: 33px;">Soncoya Solutions</h1><br>';
                                        $html .='<p style="color: #dfa575; font: normal 11px Georgia, serif; margin: 0; padding: 0; line-height: 11px;">Ticketing System</p>';
                                    $html .='</td>';
                                $html .='</tr>';
                                $html .='<tr>';
                                    $html .='<td style="font-size: 1px; height: 5px; line-height: 1px;" height="5">&nbsp;</td>';
                                $html .='</tr> ';
                            $html .='</table>';
                            $html .='<table cellpadding="0" cellspacing="0" border="0" align="center" width="650" style="font-family: Georgia, serif; background: #fff;" bgcolor="#ffffff">';
                                $html .='<tr>';
                                    $html .='<td width="14" style="font-size: 0px;" bgcolor="#ffffff">&nbsp;</td>';
                                    $html .='<td width="620" valign="top" align="left" bgcolor="#ffffff"style="font-family: Georgia, serif; background: #fff;">';
                                        $html .='<table cellpadding="0" cellspacing="0" border="0"  style="color: ##116fa0; font: normal 11px Georgia, serif; margin: 0; padding: 0;" width="620" class="content">';
                                            $html .='<tr>';
                                                $html .='<td style="padding: 15px 0 15px; border-bottom: 1px solid #d2b49b; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px;font-family: Georgia, serif;"  valign="top">'.$message;
                                                $html .='</td>';
                                            $html .='</tr>';
                                        $html .='</table>';    
                                    $html .=' </td>';
                                $html .='</tr>';
                            $html .='</table>';
                            $html .='<table cellpadding="0" cellspacing="0" border="0" align="center" width="650" style="font-family: Georgia, serif; line-height: 10px;" bgcolor="#116fa0" class="footer">';
                                $html .='<tr>';
                                    $html .='<td bgcolor="#116fa0"  align="center" style="padding: 15px 0 10px; font-size: 11px; color:#fff; margin: 0; line-height: 1.2;font-family: Georgia, serif;" valign="top">';
                                    $html .='<p style="padding: 0; font-size: 11px; color:#fff; margin: 0; font-family: Georgia, serif;">Soncoya Ticketing System</p>';
                               
                                    $html .='</td>';
                                $html .='</tr> ';
                            $html .='</table>';
                        $html .='</td>';
                    $html .='</tr>';
                $html .='</table>';
            $html .='</body>';
        $html .='</html>';
        $mail->Body    = nl2br($html);
        $mail->AltBody = nl2br($html);
        if(!$mail->Send()) {
            return array('error' => true, 'message' => 'Mailer Error: ' . $mail->ErrorInfo);
        }else {
            return array('error' => false, 'message' =>  "Message sent!");
        }
      }
    }

?>