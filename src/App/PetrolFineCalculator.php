<?php

namespace App;

class PetrolFineCalculator extends CarFineCalculator implements FineCalculator
{
    protected function maximumFine()
    {
        return 2000;
    }

    protected function penaltyIncrease()
    {
        return 1.2;
    }
}
