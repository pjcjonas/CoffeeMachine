<?php
namespace Machine\Coffee\Classes;

use Machine\Coffee\Exceptions\ContainerFullException;
use Machine\Coffee\Exceptions\NoWaterException;
use Machine\Coffee\Interfaces\WaterContainer;

class CoffeeWaterContainer extends CoffeeCoffeeContainer implements WaterContainer {
    protected float $amountOfWater;
    protected float $waterContainerSize;

    /**
     * Adds water to the coffee machine's water tank
     *
     * @param $litres float number of litres of water
     * @return void
     * @throws ContainerFullException
     */
    public function addWater(float $litres): void
    {
        $newWaterLevel = $this->amountOfWater + $litres;
        if ($newWaterLevel > $this->waterContainerSize) {
            throw new ContainerFullException(sprintf("You are adding too much water: Max level - %f", $this->amountOfWater));
        }

        $this->amountOfWater = $newWaterLevel;
    }

    /**
     * Use $litres from the container
     *
     * @param float $litres number of litres of water
     * @return float number of litres used
     * @throws NoWaterException
     */
    public function useWater(float $litres): float
    {
        $newWaterLevel = $this->amountOfWater - $litres;
        if ($this->amountOfWater < static::WATER_PER_COFFEE) {
            throw new NoWaterException(sprintf("Not enough water left: Remaining - %f", $newWaterLevel));
        }

        $this->amountOfWater = $newWaterLevel;

        return $this->waterContainerSize - $this->amountOfWater;
    }

    /**
     * Returns the volume of water left in the container
     *
     * @return float number of litres remaining
     */
    public function getWater(): float
    {
        return $this->amountOfWater;
    }
}