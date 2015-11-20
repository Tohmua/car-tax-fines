<?php

namespace App;

abstract class CarFineCalculator implements FineCalculator
{
    public function calculate($taxExpiresDate)
    {
        $weeksPastDeadline = TimeSinceDeadline::weeks($taxExpiresDate);

        $fine = 500.0;

        $fine = 500 * pow($this->penaltyIncrease(), $weeksPastDeadline - 1);

        if ($fine > $this->maximumFine()) {
            $fine = $this->maximumFine();
        }

        return $fine;
    }

    abstract protected function maximumFine();

    abstract protected function penaltyIncrease();
}
