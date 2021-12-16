<?php
if (isset($_POST['submit-c'])) {
    $name = $_POST['fname']; // nom ou prénom
    $from = $_POST['email']; //c'est l'adresse e-mail de l'expéditeur
    $message = $_POST['message']; // Message 

    // Host 
    $email_host = 'contact@pmu-ecommerce.000webhostapp.com';
    $name_host = 'Contact pmu-ecommerce.000webhostapp.com';

    $subject = 'Email de contact PMU';

    $messagehtml = '<table class="full-width-container" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#eeeeee" style="width: 100%; height: 100%; padding: 30px 0 30px 0;">
    <tr>
        <td align="center" valign="top">
            <!-- / 700px container -->
            <table class="container" border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="#ffffff" style="width: 700px;">
                <tr>
                    <td align="center" valign="top">
                        <!-- / Header -->
                        <table class="container header" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
                            <tr>
                                <td style="padding: 30px 0 30px 0; border-bottom: solid 1px #eeeeee;" align="left">
                                    <a href="#" style="font-size: 30px; text-decoration: none; color: #000000;">PMU</a>
                                </td>
                            </tr>
                        </table>
                        <!-- /// Header -->
                        <!-- / Hero subheader -->
                        <table class="container hero-subheader" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
                            <tr>
                                <td class="hero-subheader__title" style="font-size: 43px; font-weight: bold; padding: 80px 0 15px 0;" align="left">' . $name . ' Nous a contacté</td>
                            </tr>

                            <tr>
                                <td class="hero-subheader__content" style="font-size: 16px; line-height: 27px; color: #969696; padding: 0 60px 90px 0;" align="left">Message : ' . $message . '</td>
                            </tr>
                        </table>
                        <!-- /// Hero subheader -->

                        <!-- / Title -->
                        <table class="container title-block" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" valign="top">
                                    <table class="container" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
                                        <tr>
                                            <td style="border-bottom: solid 1px #eeeeee; padding: 35px 0 18px 0; font-size: 26px;" align="left">Cordialement l\'équipe PMU</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>';

// Plusieurs destinataires
$to  = 'filleux.dim60@hotmail.com, valentin.guerin@etu.uphf.fr, faezeh.ghasemi@etu.uphf.fr'; // notez la virgule

// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset="utf-8"; DelSp="Yes"; format=flowed';
$headers[] = 'Content-Transfer-Encoding: 7bit';
$headers[] = 'Reply-To:' . $from;
$headers[] = 'From:' . $name_host . ' <' . $email_host . '>';

// Envoi
mail($to, $subject, $messagehtml, implode("\r\n", $headers));
}
