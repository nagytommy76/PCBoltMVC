<?php 
   // SPLIT-elem a stringet egy adott karakter mentén
   function explode_string($string,$delimiter){
      $finalString = explode($delimiter,$string);
      return $finalString;
   }

   // Ahány termék van a beérkező tömbben annyiszor hajtom végre a képek split-elését
   // HÁTRÁNY: Az adatbázisban a képURL-nek mindig picUrl nek kell elnnie!!!
   function pictureSplitting($array, $delimiter){      
         if(is_array($array)){                  
            if ($array != NULL || count($array) > 1) { 
               /*for ($i=0; $i <= count($array); $i++){
                  $pictureArray = explode_string($array[$i]->picUrl, $delimiter);               $array[$i]->picUrl = $pictureArray; 
                  return $array; 
               }*/
               // foreach ($array as $mb) {
               //    $pictureArray = explode_string($mb->picUrl,$delimiter);
               //    $mb->picUrl = $pictureArray;
               //    return $mb;
               // }                 
            }
         }
         else{
            // EZT KELL MAJD EGY FOREACH-BE TENNI A TÖBBI FELESLEGES?
               $picture = explode_string($array->picUrl, $delimiter);
               return $array->picUrl = $picture;
         }
   }

   function splittingPictures($array, $delimiter){
      if (!is_array($array) || count($array) == 1) {
         $picture = explode_string($array->picUrl, $delimiter);
         return $array->picUrl = $picture;
      }else{
         foreach ($array as $array) {
            $picture = explode_string($array->picUrl, $delimiter);
            return $array->picUrl = $picture;
         }
      }
      
   }
   
