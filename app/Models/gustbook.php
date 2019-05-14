<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class gustbook
 * @package App\Models
 * @version August 12, 2018, 6:03 am +03
 *
 * @property string image
 * @property string status
 */
class gustbook extends Model
{
    use SoftDeletes;

    public $table = 'gustbooks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'image',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
