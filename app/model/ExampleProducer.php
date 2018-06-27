<?php

namespace App\Model;


use Kdyby\RabbitMq\Connection;
use Kdyby\RabbitMq\Producer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExampleProducer extends Command implements ICommand
{
    const NAME = 'Rabbit:exampleProducer';
    const MESSAGE_ARG = 'Message';

    /**
     * @var Connection
     */
    private $bunny;


    public function __construct(
        Connection $bunny
    )
    {
        parent::__construct();

        $this->bunny = $bunny;
    }

    public function configure(): void
    {
        $this->setName(self::NAME)
            ->addArgument(self::MESSAGE_ARG, InputArgument::REQUIRED, 'Message')
            ->setDescription('Publish message to example consumer');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $output->writeln('Spoustim producenta');

            $message = $input->getArgument(self::MESSAGE_ARG);

            $output->writeln('Odesilam zpravu: ' . $message);

            /** @var Producer $producer */
            $producer = $this->bunny->getProducer('example');
            $producer->publish(json_encode([
                'message' => $message,
            ]));

            $output->writeln('Zprava odeslana');

            return 0;
        }
        catch (\Exception $e)
        {
            $output->writeln('Chyba - ' . $e->getMessage());

            return 1;
        }
    }
}