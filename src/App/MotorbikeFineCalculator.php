<?php

namespace App;

class MotorbikeFineCalculator implements FineCalculator
{
    public function calculate($taxExpiresDate)
    {
        return 200 + (TimeSinceDeadline::months($taxExpiresDate) * 200);
    }

}
