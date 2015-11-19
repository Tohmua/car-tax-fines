<?php

namespace App;


use DateTime;
use Exception;

class CarTaxFines
{

    public function fine($type, $taxExpiresDate, $richBastard = false)
    {
        $interval = date_diff(new DateTime(), new DateTime($taxExpiresDate));
        $months = $interval->m;
        if ($months>=6) {
            if (!$richBastard) {
                throw new Exception('Exception');
            } else {
                return '£' . number_format(($richBastard/2), 2, '.', '');
            }
        }
        if ( ! $interval->invert) {
            return '£0.00';
        }
        $weeks = $interval->days / 7;
        $fine = 500;
        if ($type == 'petrol') {
            for ($i = 1; $i<$weeks; $i++) {
                $fine *= 1.2;
            }
            if ($fine>2000) {
                $fine = 2000;
            }
        }
        if ($type == 'diesel') {
            for ($i = 1; $i<$weeks; $i++) {
                $fine *= 1.15;
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
