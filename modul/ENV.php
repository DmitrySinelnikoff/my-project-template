<?php

namespace modul;

class ENV
{
    public static function getConnectionData()
    {
        $env = parse_ini_file(__DIR__ . '//..//.env');
        return [
            'HOST' => $env['HOST'],
            'DBNAME' => $env['DBNAME'],
            'USER' => $env['USER'],
            'PASSWORD' => $env['PASSWORD']
        ];
    }
}