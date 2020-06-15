<?php

namespace App\Library\Providers\SearchProvider\Factories;


use App\Library\Providers\SearchProvider\Contracts\Searchable;
use Illuminate\Support\Str;

class SearchFactory
{
    private function __construct()
    {
    }

    public static function create($searchable)
    {
        $class = self::getClass($searchable);
        if (class_exists($class)) {
            $obj = new $class;
            if ($obj instanceof Searchable) {
                return $obj;
            }

            throw new \Exception(ucwords($searchable) . ' is not an instance of searchable');
        }
        throw new \Exception(ucwords($searchable) . ' is not an instantiable class');
    }

    private static function getClass($string)
    {
        return config('book.model_path') .
            self::getSingularClassName(self::replaceString($string));
    }

    private static function getSingularClassName(string $string): string
    {
        return Str::singular($string);
    }

    private static function replaceString($string)
    {
        $str = str_replace('-', ' ', $string);
        $str = ucwords($str);
        return str_replace(' ', '', $str);
    }
}
