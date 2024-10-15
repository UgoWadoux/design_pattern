<?php

interface State {
    public function proceedToNext(CartContext $context);
}

class EmptyState implements State {
    public function proceedToNext(CartContext $context) {
        echo 'Empty cart ';
        $context->setState(new WithItemState());
    }
}

class WithItemState implements State {
    public function proceedToNext(CartContext $context) {
        echo 'Cart with item ';
        $context->setState(new CheckedOutState());
    }
}

class CheckedOutState implements State {
    public function proceedToNext(CartContext $context) {
        echo 'Checked out ';
        // Optionally, you can reset the state to EmptyState or any other state
        $context->setState(new EmptyState());
    }
}

class CartContext {
    protected $state;

    function __construct() {
        $this->setState(new EmptyState());
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    public function proceed() {
        $this->state->proceedToNext($this);
    }
}

// Utilisation
$cart = new CartContext();
$cart->proceed();
$cart->proceed();
$cart->proceed();



