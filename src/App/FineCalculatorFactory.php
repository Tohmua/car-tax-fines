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
        // In php7 this entire class becomes:
        // $className = self::calculatorMap[$type] ?? NullFineCalculator::class;
        // return new $className;

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
