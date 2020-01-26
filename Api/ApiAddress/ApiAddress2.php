<?php

class ApiAddress2 {
    private $url;
    private $username;
    private $password;
    private $errorMessage = '';

    public function __construct($url, $username, $password) 
    {
        $this->username = $username;
        $this->password = $password;
        $this->url = $url;
    }

    private function request($requestXml)
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
        $response = curl_exec($ch);
        $ErrNum = curl_errno($ch);
        $ErrMsg = curl_error($ch);
        curl_close($ch);
    
        if ($ErrNum != 0) {
            $this->errorMessage = 'Error cURL: ' . $ErrMsg;
            return  false;
        }

        $xml = simplexml_load_string($response, null, LIBXML_NOCDATA);
        if (!$xml) {
            $this->errorMessage  = 'Error: Cannot parse response-XML';
            return false;
        }
    
        if ((string)$xml->code !== '2000') {
            $this->errorMessage  = (string)$xml->description;
            return false;
        }

        return $xml;
    }

    public function getAddressByEmail($ApiUser)
    {
        $requestXml = '<?xml version="1.0"?>
        <addressget key="Email">
        <value>'.$ApiUser->getEmail().'</value>
        </addressget>';
        return $this->request($requestXml);
       
    }

    public function getAddressById($id)
    {
        $requestXml = '<?xml version="1.0"?>
                <addressget key="AddressID">
                <value>'.$id.'</value>
                </addressget>';

        return $this->request($requestXml);
    }
   
    public function getAllAddresses($fields) 
    {
        $requestXml = '<?xml version="1.0" encoding="utf-8"?>
                    <getaddresses>
                        <fields>';
                foreach ($fields as $field) {
        $requestXml .= '<field>'.$field.'</field>';
                        }
        $requestXml .= '</fields>
                        <status>1</status>
                    </getaddresses>';


        return $this->request($requestXml);

    }
    
    public function insertAddress($ApiUser)
    {
        $requestXml = '<?xml version="1.0"?>
        <addressinsert key="Email">';

        foreach ($ApiUser->getAsArray() as $field => $value) {
            $requestXml .= '<'.$field.'>'.$value.'</'.$field.'>';
        }
        $requestXml .= '
                <status>1</status>
            </addressinsert>';

        return $this->request($requestXml);
    }


    public function deleteAddress($id) 
    {
        $requestXml = '<?xml version="1.0"?>
                        <addressdelete key="AddressID">
                        <value>'.$id.'</value>
                        </addressdelete>';

        return $this->request($requestXml);
    }

    public function getLastErrorMessage()
    {
        return $this->errorMessage;
    }
}
