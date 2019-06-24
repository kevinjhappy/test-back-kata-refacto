<?php

final class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;

    public function __construct($id, $firstname, $lastname, $email)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return ucfirst(strtolower($this->firstname));
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return strtoupper($this->lastname);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


}
