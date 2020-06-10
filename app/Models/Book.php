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

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'isbn', 'authors', 'number_of_pages', 'country', 'publisher', 'release_date'
    ];

    protected $dates = ['deleted_at'];


}
