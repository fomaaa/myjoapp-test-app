<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, softDeletes;
    /**
     *
     * @var string
     */
    protected $table = 'vehicle_user';

    protected $fillable = [
        'name'
    ];

//    protected $hidden

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected static function newFactory()
    {
        return \Modules\Api\Database\factories\UserFactoryFactory::new();
    }
}
