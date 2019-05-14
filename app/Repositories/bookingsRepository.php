<?php

namespace App\Repositories;

use App\Models\bookings;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class bookingsRepository
 * @package App\Repositories
 * @version February 25, 2018, 7:56 am UTC
 *
 * @method bookings findWithoutFail($id, $columns = ['*'])
 * @method bookings find($id, $columns = ['*'])
 * @method bookings first($columns = ['*'])
*/
class bookingsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        /*'room_id',
        'startDateTime',
        'endDateTime',
        'customerName',
        'customerEmail',
        'players',
        'customerMobile'*/
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bookings::class;
    }
}
