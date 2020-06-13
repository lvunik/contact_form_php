<?php
    //function to validate input length
    function validateInput($var,&$varMsg,$varName,$minimun,$maximun){
        $varMsg['isValid'] = false;
        $message = "";
        if(empty($var)){
            $message = ucfirst($varName)." Can't Be Blank";
        }else{
            if(strlen($var)<$minimun){
                $message = ucfirst($varName)." has to be more than $minimun characters";
            }else if(strlen($var)>=$maximun){
                $message = ucfirst($varName)." has to be shorter than $maximun characters";
            }else{
                $varMsg['isValid'] = true;
            }
        }
        $varMsg[lcfirst($varName)] = $message;
    }
    //function to validate email
    function validateInputEmail($var,&$varMsg){
        $message = "";
        $varMsg['isValid'] = false;
        if(empty($var)){
            $message = "Email Can't Be Blank";
        }else{
            if(!(strpos($var,'@')&&strpos($var,'.'))){
                $message = "Please Enter a valid Email address";
            }else{
                $varMsg['isValid'] = true;
            }
        }
        $varMsg['email'] = $message;
    }
    //function to check if messageInputValidate not empty echo out;
    function validateMsg(&$message,$class = false){
        if(isset($message)){
            if(!empty($message)){
                if($class==true){
                    return "is-invalid";
                }
                return "<div class='invalid-feedback'>$message</div>";
            }
        }
    }