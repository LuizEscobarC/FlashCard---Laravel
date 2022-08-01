<?php

namespace App;

/**
 *
 */
trait TraitCallback
{
    /**
     * @param array $data
     * @return false|string
     */
    public static function callback(array $data)
    {
        $callback = [];

        foreach ($data as $key => $value) {
            $callback[$key] = $value;
        }

        header('Content-Type: application/json');
        return json_encode($callback);
    }
}
