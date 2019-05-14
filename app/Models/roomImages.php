<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class roomImages
 * @package App\Models
 * @version February 27, 2018, 10:34 am +03
 *
 * @property integer room_id
 * @property string img
 * @property string title
 */
class roomImages extends Model
{
    use SoftDeletes;

    public $table = 'room_images';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'room_id',
        'img',
        'title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'room_id' => 'integer',
        'img' => 'string',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
