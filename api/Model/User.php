<?php

class User {

    public $id;
    public $username;
    public $password;
    public $balance;

    public function newUser($id, $username, $email, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->balance = 0;
    }

    public function __construct($username, $email, $password){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->balance = 0;
    }


    function __toString()
    {
        return  "UserId: ".$this->getId().
                " Username: ".$this->getUsername().
                " Email: ".$this->getEmail().
                " Password: ".$this->getpassword().
                " Balance: ".$this->getBalance().
                "<br>";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

        /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getpassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setpassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $password
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }


}
