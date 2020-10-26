<?php

namespace Machine\Coffee;

require_once "./Interfaces/CoffeeContainer.interface.php";
require_once "./Interfaces/CoffeeMachine.interface.php";
require_once "./Interfaces/WaterContainer.interface.php";

require_once "./Classes/CoffeeCoffeeContainer.php";
require_once "./Classes/CoffeeWaterContainer.php";

require_once "./Exceptions/ContainerException.php";
require_once "./Exceptions/ContainerFullException.php";
require_once "./Exceptions/CoffeeMachineException.php";
require_once "./Exceptions/NoCoffeeException.php";
require_once "./Exceptions/NoWaterException.php";


use Machine\Coffee\Classes\CoffeeWaterContainer;
use Machine\Coffee\Exceptions\CoffeeMachineException;
use Machine\Coffee\Exceptions\NoCoffeeException;
use Machine\Coffee\Exceptions\NoWaterException;
use Machine\Coffee\Interfaces\EspressoMachineInterface;

/**
 * CoffeeMachine class.
 * Class CoffeeMachine
 * @package Machine\Coffee
 */
class CoffeeMachine extends CoffeeWaterContainer implements EspressoMachineInterface
{
    const WATER_PER_COFFEE = 0.05;
    const SPOONS_PER_COFFEE = 1;

    protected float $litersOfCoffee;

    /**
     * CoffeeMachine constructor.
     *
     * @param int $amountOfCoffee
     * @param int $coffeeContainerSize
     * @param int $amountOfWater
     * @param int $waterContainerSize
     * @throws CoffeeMachineException
     */
    public function __construct(int $amountOfCoffee, int $coffeeContainerSize, int $amountOfWater, int $waterContainerSize)
    {
        // Check to see if your adding more beans than the container size
        if ($amountOfCoffee > $coffeeContainerSize) {
            throw new CoffeeMachineException("You are adding too many beans: MAX $coffeeContainerSize");
        }

        // Check to see if your adding more water than the water container size
        if ($amountOfWater > $waterContainerSize) {
            throw new CoffeeMachineException("You are adding too much water: MAX $waterContainerSize");
        }

        $this->litersOfCoffee = 0.00;                       // Initial state of the water
        $this->amountOfBeans = $amountOfCoffee;              // Total number of spoons of beans added to the container
        $this->containerSize = $coffeeContainerSize;              // Maximum amount of spoons of beans that can be added
        $this->amountOfWater = $amountOfWater;              // Total number of liters of water added to the water container
        $this->waterContainerSize = $waterContainerSize;    // Maximum amount of water that can be added in liters
    }

    /**
     * Runs the process for making Espresso
     *
     * @return float amount of litres of coffee made
     * @throws NoCoffeeException
     * @throws NoWaterException
     */
    public function makeCoffee(): float
    {
        try {
            $this->useWater(static::WATER_PER_COFFEE);
            $this->useCoffee(static::SPOONS_PER_COFFEE);
        } catch (\Exception $e) {
            throw $e;
        }

        $this->litersOfCoffee += static::WATER_PER_COFFEE;
        return $this->litersOfCoffee;
    }

    /**
     * @return float of litres of coffee made
     * @throws NoCoffeeException
     * @throws NoWaterException
     *
     * @see makeCoffee
     */
    public function makeDoubleCoffee(): float
    {
        $waterRequired = static::WATER_PER_COFFEE * 2;
        $coffeeRequired = static::SPOONS_PER_COFFEE * 2;

        try {
            $this->useWater($waterRequired);
            $this->useCoffee($coffeeRequired);
        } catch (\Exception $e) {
            throw $e;
        }

        $this->litersOfCoffee += $waterRequired;
        return $this->litersOfCoffee;
    }

    /**
     * This method controls what is displayed on the screen of the machine
     * Returns ONE of the following human readable statuses in the following preference order:
     *
     * Add beans and water
     * Add beans
     * Add water
     * {Integer} Espressos left
     *
     * @return string
     */
    public function getStatus(): string
    {
        $coffee = $this->getCoffee() - static::SPOONS_PER_COFFEE;
        $water = $this->getWater() - static::WATER_PER_COFFEE;

        if ($coffee < static::SPOONS_PER_COFFEE && $water < static::WATER_PER_COFFEE) {
            return "Add coffee and water";
        }

        if ($coffee < static::SPOONS_PER_COFFEE) {
            return "Add coffee";
        }

        if ($water < static::WATER_PER_COFFEE) {
            return "Add water";
        }

        $espressosFromBeans = round($coffee / static::SPOONS_PER_COFFEE);
        $espressosFromWater = round($water / static::WATER_PER_COFFEE);

        if ($espressosFromBeans > $espressosFromWater) {
            return sprintf("%s Coffees left", $espressosFromWater);
        }

        return sprintf("%s Coffees left", $espressosFromBeans);
    }

}

// Instantiate the espresso machine
try {
    $coffee = new CoffeeMachine(25, 25, 1, 10);
    for($i = 0; $i < 50; $i++){
        $coffee->makeDoubleCoffee();
        // $coffee->makeCoffee();
        if ($i % 5 == 0) {
            echo $coffee->getStatus() . "\n\r";
        }
    }
    //$espresso->makeDoubleCoffee();
} catch (\Exception $e) {
    echo $e->getMessage();
}