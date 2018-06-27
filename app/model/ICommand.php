<?php

namespace App\Model;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ICommand
{
    public function configure(): void;

    public function execute(InputInterface $input, OutputInterface $output): int;
}