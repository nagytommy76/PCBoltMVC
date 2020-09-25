<?php

/** @param expireInDays: example 4 days */
function setCookies($cName, $cValue, $expireInDays){
    $expireInDays = (time() + $expireInDays*(86400));
    setcookie($cName,$cValue,$expireInDays);
}

function removeCookies($cName){
    setcookie($cName, "", time()-3600);
}


