<?php

class FormValidation {

    private $errors = [];

    public function required(string $key, $message = "Ce champ est obligatoire")
    {
        $this->errors[$key] = null;
        if(!isset($_POST[$key]) || trim($_POST[$key]) === "" || trim($_POST[$key]) === "false")
        {
            $this->errors[$key] = $message;
        }
        return $this;
    }
    public function isValid()
    {
        foreach($this->errors as $error)
        {
            if($error)
            {
                return false;
            }
        }
        return true;
    }
    public function getErrors()
    {
        return $this->errors;
    }
}