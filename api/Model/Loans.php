<?php

class Loan{

    public $id;
    public $sdate;
    public $user_id;
    public $amount;
    public $status;

    const REQUESTED = 'REQUESTED';
    const READ = 'READ';
    const APPROVED = 'APPROVED';
    const DISBERSED = 'DISBERSED';
    const DEFAULTED = 'DEFAULTED';


    public function newLoan($id, $sdate, $user_id, $amount) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->sdate = $sdate;
        $this->amount = $amount;
        $this->status = Loan::REQUESTED;
    }

    public function __construct($sdate, $user_id, $amount, $status) {
        $this->user_id = $user_id;
        $this->sdate = $sdate;
        $this->amount = $amount;
        $this->status = $status;
    }


    function __toString(){
        return "loanID: ".$this->getId()." UserID: ".$this->user_id()." Date: ".$this->getsDate()." Amount: ".$this->getLocation()."<br>";
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
    public function getSDate()
    {
        return $this->sdate;
    }

    /**
     * @param mixed $sdate
     */
    public function setSDate($sdate)
    {
        $this->sdate = $sdate;
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

        /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatusRequested()
    {
        $this->status = Loan::REQUESTED;
    }

    /**
     * @param mixed $status
     */
    public function setStatusRead()
    {
        $this->status = Loan::READ;
    }

    /**
     * @param mixed $status
     */
    public function setStatusApproved()
    {
        $this->status = Loan::APPROVED;
    }

    /**
     * @param mixed $status
     */
    public function setStatusDisbersed()
    {
        $this->status = Loan::DISBERSED;
    }

    /**
     * @param mixed $status
     */
    public function setStatusDefaulted()
    {
        $this->status = Loan::DEFAULTED;
    }



}
