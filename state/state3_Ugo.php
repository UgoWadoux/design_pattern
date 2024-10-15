<?php

abstract class State {
    protected $context;
    public function __construct(CartContext $context) {
        $this->context = $context;
    }

    abstract public function EmptyCart();
    abstract public function WithItem();
    abstract public function CheckedOut();
}

class EmptyState extends State {
    public function EmptyCart()
    {
        echo 'Empty cart ';
    }
    public function WithItem()
    {
        echo 'Cart with item ';
        $this->context->setState(new WithItemState($this->context));    }
    public function CheckedOut()
    {
        echo 'Checked out';
    }

}

class WithItemState extends State {
    public function EmptyCart()
    {
        echo 'Empty cart ';
    }
    public function WithItem()
    {
        echo 'Cart with item ';
    }
    public function CheckedOut()
    {
        echo 'Checked out';
        $this->context->setState(new CheckedOutState($this->context));
    }

}

class CheckedOutState extends State {
    public function EmptyCart()
    {
        echo 'Empty cart ';
    }
    public function WithItem()
    {
        echo 'Cart with item ';

    }
    public function CheckedOut()
    {
        echo 'Checked out';
    }
}

class CartContext {
    protected $state;

    function __construct() {
        $this->setState(New EmptyState($this));
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    public function emptyCart()
    {
        echo  "update state : ". PHP_EOL;
        $this->state->EmptyCart();
        echo PHP_EOL;
    }
    public function withItem()
    {
        echo  "update state : ". PHP_EOL;

        $this->state->WithItem();
        echo PHP_EOL;

    }
    public function checkedOut()
    {
        echo  "update state : ". PHP_EOL;

        $this->state->CheckedOut();
        echo PHP_EOL;

    }
}

// Utilisation
$cart = new CartContext();
$cart->emptyCart();
$cart->withItem();
$cart->checkedOut();

