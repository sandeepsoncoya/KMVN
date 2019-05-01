<?php
 
App::uses('Component', 'Controller');
App::import('Vendor', 'phpmailer', array('file' => 'phpmailer'.DS.'class.phpmailer.php'));
 
class EmailComponent extends Component {
 
    public function send($to, $subject, $message) { 
        $path = Configure::read('siteUrlfront');
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
        $mail->FromName = "Soncoya Solutions Pvt. Ltd."; 
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
            $html .='<body style="padding:0;margin:0;">
            <table cellspacing="0" cellpadding="0" border="0" bgcolor="#f0f0ed" width="100%">
                <tbody>
                    <tr><td height="20"></td></tr>
                    <tr>
                        <td>
                            <table cellspacing="0" cellpadding="0" border="0" width="600" align="center" bgcolor="#ffffff" style="border: 1px solid #e6e6e6;">
                                <tbody>
                                    <tr>
                                        <td width="16"></td>
                                        <td width="568">
                                            <table cellspacing="0" cellpadding="0" border="0" width="568">
                                                <tbody>
                                                    <tr><td height="20" style="line-height:0;"></td></tr>
                                                    <tr>
                                                        <td>
                                                            <table cellspacing="0" cellpadding="0" border="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="center" width="171" style="line-height: 0;"><img style="margin-bottom:-10px;" src="'.$path.'image/logo.png" alt="Soncoya Logo" /></td>
                                                                        <td width="285"></td>
                                                                        <td style="line-height:0;">
                                                                            <a style="line-height:0; display:inline-block;" href="http://www.facebook.com" target="_blank"><img style="border:none;" src="'.$path.'image/facebook.png" alt="Facebook Icon" /></a>
                                                                            <a style="line-height:0; display:inline-block;" href="http://www.twitter.com" target="_blank"><img style="border:none;" src="'.$path.'image/twitter.png" alt="Twitter Icon" /></a>
                                                                            <a style="line-height:0; display:inline-block;" href="http://www.instagram.com" target="_blank"><img style="border:none;" src="'.$path.'image/instagram.png" alt="Instagram Icon" /></a>
                                                                            <a style="line-height:0; display:inline-block;" href="http://www.linkedin.com" target="_blank"><img style="border:none;" src="'.$path.'image/linkedin.png" alt="Linkedin Icon" /></a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr><td height="20" style="line-height:0;"></td></tr>
                                                    <tr><td height="2" style="line-height:0;" bgcolor="#32627e"></td></tr>
                                                    <tr><td height="30" style="line-height:0;"></td></tr>
                                                    <tr>
                                                        <td>
                                                            <h4 style="font-size:20px;text-transform: uppercase;font-weight: 700;margin:0 0 10px 0;">What is Lorem Ipsum ?</h4> 
                                                            <p style="margin:0 0 10px 0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                        </td>
                                                    </tr>
                                                    <tr><td height="20" style="line-height:0;"></td></tr>
                                                    <tr>
                                                        <td>
                                                            <h4 style="font-size:20px;text-transform: uppercase;font-weight: 700;margin:0 0 10px 0;">What is Lorem Ipsum ?</h4>
                                                            <p style="margin:0 0 10px 0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                                                            <p style="margin:0 0 10px 0">It to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                        </td>
                                                    </tr>
                                                    <tr><td height="30" style="line-height:0;"></td></tr>
                                                    <tr><td height="1" style="line-height:0;" bgcolor="#cccccc"></td></tr>
                                                    <tr><td height="20" style="line-height:0;"></td></tr>
                                                    <tr>
                                                        <td>
                                                            <table cellpadding="0" cellspacing="0" border="0" width="568">
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="189" align="left">
                                                                            <div style="display:inline-block">
                                                                                <img style="display:block;margin:0 auto;" src="'.$path.'image/icon_call.png" alt="Icon Call">
                                                                                <p style="margin:5px 0 0 0;font-size:12px;">Request a Call back</p>
                                                                            </div>
                                                                        </td>
                                                                        <td width="189" align="center">
                                                                            <div style="display:inline-block">
                                                                                <img style="display:block;margin:0 auto;" src="'.$path.'image/icon_phone.png" alt="Icon Call">
                                                                                <p style="margin:5px 0 0 0;font-size:12px;">Call :+91-9959595959</p>
                                                                            </div>
                                                                        </td>
                                                                        <td width="190" align="right">
                                                                            <div style="display:inline-block">
                                                                                <img style="display:block;margin:0 auto;" src="'.$path.'image/icon_mail.png" alt="Icon Call">
                                                                                <p style="margin:5px 0 0 0;font-size:12px;">Email Us: info@soncoya.in</p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr><td height="20" style="line-height:0;"></td></tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td width="16"></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr><td height="20"></td></tr>
                </tbody>
            </table>
        </body>';
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