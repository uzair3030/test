<?php

namespace App\Repositories;

use App\Models\rooms;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class roomsRepository
 * @package App\Repositories
 * @version February 25, 2018, 7:37 am UTC
 *
 * @method rooms findWithoutFail($id, $columns = ['*'])
 * @method rooms find($id, $columns = ['*'])
 * @method rooms first($columns = ['*'])
*/
class roomsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'desc',
        'age',
        'capacity',
        'category',
        'duration',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return rooms::class;
    }
}
