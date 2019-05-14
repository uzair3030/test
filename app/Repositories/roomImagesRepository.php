<?php

namespace App\Repositories;

use App\Models\roomImages;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class roomImagesRepository
 * @package App\Repositories
 * @version February 27, 2018, 10:34 am +03
 *
 * @method roomImages findWithoutFail($id, $columns = ['*'])
 * @method roomImages find($id, $columns = ['*'])
 * @method roomImages first($columns = ['*'])
*/
class roomImagesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'room_id',
        'img',
        'title'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return roomImages::class;
    }
}
