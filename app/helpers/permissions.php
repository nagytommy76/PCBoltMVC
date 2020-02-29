<?php
/**
 * @param premission; for permission
 * The current user's ($_SESSION['jog']) == admin?
 */
    function isAdmin($premission){
        if (isset($premission)) {
            if ($premission != "admin" || $premission == null) {
                return false;
            }else{
                return true;
            }
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
        $result = false;
        if (isset($premission)){
            if ($premission == 'admin' || $premission == 'eladó' && $premission != null) {
                $result = true;
            }
        }
        return $result;
    }

    /**
     * @param premission: eladó/admin
     */
    function bothAdminAndSeller($premission = 'admin'){
        $result = false;
        if (isset($_SESSION['jog'])) {
            if ($premission == 'admin' || $premission == 'eladó' && $premission != null) {
                $result = true;
            }
        }
        return $result;
    }

