<?php

namespace App\Library\Providers\SearchProvider\Traits;


trait Searcher
{
    public function search(string $search)
    {
        if (!property_exists($this, 'searchable_fields')) {
            throw new \Exception(get_class($this) . ' must have a property called searchable fields');
        }
        $a = $this->searchable_fields;
        return self::where(function ($query) use ($a, $search) {
            foreach ($this->searchable_fields as $key) {
                $query->orWhere($key, 'LIKE', "%$search%");
            }
        })->get();
    }
}
