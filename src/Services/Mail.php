<?php

/**
 * Manage the way to get the informations send via the contact form
 */
class Mail
{
    /**
     * Send an email to the admin with the message send by the user
     * 
     * @param string $subject       [subject of the mail]
     * @param string $message       [message of the mail]
     * @param array $headers        [headers of the mail]
     * @return bool
     */
    public function send(string $subject, string $message, array $headers): bool
    {
        return mail(
            'benjamin.monteirodasilva@gmail.com', 
            $subject,
            $message,
            $headers
        );
    }
}
