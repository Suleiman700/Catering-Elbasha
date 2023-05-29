<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['sendMail']) && !empty($_POST['name']) && !empty($_POST['phone'])) {
    //Include packages and files for PHPMailer and SMTP protocol
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    include_once './dates.php';

    // Change these values
    $smtp_host = "smtp.gmail.com"; // SMTP host
    $smtp_user = "youremail@gmail.com"; // Your email
    $smtp_pass = "your_gmail_password"; // Your password
    $smtp_port = "587"; // 587
    $smtp_auth = "TRUE"; // TRUE
    $smtp_secure = "tls"; // tls

    // Change these values
    $company_name = "Catering"; // Company name
    $my_timezone = "Asia/Jerusalem"; // Change to your timezone
    $your_email = "your_email_here@domain.com"; // Your email here (To receive the registrations)

    // Change these values
    $mail_title = "Catering Registration"; // Mail title
    $mail_subject = "New Catering Registrations Form"; // Mail subject
    $mail_from = "from@catering.com"; // Set mail from
    $mail_from_name = "From Catering"; // Set mail from name

    /* true / false (If you want to also save to a txt file) - optional
     * If yes, a txt file will be created and will contain all data about people who registered in the form
     */
    $save_to_txt_file = true;
    $txt_filename = "form-registration.txt";




    $today_date = dates("today_flipped"); // Dont Change
    $time = timezone_date_hour("hour", $my_timezone); // Dont Change

    //Initialize PHP Mailer and set SMTP as mailing protocol
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

    //required parameters for making an SMTP connection like server
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = $smtp_auth; //TRUE
    $mail->SMTPSecure = "$smtp_secure"; //tls
    $mail->Port = $smtp_port;
    $mail->Host = $smtp_host;
    $mail->Username = $smtp_user;
    $mail->Password = $smtp_pass;

    // Get Post data
    $full_name = ($_POST['name'])? strip_tags($_POST['name']):'--';
    $reg_phone = ($_POST['phone'])? strip_tags($_POST['phone']):'--';
    $event_type = ($_POST['event_type'])? strip_tags($_POST['event_type']):'--';
    $need_tools = ($_POST['need_tools'])? strip_tags($_POST['need_tools']):'--';
    $event_date = ($_POST['date'])? strip_tags($_POST['date']):'--';
    $event_time = ($_POST['time'])? strip_tags($_POST['time']):'--';
    if (isset($_POST['contact_message'])) $reg_message = strip_tags($_POST['contact_message']);
    else if (!isset($_POST['contact_message']) && isset($_POST['note'])) $reg_message = strip_tags($_POST['note']);
    else $reg_message = '---';

    // Save to txt file (optional)
    if ($save_to_txt_file) {
        $data = PHP_EOL . "Name: " . $full_name . PHP_EOL . "Phone: " . $reg_phone . PHP_EOL . "Event Type: " . $event_type . PHP_EOL . "Need Tools: " . $need_tools . PHP_EOL . "Event date: " . $event_date . PHP_EOL . "Event Time: " . $event_time . PHP_EOL . "Event Description: " . $reg_message . PHP_EOL . $today_date . " - " . $time . PHP_EOL . $_SERVER['REMOTE_ADDR'] . PHP_EOL . '------------';
        $fp = fopen('../' . $txt_filename, 'a');
        fwrite($fp, $data);
        fclose($fp);
    }

    $content = "";

    if (is_null($content) || empty($content)) {

        $use_premade_template = true; // Change to your needs

        if ($use_premade_template) {
            // This is a demo mail template that suits the original contact form
            $content = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title></title>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

</head>
<body style="margin: 0; padding: 0;">
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f3f3f3; min-width: 340px; font-size: 1px; line-height: normal;">
  <tr>
    <td align="center" valign="top">
      <table cellpadding="0" cellspacing="0" border="0" width="650" class="table650" style="width: 100%; max-width: 650px; min-width: 340px; background: #f3f3f3;">
        <tr>
          <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
          <td align="center" valign="top" style="background: #ffffff;"><table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
              <tr>
                <td align="right" valign="top"><div class="top_pad" style="height: 25px; line-height: 25px; font-size: 23px;">&nbsp;</div></td>
              </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" width="90%" style="width: 90% !important; min-width: 90%; max-width: 90%; padding-top: 25px;">
                     <tr>
                       <td align="left" valign="top" class="mob_title1" style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #333333; font-size: 32px; text-align: center;">New Registration !<div style="height: 10px;">&nbsp;</div></td>
              </tr>
                     <tr>
                       <td align="left" valign="top" style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #666666; font-size: 18px; text-align: center;">
                         Catering Contact Form.
                       </td>
                     </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" width="70%" style="width: 70% !important; min-width: 70%; max-width: 70%; background: #f7f7f7; border-top-left-radius: 8px; border-top-right-radius: 8px; margin-top: 40px;">
              <tr>
                <td width="10" style="width: 10px; max-width: 10px; min-width: 10px;">&nbsp;</td>
                <td align="center" valign="top"><div style="height: 8px; line-height: 8px; font-size: 6px;">&nbsp;</div>
                  <div style="display: inline-block; vertical-align: top; width: 88%; min-width: 260px;">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%;">
                      <tr>
                        <td width="6" style="width: 6px; max-width: 6px; min-width: 6px;">&nbsp;</td>
                        <td class="mob_center" align="center" valign="top" style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 16px; line-height: 25px; font-weight: 600; text-decoration: none;"><div style="height: 10px; line-height: 10px; font-size: 8px;">&nbsp;</div>
							- ' . $full_name . ' -
                        </td>
						  
                        <td width="6" style="width: 6px; max-width: 6px; min-width: 6px;">&nbsp;</td>
                      </tr>
						 <tr>
                        <td width="6" style="width: 6px; max-width: 6px; min-width: 6px;">&nbsp;</td>
                        <td class="mob_center" align="center" valign="top"  style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #888888; font-size: 14px; line-height: 22px;">
                        ' . $today_date . ' | ' . $time . '</td>
						  
                        <td width="6" style="width: 6px; max-width: 6px; min-width: 6px;">&nbsp;</td>
                      </tr>
                    </table>
                  </div>
                  <div style="height: 18px; line-height: 18px; font-size: 16px;">&nbsp;</div></td>
                <td width="10" style="width: 10px; max-width: 10px; min-width: 10px;">&nbsp;</td>
              </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" width="70%" style="width: 70% !important; min-width: 70%; max-width: 70%; border-width: 1px; border-style: solid; border-color: #e5e5e5; border-top: none;">
              <tr>
                <td width="5%" style="width: 5%; max-width: 5%; min-width: 5%;">&nbsp;</td>
                <td align="left" valign="top" class="mob_txt" style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #666666; font-size: 16px; text-align: center;"><div style="height: 10px; line-height: 24px; font-size: 16px;">&nbsp;</div>
                  <p>Name: ' . $full_name . '</p>
                  <p>Phone: ' . $reg_phone . '</p>
                  <p>Event Type: ' . $event_type . '</p>
                  <p>Need Tools: ' . $need_tools . '</p>
                  <p>Event Date: ' . $event_date . '</p>
                  <p>Event Time: ' . $event_time . '</p>
                  <p>Description: ' . $reg_message . '</p>
                  <br>
                <td width="5%" style="width: 5%; max-width: 5%; min-width: 5%;">&nbsp;</td>
              </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" width="70%" style="width: 70% !important; min-width: 70%; 0max-width: 70%;">
              <tr>
                <td align="center" valign="top"><div class="min_pad2" style="height: 30px; line-height: 30px; font-size: 30px;">&nbsp;</div>
                  <table class="mob_btn" cellpadding="0" cellspacing="0" border="0" width="200" style="width: 200px !important; max-width: 200px; min-width: 200px; background: #144e75; border-radius: 4px;">
                    <tr>
                      <td align="center" valign="middle" height="50"><a href="" target="_blank" style="display: block; width: 100%; height: 50px; font-family: Source Sans Pro, Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 18px; line-height: 50px; text-decoration: none; white-space: nowrap; font-weight: 600;"> THANKS! </a></td>
                    </tr>
                </table>                  <div class="min_pad2" style="height: 50px">&nbsp;</div></td>
              </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
              <tr>
                <td align="center" valign="top"><div style="height: 34px;">&nbsp;</div>
                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                    <tr>
                      </table>
                        <div style="height: 20px;">&nbsp;</div>
                        <font face="Source Sans Pro, sans-serif" color="#999999" style="font-size: 12px; "> Mauris nec commodo nisi. Aliquam id semper justo. Cras ut <br>
                          metus cursus, aliquam nunc in, maximus ipsum. </font>
                        <div style="height: 17px;">&nbsp;</div>
                        <div style="height: 34px;">&nbsp;</div>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
        </tr>
      </table></td></tr>
</table>
</body>
</html>';
        }
        else {
            // You can use this template too
            $content = "
                    <p>' . $today_date . ' | ' . $time . '</p>
                    <p>Name: ' . $full_name . '</p>
                    <p>Phone: ' . $reg_phone . '</p>
                    <p>Event Type: ' . $event_type . '</p>
                    <p>Need Tools: ' . $need_tools . '</p>
                    <p>Event Date: ' . $event_date . '</p>
                    <p>Event Time: ' . $event_time . '</p>
                    <p>Description: ' . $reg_message . '</p>";
        }



        //required parameters for email header and body
        $mail->IsHTML(true);
        $mail->AddAddress($your_email, $mail_title);
        $mail->SetFrom($mail_from, $mail_from_name);
        $mail->AddReplyTo($your_email, $company_name);
        $mail->Subject = $mail_subject;
        $content = $content;

        //Send the email and catch required exceptions
        $mail->MsgHTML($content);
        if (!$mail->Send()) {
            echo json_encode(array("statusCode" => 201));
            return 0;
        } else {
            echo json_encode(array("statusCode" => 200));
            return 1;
        }
    }




}