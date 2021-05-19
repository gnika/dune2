<?php

namespace App\Utils;
use Symfony\Component\HttpFoundation\Session\Session;


class Messages
{


    public function setSuccessMessage(string $string)
    {
        $session = new Session();

        // set flash messages
        $session->getFlashBag()->add('success', $string);
        echo "<script type='text/javascript'>messagesDisplay();</script>";
    }

    public function setWarningMessage(string $string)
    {
        $session = new Session();

        // set flash messages
        $session->getFlashBag()->add('warning', $string);
        ?><script type='text/javascript'>messagesDisplay();</script><?php
    }

    public function displayRecompense($msg){
        echo "<script>recompenseDisplay('$msg');</script>";
    }
}
