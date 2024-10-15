<?php
interface Pizza
{
    public function cost();
    public function getDescription();
    public function getCalories();
}
class basePizza implements Pizza
{

    public function cost()
    {
        return 10;
    }

    public function getDescription()
    {

        return "Base pizza, ingredients ";
    }
    public function getCalories()
    {
        return 890;
    }
}
class Margherita implements Pizza
{
    public function cost()
    {
        return 15;
    }
    public function getDescription(){
        return "Margherita";
        }

    public function getCalories()
    {
        return 800;
    }

}

class VegetarianPizza implements Pizza
{
    public function cost()
    {
        return 9;
    }
    public function getDescription()
    {
        return "Vegetarian Pizza";
    }
    public function getCalories()
    {
        return 90;
    }
}
class CheeseDecorator implements Pizza
{
    private $quantity;
    private $pizza;
    public function __construct(Pizza $pizza, $quantity)
    {
        $this->quantity = $quantity;
        $this->pizza = $pizza;
    }

    public function cost()
    {
        return $this->pizza->cost() + 3*$this->quantity;
    }

    public function getDescription()
    {
        return $this->pizza->getDescription(). " Avec $this->quantity fromage en plus";
    }
    public function getCalories()
    {
        return $this->pizza->getCalories() + 40 * $this->quantity;
    }
}

class HamDecorator implements Pizza
{
    private $quantity;
    private $pizza;

    public function __construct(Pizza $pizza, $quantity)
    {
        $this->quantity = $quantity;
        $this->pizza = $pizza;
    }
    public function cost()
    {
        return $this->pizza->cost() + 5 *$this->quantity;
    }
    public function getDescription()
    {
        return $this->pizza->getDescription(). " Avec $this->quantity Jambon en plus";
    }
    public function getCalories()
    {
        return $this->pizza->getCalories() + 600 * $this->quantity;
    }
}

class MushroomDecorator implements Pizza
{
    private $quantity;
    private $pizza;

    public function __construct(Pizza $pizza, $quantity)
    {
        $this->quantity = $quantity;
        $this->pizza = $pizza;
    }
    public function cost()
    {
        return $this->pizza->cost() + 7 *$this->quantity;
    }
    public function getDescription()
    {
        return $this->pizza->getDescription(). " Avec $this->quantity Champi en plus";
    }
    public function getCalories()
    {
        return $this->pizza->getCalories() + 3 * $this->quantity;
    }
}


$vege = new VegetarianPizza();
echo $vege->getDescription().PHP_EOL;
echo $vege->getCalories().PHP_EOL;
echo $vege->cost().PHP_EOL;
$pizzaChampi =new  MushroomDecorator($vege, 2);
echo $pizzaChampi->getDescription().PHP_EOL;
echo $pizzaChampi->getCalories().PHP_EOL;
echo $pizzaChampi->cost().PHP_EOL;

