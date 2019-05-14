<?php

namespace App\Repositories;

use App\Models\settings;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class settingsRepository
 * @package App\Repositories
 * @version February 25, 2018, 7:06 am UTC
 *
 * @method settings findWithoutFail($id, $columns = ['*'])
 * @method settings find($id, $columns = ['*'])
 * @method settings first($columns = ['*'])
*/
class settingsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'startWorkTime',
        'endWorkTime',
        'weekendDays'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return settings::class;
    }
}
