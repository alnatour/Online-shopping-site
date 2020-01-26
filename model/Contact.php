<?php


class Contact {

    private $id;
    private $externalId;
    private $email;
    private $firstname;
    private $lastname;
    private $street;
    private $zip;
    private $city;
    private $country;
    private $phone;
    private $fax;
    private $mobile;
    private $internet;
    private $company;



    public function setId($id)
    {
        $this->id = trim(strtolower($id));
    }
    public function setExternalId($externalId)
    {
        $this->external_id = trim(strtolower($externalId));
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
    public function setStreet($street)
    {
        $this->street = trim(strtolower($street));
    }
    public function setZip($zip)
    {
        $this->zip = trim(strtolower($zip));
    }
    public function setCity($city)
    {
        $this->city = trim(strtolower($city));
    }
    public function setCountry($country)
    {
        $this->country = trim(strtolower($country));
    }
    public function setPhone($phone)
    {
        $this->phone = trim(strtolower($phone));
    }
    public function setFax($fax)
    {
        $this->fax = trim(strtolower($fax));
    }
    public function setMobile($mobile)
    {
        $this->mobile = trim(strtolower($mobile));
    }
    public function setInternet($internet)
    {
        $this->internet = trim(strtolower($internet));
    }
    public function setCompany($company)
    {
        $this->company = trim(strtolower($company));
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function getExternalId()
    {
        return $this->external_id;
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
    public function getStreet()
    {
        return $this->street;
    }
    public function getZip()
    {
        return $this->zip;
    }
    public function getCity()
    {
        return $this->city;
    }
    public function getCountry()
    {
        return $this->country;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getFax()
    {
        return $this->fax;
    }
    public function getMobile()
    {
        return $this->mobile;
    }
    public function getInternet()
    {
        return $this->internet;
    }
    public function getCompany()
    {
        return $this->company;
    }

    

    public function getAsArray()
    {
        return array(
            'email'     => $this->email,
            'firstname' => $this->firstname,
            'lastname'  => $this->lastname,
            'street'    => $this->street,
            'zip'       => $this->zip,
            'city'      => $this->city,
            'country'   => $this->country,
            'phone'     => $this->phone,
            'fax'       => $this->fax,
            'mobile'    => $this->mobile,
            'internet'  => $this->internet,
            'company'   => $this->company,
        );
    } 

}