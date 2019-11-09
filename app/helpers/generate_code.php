<?php
    function generateCode($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i=0; $i < $length; $i++) { 
            $index = rand(0, strlen($characters) - 1);
            $code .= $characters[$index];
        }
        return $code;
    }

