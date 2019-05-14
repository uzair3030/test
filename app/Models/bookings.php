<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class bookings
 * @package App\Models
 * @version February 25, 2018, 7:56 am UTC
 *
 * @property integer room_id
 * @property string|\Carbon\Carbon startDateTime
 * @property string|\Carbon\Carbon endDatgeTime
 * @property String customerName
 * @property String customerEmail
 * @property integer players
 * @property String customerMobile
 */
class bookings extends Model
{
    use SoftDeletes;

    public $table = 'bookings';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'room_id',
        'startDateTime',
        'endDateTime',
        'customerName',
/*        'customerEmail',*/
        'players',
        'image',
        'name_en',
        'desc_en',
        'customerMobile',
        'total',
        'status',
        'customerLang',
        'deadlineForPaid',
        'ip'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'room_id' => 'integer',
        'players' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function room()
    {
        return $this->belongsTo(rooms::class);
    }


}
