<?php
namespace Machine\Coffee\Interfaces;

use Machine\Coffee\Exceptions\NoCoffeeException;

interface EspressoMachineInterface
{

    /**
     * Runs the process for making Espresso
     *
     * @return float amount of litres of coffee made
     * @throws NoCoffeeException, NoWaterException
     */
    public function makeCoffee(): float;

    /**
     * @return float of litres of coffee made
     * @throws NoCoffeeException, NoWaterException
     *
     * @see makeCoffee
     */
    public function makeDoubleCoffee(): float;

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
    public function getStatus(): string;

}