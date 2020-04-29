<?php

namespace AssembleTrace\Outfitter\Commands;

use AssembleTrace\Outfitter\Helper;
use AssembleTrace\Outfitter\Tasks\CheckServerVersion;
use AssembleTrace\Outfitter\Tasks\IsCleanServer;
use AssembleTrace\Outfitter\Tasks\SetupServer;

class AddServerCommand extends Command
{
    protected static $defaultName = 'server:add';

    protected function configure()
    {
        $this
            ->setName('server:add')
            ->setDescription('Test connection and creates the outfitter user for any future connections');
    }

    public function handle() {

        $username = Helper::ask("username");
        $host = Helper::ask("Host / ip");
        $target = "$username@$host";
        Helper::app()->instance('target', $target);

        if(IsCleanServer::run() && CheckServerVersion::run()) {
            //add the outfitter user
            Helper::line('Lets setup this server up');
            $php = Helper::menu('Which php', ['74' => '74', '73' => '73']);
            Helper::line($php);
            SetupServer::run($php);
        }

        //echo $script;

        //$process = Process::fromShellCommandline("ssh $username@$host date");

        //$process->run(null, []);

        // if (!$process->isSuccessful()) {
        //     echo "Was unable t connect";
        // }

        // echo $process->getOutput();

        //$config = fopen(Helper::configPath(), "w");
        //echo $config;
    }
}