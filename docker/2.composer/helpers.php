<?php

use Symfony\Component\VarDumper\VarDumper;


if(!function_exists('dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }
    
        exit(1);
    } 
}