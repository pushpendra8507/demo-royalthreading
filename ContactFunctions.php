<?php
// session_start();
// error_reporting(0);

function filterName($field){
    // Sanitize user name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate user name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return $field;
    } else{
        return FALSE;
    }
}   

function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    } else{
        return FALSE;
    }
}

function validate_phone_number($phone)
{
      if(preg_match('/^\d{10}$/',$phone)) // phone number is valid
    {
      $phone = str_replace("-", "", $phone);
     if ($phone) {
        return $phone;
     } else {
       return FALSE;
     }
    }
     
}

function filterString($field){
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(!empty($field)){
        return $field;
    } else{
        return FALSE;
    }
}

function sanetize($string) {
    $string = str_replace('"', '', $string);
    $string = str_replace("'", '', $string);
    $string = htmlspecialchars($string);
    return $string;
}

function clean_url($string) {
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i',
            '\\1', $string);
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), ' ', $string);
    return (trim($string, '-'));
}

?>