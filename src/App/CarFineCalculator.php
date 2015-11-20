<?php

namespace App;

abstract class CarFineCalculator implements FineCalculator
{
    public function calculate($taxExpiresDate)
    {
        $weeksPastDeadline = TimeSinceDeadline::weeks($taxExpiresDate);

        $fine = 500 * $this->getPenaltyIncreaseMultiplier($weeksPastDeadline);

        if ($fine > $this->maximumFine()) {
            $fine = $this->maximumFine();
        }

        return $fine;
    }

    protected function getPenaltyIncreaseMultiplier($weeksPastDeadline)
    {
        return pow($this->penaltyIncrease(), $weeksPastDeadline - 1);
    }

    abstract protected function maximumFine();

    abstract protected function penaltyIncrease();
}
