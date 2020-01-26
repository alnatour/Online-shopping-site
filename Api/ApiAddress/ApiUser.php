<?php


class ApiUser {

    private $id;
    private $email;
    private $firstname;
    private $lastname;
    private $phone;
    
    public function setId($id)
    {
        $this->id = trim(strtolower($id));
    }
    public function setEmail($email)
    {
        $this->email = trim(strtolower($email));
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


    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
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

    
    public function getAsArray()
    {
        return array(
            'email'     => $this->email,
            'firstname' => $this->firstname,
            'lastname'  => $this->lastname,
            'phone'     => $this->phone,
        );
    } 
}