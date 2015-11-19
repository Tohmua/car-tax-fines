<?php

namespace App;


use DateTime;
use Exception;

class CarTaxFines
{

    public function fine($type, $taxExpiresDate)
    {
        $interval = date_diff(new DateTime(), new DateTime($taxExpiresDate));
        $months = $interval->m;
        if ($months>=6) {
            throw new Exception('Exception');
        }
        if ( ! $interval->invert) {
            return '£0.00';
        }
        $weeks = $interval->days / 7;
        $fine = 500;
        if ($type == 'petrol') {
            while ($weeks>1 && $fine<2000) {
                $fine *= 1.2;
                $weeks -= 1;
            }
            if ($fine>2000) {
                $fine = 2000;
            }
        }
        if ($type == 'diesel') {
            while ($weeks>1 && $fine<2500) {
                $fine *= 1.15;
                $weeks -= 1;
            }
            if ($fine>2500) {
                $fine = 2500;
            }
        }
        if ($type == 'motorbike') {
            $fine = ++$interval->m * 200;
        }

        return '£' . number_format(round($fine, 2), 2, '.', '');
    }
}
