<?php

class ContactService {

    private $api;
    private $lastError;
    private $db;

    public function __construct($api)
    {
        $this->api = $api;
        $this->db = ContactDb::getInstance();
    }

    private function setError($message)
    {
        $this->lastError = $message;
    }

    public function getLastError()
    {
        return $this->lastError;
    }

    public function save($contact)
    {
        if ($contact->getId()) {
           
            // UPDATE    
            $id = $contact->getID();
            $edit = $this->db->editAddress($contact);
        }
        else {
            // INSERT
            try {
                $id = $this->db->InsertNewAddress($contact);
            } catch(PDOException $e) {
                $this->setError( $e->getMessage() );
                return false;
            }
        }

        //
        // insert into eyepin
        $xml = $this->api->insertAddress($contact);
      
        if (!$xml) {
            $this->setError('Fehler beim Senden des Kontaks an eyepin.');
            return false;
        }
        $external_id = (int)$xml->data;
        // save external_id to database
        
        if (!$this->db->UpdateExternalID($id, $external_id)) {
            $this->setError('Fehler beim speichern von external_id.');
            return false;            
        }

        return true;
    }

    function delete($contact)
    {
        // Kontakt in eyepin löschen
        $xml = $this->api->deleteAddress($contact->getExternalID());

        if (!$xml) {
            $this->setError('Fehler beim Löschen von Kontakt in eyepin.');
            return false;
        }

        // Kontakt in DB löschen
       $delete_succ = $this->db->deleteAddress($contact);

    }
} 
