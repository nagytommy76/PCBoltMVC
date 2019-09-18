<?php
    // Simpla page redirect
    function redirect($page){
        header('Location: '.URLROOT.'/'.$page);
    }