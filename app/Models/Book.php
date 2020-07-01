<?php
/***********************************************
 ** File : Book Model file
 ** Date: 9th June 2020  *********************
 ** Book Model file
 ** Author: Asefon pelumi M. ******************
 ** Senior Software Developer ******************
 * Email: pelumiasefon@gmail.com  ***************
 * ***********************************************/

namespace App\Models;

use App\Library\Providers\SearchProvider\Contracts\Searchable;
use App\Library\Providers\SearchProvider\Traits\Searcher;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements Searchable
{

    use Searcher;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'isbn', 'authors', 'number_of_pages', 'country', 'publisher', 'release_date'
    ];

    protected $dates = ['deleted_at'];

    public static $searchable_fields = [
        'name',
        'isbn',
        'country',
        'publisher',
        'release_date'
    ];


    public function search(string $search)
    {
        $a = $this->searchable_fields;
        return self::where(function ($query) use ($a, $search) {
            foreach ($this->searchable_fields as $key) {
                $query->orWhere($key, 'LIKE', "%$search%");
            }
        })->get();
    }

    /**
     * @return array
     */
    public function getSearchableFields(): array
    {
        return $this->searchable_fields;
    }
}
