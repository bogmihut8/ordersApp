<?php

namespace App\Http\Helpers;

class Helper
{

    private function formatDate($date){
        $dateArr = explode("-", $date);
        return $dateArr[2] . "-" . $dateArr[1] . "-" . $dateArr[0];
    }
}
