<?php

/**
 * Manage the way to get the informations send via the contact form
 */
class Mail
{

    /**
     * Send an email to the admin with the message send by the user
     * 
     * @param array $datas      [datas to implement in the email]
     * @return void
     */
    public function send(array $data = []): void
    {
        mail(
            'benjamin.monteirodasilva@gmail.com', 
            $data['subject'], 
            $data['message'], 
            $data['headers'] = []
        );
    }
}