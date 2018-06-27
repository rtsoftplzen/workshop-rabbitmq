<?php

namespace App\Model;


use PhpAmqpLib\Message\AMQPMessage;
use Tracy\Debugger;

class ExampleConsumer implements IConsumer
{
    public function process(AMQPMessage $message): void
    {
        Debugger::log("Zpracovavam pozadavek");

        $messageBody = json_decode($message->body, true);

        Debugger::log("Zprava: " . $messageBody['message']);

        // throw new \Exception('Test exception');
    }
}