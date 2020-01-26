<?php


class ApiArticleInfo {

    private $id;
    private $customerid;
    private $title;
    private $detail;

    public function setId($id)
    {
        $this->id = trim(strtolower($id));
    }
    public function setCustomerId($customerid)
    {
        $this->customerid = trim(strtolower($customerid));
    }
    public function setTitle($title)
    {
        $this->title = trim(strtolower($title));
    }
    public function setDetail($detail)
    {
        $this->detail = trim(strtolower($detail));
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function getCustomerId()
    {
        return $this->customerid;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDetail()
    {
        return $this->detail;
    }
    

    public function getAsArray()
    {
        return array(
            'customerid'    => $this->customerid,
            'title'         => $this->title,
            'detail'        => $this->detail,
        );
    } 

}