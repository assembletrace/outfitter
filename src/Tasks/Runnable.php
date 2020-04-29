<?php

namespace AssembleTrace\Outfitter\Tasks;

use AssembleTrace\Outfitter\Helper;

trait Runnable
{
    public static function run()
    {
        $task = new static(...func_get_args());
        $task->target = Helper::app('target');
        return $task->handle();
    }
}