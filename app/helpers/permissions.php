<?php
/**
 * @param premission; for permission
 * The current user's ($_SESSION['jog']) == admin?
 */
    function isAdmin($premission){
        if ($premission != "admin" || $premission == null) {
            return false;
        }else{
            return true;
        }
    }

    function isSeller($premission){
        if ($premission != "eladó" || $premission == null) {
            return false;
        } else {
            return true;
        }
    }

    function bothAdminSeller($premission){
        if ($premission == 'admin' || $premission == 'eladó' && $premission != null) {
            return true;
        }else{
            return false;
        }
    }

