<?php

/**
 * Manage the way to get the informations send via the contact form
 */
class Mail
{
    /**
     * Send an email to the admin with the message send by the user
     * 
     * @param  $subject       [subject of the mail]
     * @param  $message       [message of the mail]
     * @param  $headers        [headers of the mail]
     * @return bool
     */
    public function send($subject, $message, $headers): bool
    {
        return mail(
            'benjamin.monteirodasilva@gmail.com', 
            $subject,
            $message,
            $headers
        );
    }
}
