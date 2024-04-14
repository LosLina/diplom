<?php

namespace Core;

class Utils
{
    public static function ArrFilter($row, $fields)
    {
        $newRow = [];
        foreach ($fields as $field)
            if (isset($row[$field]))
                $newRow[$field] = $row[$field];
        return $newRow;

    }

}