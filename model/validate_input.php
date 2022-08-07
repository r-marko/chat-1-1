<?php
namespace Validation;

class FormValidation {

    static public function cleanInputUsername($input){
        $value = trim($input);
        $bad_characters = array("{", "}", "(", ")", "$", "<", ">", "?", ";", ":", "/");
        $value = str_ireplace($bad_characters, "", $value);
        $value = htmlentities($value);
        $value = strip_tags($value);
        $value = stripslashes($value);
        if(is_string($value) && ctype_alpha($value) && strlen($value) >=5 && strlen($value)<21){
            return $value;
        } else {
            return false;
        }
    }
    static public function cleanInputPassword($input){
        $value = trim($input);
        $bad_characters = array("{", "}", "(", ")", "$", "<", ">", "?", ";", ":", "/");
        $value = str_ireplace($bad_characters, "", $value);
        $value = htmlentities($value);
        $value = strip_tags($value);
        $value = stripslashes($value);
        if(strlen($value) >=5 && strlen($value)<21 && preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/", $value)){
            return $value;
        } else {
            return false;
        }
    }
}





?>