<?php
interface State
{
    public function proceedToNext();
}
class EmptyState implements State
{
    public function proceedToNext()
    {
        echo 'Empty cart ';
    }
}
class withItemState implements State
{
    public function proceedToNext()
    {
        echo 'Cart with item ';
    }
}
class checkedOutState implements State
{
    public function proceedToNext()
    {
        echo 'checked out ';
    }
}
class CartContext
{
    protected $state;
    function __construct(State $state)
    {
        $this->setState($state) ;
    }
    public function setState(State $state)
    {
        $this->state = $state;
    }
    public function proceed()
    {
        $this->state->proceedToNext();
    }
}
$cart = new CartContext(new EmptyState());
$cart->proceed();
$cart->setState(new withItemState());
$cart->proceed();
$cart->setState(new checkedOutState());
$cart->proceed();