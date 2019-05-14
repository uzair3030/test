<?php

namespace App\Repositories;

use App\Models\gustbook;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class gustbookRepository
 * @package App\Repositories
 * @version August 12, 2018, 6:03 am +03
 *
 * @method gustbook findWithoutFail($id, $columns = ['*'])
 * @method gustbook find($id, $columns = ['*'])
 * @method gustbook first($columns = ['*'])
*/
class gustbookRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return gustbook::class;
    }
}
