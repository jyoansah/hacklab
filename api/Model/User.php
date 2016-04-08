<?php

class User {

    public $id;
    public $username;
    public $password;

    public function newUser($id, $username, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }


    function __toString()
    {
        return "UserId: ".$this->getId()." Username: ".$this->getUsername()." Password: ".$this->getpassword()."<br>";
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


}
