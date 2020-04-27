<?php

namespace AssembleTrace\Outfitter\Tasks;

use AssembleTrace\Outfitter\Helper;
use Illuminate\Support\Str;

class IsCleanServer
{
    use InteractsWithRemote, Runnable;

    public function handle()
    {
        $script = Helper::script('IsCleanServer');

        Helper::info($script);

        $process = $this->createProcess($this->target, $script);

        $process->mustRun(function ($type, $line) {
            Helper::write($line);
        });

        $output = $process->getOutput();
        
        //simple test to make sure nothing is installed.
        return $process->isSuccessful() && !Str::contains($output, 'php') && !Str::contains($output, 'nginx');
    }
}