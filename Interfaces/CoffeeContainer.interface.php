<?php
namespace Machine\Coffee\Interfaces;

use Machine\Coffee\Exceptions\ContainerFullException;

interface CoffeeContainer
{
    /**
     * Adds beans to the container
     *
     * @param $numSpoons integer number of spoons of beans
     * @return void
     * @throws ContainerFullException
     */
    public function addCoffee(int $numSpoons): void;

    /**
     * Use $numSpoons from the container
     *
     * @param $numSpoons integer number of spoons of beans
     * @return integer number of bean spoons used
     */
    public function useCoffee(int $numSpoons): int;

    /**
     * Returns the number of spoons of beans left in the container
     *
     * @return integer
     */
    public function getCoffee(): int;
}
