<?php

namespace AssembleTrace\Outfitter\Tasks;

use AssembleTrace\Outfitter\Helper;

class CanConnect
{
    use InteractsWithRemote, Runnable;

    public function handle()
    {
        $script = Helper::script('CanConnect');

        Helper::info($script);

        $process = $this->createProcess($this->target, $script);

        $process->mustRun(function ($type, $line) {
            Helper::write($line);
        });

        return $process->isSuccessful();
    }
}