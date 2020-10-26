# Interfaces - Coffee Style
This is a template that illustrates the use of Interfaces. PHP Interfaces are basically templates of methods that are required for a class.

## Example
```php
interface InterfaceA{

    /**
    * Returns the property value
    */
    public function getValue(float $value): float;
}


class MainObject implements InterfaceA{

    /**
    * Interface method: Returns the property value
    */
    public function getValue(float $value): float{
        return $value;
    }
}
```

When a class implments and interface or multiple interfaces then all the methods of those interfaces need to be delcared and return the correct values based on their return type, or dont return anything if the type is void.

## How to test
```bash
php CoffeeMachine.php
```
Once this has been executed the PHP script will trigger the following code:
```php
// SINGLE COFFEE
// We are using error handeling so wrapping your code in a 
// try catch is always required.

try {
    // Instantiate the coffee machine object
    // CoffeeMachine(TotalCoffee, CoffeeLimit, TotalWater, WaterLimit)

    $singlerCoffee = new CoffeeMachine(25, 25, 1, 10);
    for($i = 0; $i < 50; $i++){
        $singlerCoffee->makeCoffee();
        if ($i % 5 == 0) {
            echo $singlerCoffee->getStatus() . "\n\r";
        }
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

```php
// DOUBLE COFFEE
// We are using error handeling so wrapping your code in a 
// try catch is always required.

try {
    // Instantiate the coffee machine object
    // CoffeeMachine(TotalCoffee, CoffeeLimit, TotalWater, WaterLimit)
    
    $singlerCoffee = new CoffeeMachine(25, 25, 1, 10);
    for($i = 0; $i < 50; $i++){
        $singlerCoffee->makeDoubleCoffee();
        if ($i % 5 == 0) {
            echo $singlerCoffee->getStatus() . "\n\r";
        }
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
