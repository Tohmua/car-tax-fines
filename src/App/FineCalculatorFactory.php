<?php

namespace App;

class FineCalculatorFactory
{
    protected static $calculatorMap = [
        VehicleTypes::PETROL => PetrolFineCalculator::class,
        VehicleTypes::DIESEL => DieselFineCalculator::class,
        VehicleTypes::MOTORBIKE => MotorbikeFineCalculator::class,
    ];

    public static function create($type)
    {
        if (self::hasValidCalculator($type)) {
            $calculatorClass = self::$calculatorMap[$type];
            return new $calculatorClass;
        }

        return new NullFineCalculator;
    }

    protected static function hasValidCalculator($type)
    {
        return array_key_exists($type, self::$calculatorMap);
    }
}
