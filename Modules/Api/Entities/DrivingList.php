<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class DrivingList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vehicle_id', 'start_at', 'finish_at'];

    protected $dates = ['start_at', 'finish_at'];

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'driving_list';

    protected static function newFactory()
    {
        return \Modules\Api\Database\factories\DrivingListFactory::new();
    }

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('vehicle_id', '=', $this->getAttribute('vehicle_id'));

        return $query;
    }
}
