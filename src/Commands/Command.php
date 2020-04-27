<?php

namespace AssembleTrace\Outfitter\Commands;

use AssembleTrace\Outfitter\Helper;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class Command extends SymfonyCommand
{
    public $server;

    public $input;

    public $output;

    protected $startedAt;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Helper::app()->instance('input', $this->input = $input);
        Helper::app()->instance('output', $this->output = $output);

        $this->configureOutputStyles($output);

        if(static::class != AddServerCommand::class) {
            //find out which server we are working on
            $io = new SymfonyStyle($input, $output);
        
            $question = new ChoiceQuestion('Something', ['one' => 'one', 'two' => 'two']);

            $io->askQuestion($question);

            $io->choice('Select the queue to analyze', ['queue1', 'queue2', 'queue3']);
        }

        Helper::app()->call([$this, 'handle']);

        return 0;
    }

    protected function configureOutputStyles(OutputInterface $output)
    {
        $output->getFormatter()->setStyle(
            'bright', new OutputFormatterStyle('white', 'default', ['bold'])
        );

        $output->getFormatter()->setStyle(
            'finished', new OutputFormatterStyle('green', 'default', ['bold'])
        );
    }
}