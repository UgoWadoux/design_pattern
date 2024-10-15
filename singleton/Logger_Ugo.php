<?php

class Logger
{
    private static $instance = null;
    private function __construct(){
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }
    private function __clone(){}
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
    public function log($message)
    {
        $timestamp =  date('Y-m-d H:i:s');
        $logFile = fopen('log.txt', 'a');
        fwrite($logFile, $timestamp.' '.$message. PHP_EOL);
        fclose($logFile);
        echo $message;
    }
}

$logger = Logger::getInstance();
$logger->log('Hello World');
$anotherlogger = Logger::getInstance();
$anotherlogger->log('Another log message');