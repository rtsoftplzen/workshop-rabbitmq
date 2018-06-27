<?php

namespace App\Model;


use PhpAmqpLib\Message\AMQPMessage;

interface IConsumer
{
    public function process(AMQPMessage $message): void;
}