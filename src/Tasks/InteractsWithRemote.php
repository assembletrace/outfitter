<?php

namespace AssembleTrace\Outfitter\Tasks;

use Symfony\Component\Process\Process;

trait InteractsWithRemote
{
    protected function createProcess(string $target, string $script)
    {

        $delimiter = 'EOF-OUTFITTER';

        $process = Process::fromShellCommandline("ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no $target 'bash -s' << \\$delimiter" . PHP_EOL . $script . PHP_EOL . $delimiter);

        return $process->setTimeout(null);
    }
}