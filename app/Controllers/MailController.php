<?php

namespace Projet\Controllers;

use Projet\Models\Info;

class MailController extends \System\Controller
{
    const HOST_NAME = '';
    const TCP_PORT = 587;
    const USERNAME = '';
    const PASSWORD = '';


    public function contact()
    {
        $infos = (new Info)->findOneBy('id', 1);


        if (!empty($_POST)) {
            extract($_POST);

            //ERRORS
            $errors = [];
            if (empty($name) || empty($tel) || empty($email) || empty($subject) || empty($message)) {
                $errors[] = 'Afin de pouvoir répondre au mieux à vos attentes, merci de remplir tous les champs';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Merci de renseigner une adresse mail valide';
            }
            if (preg_match('/(https?:\/\/)|(www\.[\d\w]+\.)/', $message)) {
                $errors[] = 'Merci de ne pas mettre de liens dans votre message.';
            }

            // ENVOI MAIL
            if (empty($errors)) {

                $body = 'Expéditeur : ' . $name . ' <'. $email .'>, Tel : ' . $tel . "\r\n\r\n";
                $body .= 'Type : ' . ucfirst($formType) . "\r\n\r\n";
                $body .= 'Corps de message : ' . "\r\n\r\n";
                $body .= $message;

                $mail = new \PHPMailer;
                $mail->CharSet = 'UTF-8';

                // spécifie qu'on est sur un serveur SMTP (pour les phases de test en local)
                $mail->isSMTP();
                // Active le debug
                // $mail->SMTPDebug = 3;
                //Ask for HTML-friendly debug output
                // $mail->Debugoutput = 'html';
                // On choisit l'hôte
                $mail->Host = static::HOST_NAME;
                // selection du port TCP (587 ou 465 généralement, parfois 25)
                $mail->Port = static::TCP_PORT;
                // Demande une autorisation pour accéder au service
                $mail->SMTPAuth = true;
                // identification
                $mail->Username = static::USERNAME;
                $mail->Password = static::PASSWORD;
                // expéditeur et destinataire
                $mail->setFrom($email, $name);
                // addresse de réponse
                $mail->addReplyTo($email, $name);
                // adresse du destinaire
                $mail->addAddress(static::USERNAME);
                // objet du Mail
                $mail->Subject = '[' .strtoupper($formType). '] : '. $subject ;
                $mail->Body = $body;


                if (!$mail->send()) {

                    $errors = 'Erreur lors de l\'envoi du mail : ' . $mail->ErrorInfo;

                } else {
                    // Envoi d'une réponse-type
                    $noReply = new \PHPMailer;

                    $noReply->isSMTP();

                    $noReply->Host = static::HOST_NAME;
                    $noReply->Port = static::TCP_PORT;

                    $noReply->SMTPAuth = true;
                    $noReply->Username = static::USERNAME;
                    $noReply->Password = static::PASSWORD;

                    $noReply->setFrom('no-reply@paparazza.fr', 'Paparazza');
                    $noReply->addAddress($email, $name);

                    $noReply->Subject = 'Votre demande de ' . $formType ;
                    $noReply->Body = "Nous avons bien reçu votre demande, nous vous contacterons pour y donner suite.\r\n\r\nL'équipe Paparazza";

                    $noReply->send();

                    // Redirection
                    $this->redirect('home');
                }
            }


        }


        ob_start();
        include(__DIR__ . '/../../ressources/views/contact-one-page.phtml');
        $view = ob_get_contents();
        ob_end_clean();

        return $view;


    }

}
