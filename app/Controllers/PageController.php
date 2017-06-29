<?php

namespace Projet\Controllers;

use Projet\Models\Info;
use Projet\Models\SliderImg;
use Projet\Models\GalleryImg;

class PageController extends \System\Controller
{

    //@get index.php/landing

    public function index()
    {
        $infos = (new Info)->findOneBy('id', 1);

        $slides = (new SliderImg)->findAll();

        $imgs = (new GalleryImg)->findAll();

        ob_start();

        include(__DIR__ . '/../../ressources/views/landing.phtml');

        $view = ob_get_contents();

        ob_end_clean();

        return $view;
    }

    public function error(){

      ob_start();

      include(__DIR__ . '/../../ressources/views/error404.phtml');

      $view = ob_get_contents();

      ob_end_clean();

      return $view;
    }

    public function contact()
    {
        if (!empty($_POST)) {
            extract($_POST);


            $body = 'Expéditeur : ' . $name . ' <'. $email .'>, Tel : ' . $tel . "\r\n\r\n";
            $body .= 'Type : ' . ucfirst($formType) . "\r\n\r\n";
            $body .= 'Corps de message : ' . "\r\n\r\n";
            $body .= $message;

            $mail = new \PHPMailer;

            // spécifie qu'on est sur un serveur SMTP (pour les phases de test en local)
            $mail->isSMTP();
            // Active le debug
            $mail->SMTPDebug = 3;
            //Ask for HTML-friendly debug output
            $mail->Debugoutput = 'html';
            // On choisit l'hôte
            $mail->Host = "ssl0.ovh.net";
            // selection du port TCP (587 ou 465 généralement, parfois 25)
            $mail->Port = 587;
            // Demande une autorisation pour accéder au service
            $mail->SMTPAuth = true;
            // identification
            $mail->Username = "xxxxxxx";
            $mail->Password = "xxxxxxx";
            // expéditeur et destinataire
            $mail->setFrom($email, $name);
            // addresse de réponse
            $mail->addReplyTo($email, $name);
            // adresse du destinaire
            $mail->addAddress('contact@paparazza.fr');
            // objet du Mail
            $mail->Subject = '[' .strtoupper($formType). '] : '. $subject ;
            $mail->Body = $body;

            // $mail->SMTPOptions = array(
            //         "ssl" => array(
            //             "verify_peer" => false,
            //             "verify_peer_name" => false,
            //             "allow_self_signed" => true
            //         )
            // );

            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message sent!";

                $noReply = new \PHPMailer;

                $noReply->isSMTP();

                $noReply->Host = "ssl0.ovh.net";
                $noReply->Port = 587;

                $noReply->SMTPAuth = true;
                $noReply->Username = "xxxxxxx";
                $noReply->Password = "xxxxxxx";

                $noReply->setFrom('no-reply@paparazza.fr', 'Paparazza');
                $noReply->addAddress($email);

                $noReply->Subject = 'Votre demande de ' . $formType ;
                $noReply->Body = "Nous avons bien reçu votre demande, nous vous contacterons pour y donner suite.\r\n\r\nL'équipe Paparazza";

                $noReply->send();
            }


        }

        ob_start();

        include(__DIR__ . '/../../ressources/views/pages/contact.phtml');

        $view = ob_get_contents();

        ob_end_clean();

        return $view;
    }

}
