<?php

class ApiArticleDb {
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

    public function ContentInsert($articleinfo) 
    {
        $requestXml = '<?xml version="1.0" encoding="utf-8"?><getnewsletters>
        <datefrom>2018-11-6</datefrom>
      </getnewsletters>';
        return $this->request($requestXml);
    }


    public function getLastErrorMessage()
    {
        return $this->errorMessage;
    }
    
}
