<?php
namespace Machine\Coffee\Interfaces;

use Machine\Coffee\Exceptions\ContainerFullException;

interface WaterContainer
{
    /**
     * Adds water to the coffee machine's water tank
     *
     * @param $litres float number of litres of water
     * @return void
     * @throws ContainerFullException
     */
    public function addWater(float $litres): void;

    /**
     * Use $litres from the container
     *
     * @param $litres float number of litres of water
     * @return float number of litres used
     */
    public function useWater(float $litres): float;

    /**
     * Returns the volume of water left in the container
     *
     * @return float number of litres remaining
     */
    public function getWater(): float;
}