<?php

namespace App\Models;
use App ;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class rooms
 * @package App\Models
 * @version February 25, 2018, 7:37 am UTC
 *
 * @property string name
 * @property longtext desc
 * @property string age
 * @property string capacity
 * @property string category
 * @property string duration
 * @property string status
 */
class rooms extends Model
{
    use SoftDeletes;

    public $table = 'rooms';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'number',
        'name_en',
        'desc',
        'desc_en',
        'age',
        'capacity',
        'category',
        /*'duration',*/
        'age_en',
        'category_en',
        'image',
        'image_en',
        'image1',
        'image2',
        'image3',
        'videoUrl',
        'live_performance_room',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'age' => 'string',
        'capacity' => 'string',
        'category' => 'string',
        /*'duration' => 'string',*/
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function prices() {
       return  $this->hasMany(prices::class,'room_id')->select('id','players','price'/*,'weekendPrice'*/,'icon')  ;
    }

    public function getNameAttribute($name){
        if (!\Request::is('admin/*')) {
            if(App::isLocale('en'))
            return $this->attributes['name_en'];
            return $name;
        }
        return $name;
    }

    public function getDescAttribute($name){
        if (!\Request::is('admin/*')) {

        if(App::isLocale('en'))
        return $this->attributes['desc_en'];
        return $name;
    }
    return $name;
    }

    public function getAgeAttribute($name){
        if (!\Request::is('admin/*')) {

        if(App::isLocale('en'))
        return $this->attributes['age_en'];
        return $name;
    }
    return $name;
    }


    public function getCategoryAttribute($name){
        if (!\Request::is('admin/*')) {

        if(App::isLocale('en'))
        return $this->attributes['category_en'];
        return $name;
    }
    return $name;
    }

    
}
