<?php

namespace AssembleTrace\Outfitter\Tasks;

use AssembleTrace\Outfitter\Helper;

trait Runnable
{
    public static function run($target = null)
    {
        $task = new static(...func_get_args());
        $task->target = $target ?? Helper::app('target');
        return $task->handle();
    }
}