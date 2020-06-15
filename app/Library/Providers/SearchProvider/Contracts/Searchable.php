<?php

namespace App\Library\Providers\SearchProvider\Contracts;

interface Searchable
{
    public function search(string $string);
}
