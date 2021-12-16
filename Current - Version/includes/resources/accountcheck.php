<?php
include '../classes/db_pdo.php';
include 'cryptage_data.php';

if (isset($_POST['signups'])) {
    if ($_POST['password-1'] != $_POST['password-2']) {
        header("location:../../accountcreation.php?Password= Mot de passe incorrect");
    } else {
        try {
            // Création du nouveau client, ajout dans la base de données
            $db_pdo = new db_pdo();

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $cp = $_POST['codepostal'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password-1'];

            $userArray = array($fname, $lname, $address, $phone); // Tableau des données a encoder

            // Crytage des données
            $encodeData = EncodeMultiDatas($userArray);
            $keyUser = KeyUniqueUser($email . $password);
            $email = CryptageEmail($email);
            $pass = CryptagePassword($password);

            $db_pdo->queryInsertion("INSERT INTO clients (last_name, first_name, email, phone, city, postal_code, address, idpermission, check_account, use_key) VALUES ('$encodeData[0]', '$encodeData[1]', '$email', '$encodeData[3]', '$city', '$cp', '$encodeData[2]', 0, FALSE, '$keyUser');");
            $selectId = $db_pdo->queryExtraction("SELECT idclients FROM clients ORDER BY idclients DESC LIMIT 1;");
            $selectId = $selectId->fetchAll();
            foreach ($selectId as $id) {
                $db_pdo->queryInsertion("INSERT INTO identifiers (idpassword_client, password) VALUES (" . $id[0][0] . " , '$pass');");
            }

            //Email de confirmation
            SendEmailClient($_POST['email'], $keyUser, $fname, $lname, $address);
        } catch (Exception $ex) {
            print " Erreur : " . $ex->getMessage();
        }
    }
} else {
    header("location:../../error/404.html");
}

function SendEmailClient($email, $keyUser, $fname, $lname, $address)
{
    // Host 
    $email_host = 'contact@pmu-ecommerce.000webhostapp.com';
    $name_host = 'Contact pmu-ecommerce.000webhostapp.com';

    $subject = 'Confirmer votre compte P.M.U';
    //$message = '<a href=\'https://pmu-ecommerce.000webhostapp.com/activeraccount.php?key=' . $keyUser . '\'>Cliquez ici.</a>';

    $message = '<html>
                <head>
                    <title>P.M.U email de vérification</title>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    <table class="full-width-container" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#eeeeee" style="width: 100%; height: 100%; padding: 30px 0 30px 0;">
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
                                                        <a href="#" style="font-size: 30px; text-decoration: none; color: #000000;">P.M.U</a>
                                                    </td>
                                                </tr>
                                            </table>
                                             <!-- /// Header -->
                                            <!-- / Hero subheader -->
                                            <table class="container hero-subheader" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
                                                <tr>
                                                    <td class="hero-subheader__title" style="font-size: 43px; font-weight: bold; padding: 80px 0 15px 0;" align="left">Confirmation de vos informations personnelles :</td>
                                                </tr>
                                                <tr>
                                                    <td class="hero-subheader__content" style="font-size: 16px; line-height: 27px; color: #969696; padding: 0 60px 90px 0;" align="left">Votre nom : ' . $fname . '<br>Votre prénom : ' . $lname . '<br>Votre email : ' . $email . '<br>Votre adresse : ' . $address . '<br> Pour activer votre compte : </td>
                                                        <a href=\'https://pmu-ecommerce.000webhostapp.com/activeraccount.php?key= '.$keyUser.'\'>Cliquez ici.</a>
                                                </tr>
                                                <tr>
                                                    <td class="hero-subheader__content" style="font-size: 16px; line-height: 27px; color: #969696; padding: 0 60px 90px 0;" align="left"><a href=\'https://pmu-ecommerce.000webhostapp.com/activeraccount.php?key= '.$keyUser.'\'>Cliquez ici.</a></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>';


    if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

    if (($email != '') && ($subject != '') && ($message != '')) // Vérifie si les variable sont pas null ou vide
    {
        $headers  = 'MIME-Version: 1.0' . PHP_EOL;
        $headers .= 'From:' . $name_host . ' <' . $email_host . '>' . PHP_EOL;
        $headers .= 'Reply-To:' . $email . PHP_EOL;
        $headers .= 'Content-Type: text/html; charset="utf-8"; DelSp="Yes"; format=flowed ' . PHP_EOL;
        $headers .= 'Content-Disposition: inline' . PHP_EOL;
        $headers .= 'Content-Transfer-Encoding: 7bit' . PHP_EOL;
        $headers .= 'X-Mailer:PHP/' . phpversion();

       // $e_body = "Vous avez été contacté par " . $fname . PHP_EOL . PHP_EOL;
       // $e_content = $message . PHP_EOL . PHP_EOL;
       // $e_reply = "Vous pouvez contacter $lname par email : $email ";

       // $msg = wordwrap($e_body . $e_content . $e_reply, 70);

        // Remplacement de certains caractères spéciaux
        $caracteres_speciaux     = array('&#039;', '&#8217;', '&quot;', '<br>', '<br />', '&lt;', '&gt;', '&amp;', '…',   '&rsquo;', '&lsquo;');
        $caracteres_remplacement = array("'",      "'",        '"',      '',    '',       '<',    '>',    '&',     '...', '>>',      '<<');

        $objet = html_entity_decode($subject);
        $objet = str_replace($caracteres_speciaux, $caracteres_remplacement, $objet);

       // $msg = html_entity_decode($msg);
       // $msg = str_replace($caracteres_speciaux, $caracteres_remplacement, $msg);
    
        if (mail($email, $objet, $message, $headers) == 1) {
            header("location:../../../accountvalider.html");
        } else {
            header("location:../../accountcreation.php?Empty= Erreur lors de l'envoi du mail");
        }
    }
}
