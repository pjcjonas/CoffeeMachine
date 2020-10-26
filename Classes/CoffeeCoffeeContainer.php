<?php
namespace Machine\Coffee\Classes;

use Machine\Coffee\Exceptions\ContainerFullException;
use Machine\Coffee\Exceptions\NoCoffeeException;
use Machine\Coffee\Interfaces\CoffeeContainer;

class CoffeeCoffeeContainer implements CoffeeContainer {

    protected int $amountOfBeans;
    protected int $containerSize;

    /**
     * Adds beans to the container
     *
     * @param $numSpoons integer number of spoons of beans
     * @return void
     * @throws ContainerFullException
     */
    public function addCoffee(int $numSpoons): void
    {
        $newAmountOfBeans = $this->getCoffee() + $numSpoons;

        if ($newAmountOfBeans > $this->containerSize) {
            throw new ContainerFullException(
                sprintf(
                    "Your container is already full: Max Allowed - %d / Current amount - %d",
                    [$this->containerSize, $this->amountOfBeans]
                )
            );
        }

        $this->amountOfBeans = $newAmountOfBeans;
    }

    /**
     * Use $numSpoons from the container
     *
     * @param $numSpoons integer number of spoons of beans
     * @return integer number of bean spoons used
     * @throws NoCoffeeException
     */
    public function useCoffee(int $numSpoons): int
    {
        $newAmountOfBeans = $this->getCoffee() - $numSpoons;

        if ($newAmountOfBeans < static::SPOONS_PER_COFFEE) {
            throw new NoCoffeeException(sprintf("Not enough beans available: Current amount - %d", [$this->amountOfBeans]));
        }

        $this->amountOfBeans = $newAmountOfBeans;

        return $this->containerSize - $this->amountOfBeans;
    }

    /**
     * Returns the number of spoons of beans left in the container
     *
     * @return integer
     */
    public function getCoffee(): int
    {
        return $this->amountOfBeans;
    }
}