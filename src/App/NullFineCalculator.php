<?php

namespace App;

class NullFineCalculator implements FineCalculator
{
    public function calculate($taxExpiresDate)
    {
        return 0;
    }
}
