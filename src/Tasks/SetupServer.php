<?php

namespace AssembleTrace\Outfitter\Tasks;

use AssembleTrace\Outfitter\Helper;

class SetupServer
{
    use InteractsWithRemote, Runnable;

    public function handle()
    {
        $script = Helper::script('SetupServer', [
            'userPassword' => Helper::password(),
            'databasePassword' => Helper::password()
        ]);

        Helper::info($script);

        $process = $this->createProcess($this->target, $script);

        $process->mustRun(function ($type, $line) {
            Helper::write($line);
        });
        
        //simple test to make sure nothing is installed.
        return $process->isSuccessful();
    }
}