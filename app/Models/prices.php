<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class prices
 * @package App\Models
 * @version February 25, 2018, 7:51 am UTC
 *
 * @property integer room_id
 * @property integer players
 * @property integer price
 * @property integer weekendPrice
 */
class prices extends Model
{

    public $table = 'prices';
    



    public $fillable = [
        'room_id',
        'players',
        'price',
        'icon',
        /*'weekendPrice'*/
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'room_id' => 'integer',
        'players' => 'integer',
        'price' => 'integer',
        /*'weekendPrice' => 'integer'*/
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
