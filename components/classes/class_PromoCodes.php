<?php
/**
 * 
 */
class PromoCodes{
    
    public function generate($count){
        $SQL    = new SQL();
        $Engine = new Engine();

        for ($i=0; $i < $count; $i++) { 
            $promo_code = $Engine->generateRandomString(10);
            if ($i == $count-1) {
                $values .= " ('$promo_code') ";
            }else{
                $values .= " ('$promo_code'), ";
            }
        }
        echo "INSERT INTO `promo_codes` (code) VALUES ".$values;
        $SQL->query("INSERT INTO `promo_codes` (code) VALUES ".$values);

        return 0;
    }

    public function getAll(){
        $SQL = new SQL();

        $result = $SQL->query("SELECT * FROM `promo_codes`");
        
        return $result;
    }

    public function usePromoCode($code){
        $SQL = new SQL();
 
    }
}
?>