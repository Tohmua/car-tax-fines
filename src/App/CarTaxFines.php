<?php

namespace App;

use DateTime;
use Exception;

class CarTaxFines
{
    public function fine($type, $taxExpiresDate)
    {
        $fine = $this->getFineValue($type, $taxExpiresDate);
        return $this->format($fine);
    }

    protected function getFineValue($type, $taxExpiresDate)
    {
        try {
            $this->checkToBeSentencedToJail($taxExpiresDate);
            return FineCalculatorFactory::create($type)->calculate($taxExpiresDate);
        } catch (SentencedToJail $e) {
            throw new Exception('Go to jail, do not go past go, do not collect £200');
        } catch (DeadlineNotPassed $e) {
            return 0;
        }
    }

    protected function format($fine)
    {
        return '£' . number_format($fine, 2, '.', '');
    }

    protected function checkToBeSentencedToJail($taxExpiresDate)
    {
        if (TimeSinceDeadline::months($taxExpiresDate) >= 6) {
            throw new SentencedToJail;
        }
    }
}
