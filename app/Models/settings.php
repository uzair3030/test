<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class settings
 * @package App\Models
 * @version February 25, 2018, 7:06f am UTC
 *
 * @property String startWorkTime
 * @property String endWorkTime
 * @property String weekendDays
 */
class settings extends Model
{

    public $table = 'settings';
    


    public $fillable = [
        'startWorkTime',
        'endWorkTime',
        /*'room_id',
        'room_name',*/
        'durationOfRoomReservation',
        'breakTimeBetweenEachBooking',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
