<?php


class User {

    private $id;
    private $email;
    private $psw;
    private $firstname;
    private $lastname;
    private $phone;
    private $role;



    public function setId($id)
    {
        $this->id = trim(strtolower($id));
    }
    public function setEmail($email)
    {
        $this->email = trim(strtolower($email));
    }
    public function setPassword($psw)
    {
        $this->psw = trim(strtolower($psw));
    }
    public function setFirstname($firstname)
    {
        $this->firstname = trim(strtolower($firstname));
    }
    public function setLastname($lastname)
    {
        $this->lastname = trim(strtolower($lastname));
    }
    public function setPhone($phone)
    {
        $this->phone = trim(strtolower($phone));
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->psw;
    }
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getRole()
    {
        return $this->role;
    }

}