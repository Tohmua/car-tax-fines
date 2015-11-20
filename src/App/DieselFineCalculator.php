<?php

namespace App;

class DieselFineCalculator extends CarFineCalculator implements FineCalculator
{
    protected function maximumFine()
    {
        return 2500;
    }

    protected function penaltyIncrease()
    {
        return 1.15;
    }
}
