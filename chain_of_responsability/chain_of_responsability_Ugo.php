<?php
interface Handler
{
    public function handle(string $request): ?String;
    public function setNext(Handler $handler): Handler;
}

abstract class AbstractHandler implements Handler
{
    private $nextHandler;
    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }
    public function handle(string $request): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }
}

class ConcreteHandler1 extends AbstractHandler
{
    public function handle(string $request): ?String
    {
        if ($request == "request1"){
            return "Handler1 à traiter la demande \n";
        }else{
            return parent::handle($request);
        }
    }
}

class ConcreteHandler2 extends AbstractHandler
{
    public function handle(string $request): ?String
    {
        if ($request == "request2"){
            return "Handler2 à traiter la demande \n";
        }else{
            return parent::handle($request);
        }
    }
}

$handler1 = new ConcreteHandler1();
$handler2 = new ConcreteHandler2();
$handler1->setNext($handler2);
echo $handler1->handle("request1");
echo $handler1->handle("request2");