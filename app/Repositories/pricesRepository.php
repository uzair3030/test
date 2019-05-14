<?php

namespace App\Repositories;

use App\Models\prices;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class pricesRepository
 * @package App\Repositories
 * @version February 25, 2018, 7:51 am UTC
 *
 * @method prices findWithoutFail($id, $columns = ['*'])
 * @method prices find($id, $columns = ['*'])
 * @method prices first($columns = ['*'])
*/
class pricesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'room_id',
        'players',
        'price',
        'weekendPrice'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return prices::class;
    }
}
