<?php


class PostContact
{
    protected $name;
    protected $firstname;
    protected $email;
    protected $subject;
    protected $message;
    protected $headers;
    protected $catchError;
    protected $errors = [];

    public function __construct()
    {
        $this->subject = htmlspecialchars($_POST['subject']);
        $this->message = htmlspecialchars($_POST['message']);
        $this->name = htmlspecialchars($_POST['name']);
        $this->firstname = htmlspecialchars($_POST['firstname']);
        $this->email = htmlspecialchars($_POST['email']);
        $this->headers = [
            'FROM' => $this->name . ' ' . $this->firstname, 
            'Reply-To' => $this->email
        ];
    }

    public function send()
    {
        mail('benjamin.monteirodasilva@gmail.com', $this->subject, $this->message, $this->headers);
    }
}