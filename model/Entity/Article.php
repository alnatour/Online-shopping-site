<?php


class ArticleInfo {

    private $id;
    private $contact_id;
    private $firstname;
    private $lastname;
    private $email;
    private $title;
    private $image;
    private $article;
    private $price;
    private $discount;
    private $datum;
    private $update_datum;
    private $subcategory_id;
    private $category_id;
    private $specification_id;
   
    public function setId($id)
    {
        $this->id = trim(strtolower($id));
    }
    public function setContactId($contact_id)
    {
        $this->contact_id = trim(strtolower($contact_id));
    }
    public function setFirstname($firstname)
    {
        $this->firstname = trim(strtolower($firstname));
    }
    public function setLastname($lastname)
    {
        $this->lastname = trim(strtolower($lastname));
    }
    public function setEmail($email)
    {
        $this->email = trim(strtolower($email));
    }
    public function setTitle($title)
    {
        $this->title = trim($title);
    }
    public function setImagee($filename)
    {
        $this->imagee = trim($filename);
    }
    public function setArticle($article)
    {
        $this->article = trim($article);
    }
    public function setPrice($price)
    {
        $this->price = trim($price);
    }

    public function setDatum($datum)
    {
        $this->datum = $datum;
    }
    public function setUpdatedatum($update_datum)
    {
        $this->update_datum = $update_datum;
    }
    public function setSubcategoryId($subcategory_id)
    {
        $this->subcategory_id = trim(strtolower($subcategory_id));
    }


    public function getId()
    {
        return $this->id;
    }
    public function getContactId()
    {
        return $this->contact_id;
    }
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getImagee()
    {
        return $this->imagee;
    }
    public function getArticle()
    {
        return $this->article;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getDatum()
    {
        return $this->datum;
    }
    public function getUpdatedatum()
    {
        return $this->update_datum;
    }
    public function getSubcategoryId()
    {
        return $this->subcategory_id;
    }

    


    /**
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of discount
     */ 
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set the value of discount
     *
     * @return  self
     */ 
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get the value of specification_id
     */ 
    public function getSpecification_id()
    {
        return $this->specification_id;
    }

    /**
     * Set the value of specification_id
     *
     * @return  self
     */ 
    public function setSpecification_id($specification_id)
    {
        $this->specification_id = $specification_id;

        return $this;
    }
}