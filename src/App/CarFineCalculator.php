<?php

namespace App;

abstract class CarFineCalculator implements FineCalculator
{
    public function calculate($taxExpiresDate)
    {
        $weeksPastDeadline = TimeSinceDeadline::weeks($taxExpiresDate);

        $fine = 500.0;

        for ($i = 1; $i < $weeksPastDeadline; $i++) {
            $fine *= $this->penaltyIncrease();
        }

        if ($fine > $this->maximumFine()) {
            $fine = $this->maximumFine();
        }

        return $fine;
    }

    abstract protected function maximumFine();

    abstract protected function penaltyIncrease();
}
