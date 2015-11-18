<?php

namespace App;

use DateTime;
use Exception;

class CarTaxFines
{
    public function fine($type, $taxExpiresDate)
    {
        $fine = 0.0;

        $expiryTime = new DateTime($taxExpiresDate);
        $currentTime = new DateTime();

        $interval = $expiryTime->diff($currentTime)->format('%R%a');

        if (preg_match('/\+(\d+)/', $interval, $matches)) {
            $weeksPastDeadline = (int) floor($matches[1] / 7);

            if ($type === 'petrol') {
                if ($weeksPastDeadline === 1) {
                    $fine = 500.0;
                } else if ($weeksPastDeadline > 1) {
                    $fine = 500.0;

                    for ($i = 1; $i < $weeksPastDeadline; $i++) {
                        $fine *= 1.2;
                    }
                }

                if ($fine > 2000) {
                    $fine = 2000.0;
                }
            } elseif ($type === 'diesel') {
                if ($weeksPastDeadline === 1) {
                    $fine = 500.0;
                } else if ($weeksPastDeadline > 1) {
                    $fine = 500.0;

                    for ($i = 1; $i < $weeksPastDeadline; $i++) {
                        $fine *= 1.15;
                    }
                }

                if ($fine > 2500) {
                    $fine = 2500.0;
                }
            } elseif ($type === 'motorbike') {
                $priceLookup = [
                    1 => 200,
                    2 => 400,
                    3 => 600,
                    4 => 800,
                    5 => 1000,
                    6 => 1200,
                ];

                $expiryTime = new DateTime($taxExpiresDate);
                $currentTime = new DateTime();
                $interval = $expiryTime->diff($currentTime)->format('%R%m');

                $month = 1;

                if (preg_match('/\+(\d+)/', $interval, $monthsPastDeadline)) {
                    $month += $monthsPastDeadline[1];
                }

                $fine = $priceLookup[$month];
            }
        }

        $expiryTime = new DateTime($taxExpiresDate);
        $currentTime = new DateTime();
        $interval = $expiryTime->diff($currentTime)->format('%R%m');

        if (preg_match('/\+(\d+)/', $interval, $monthsPastDeadline)) {
            if (($monthsPastDeadline[1] + 1) > 6) {
                throw new Exception('Go to jail, do not go past go, do not collect £200');
            }
        }

        return '£' . number_format($fine, 2, '.', '');
    }
}
