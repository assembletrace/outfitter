<?php

namespace AssembleTrace\Outfitter;

use Exception;
use Illuminate\Container\Container;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

class Helper
{

    public static function app($name = null)
    {
        return $name ? Container::getInstance()->make($name) : Container::getInstance();
    }

    public static function script($name, $data = [])
    {
        return self::app('script')->make($name, $data)->render();
    }

    public static function home()
    {
        return $_SERVER['HOME'] ?? $_SERVER['USERPROFILE'];
    }

    public static function configPath()
    {
        return self::home() . '/.ssh/outfitter.config';
    }

    public static function ask($question, $default = null)
    {
        $style = new SymfonyStyle(static::app('input'), static::app('output'));

        return $style->ask($question, $default);
    }

    public static function menu($title, $choices)
    {
        $style = new SymfonyStyle(static::app('input'), static::app('output'));
        return $style->askQuestion(new ChoiceQuestion($title, $choices));
    }

    public static function info($text)
    {
        static::app('output')->writeln('<info>'.$text.'</info>');
    }

    public static function line($text = '')
    {
        static::app('output')->writeln($text);
    }

    public static function write($text)
    {
        static::app('output')->write($text);
    }

    public static function password(
        $length = 8,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
}