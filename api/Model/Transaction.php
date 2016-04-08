<?php

class Transaction {

    public $id;
    public $tdate;
    public $user_id;
    public $amount;


    public function newTransaction($id, $tdate, $user_id, $amount) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->tdate = $tdate;
        $this->amount = $amount;
    }

    public function __construct($tdate, $user_id, $amount) {
        $this->user_id = $user_id;
        $this->tdate = $tdate;
        $this->amount = $amount;
    }


    function __toString(){
        return "TransactionID: ".$this->getId()." UserID: ".$this->user_id()." Date: ".$this->getTDate()." Amount: ".$this->getLocation()."<br>";

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
    public function getTDate()
    {
        return $this->tdate;
    }

    /**
     * @param mixed $tdate
     */
    public function setTDate($tdate)
    {
        $this->tdate = $tdate;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserID($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }


}
