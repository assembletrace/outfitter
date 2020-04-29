<?php

namespace AssembleTrace\Outfitter\Tasks;

use AssembleTrace\Outfitter\Helper;
use Illuminate\Support\Str;

class CheckServerVersion
{
    use InteractsWithRemote, Runnable;

    public function handle()
    {
        $script = Helper::script('server.version');

        Helper::info($script);

        $process = $this->createProcess($this->target, $script);

        $process->mustRun(function ($type, $line) {
            Helper::write($line);
        });

        $output = $process->getOutput();
        $version = floatval(preg_replace("/[^-0-9\.]/", '', $output));

        return $process->isSuccessful() && Str::contains($output, 'Ubuntu') && $version > 18.00;
    }
}