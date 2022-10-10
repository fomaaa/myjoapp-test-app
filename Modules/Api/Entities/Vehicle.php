<?php

namespace Modules\Api\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, softDeletes;
    /**
     *
     * @var string
     */
    protected $table = 'vehicle';

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];


    protected $fillable = [
        'brand',
        'model',
        'number'
    ];
    protected static function newFactory()
    {
        return \Modules\Api\Database\factories\VehicleFactoryFactory::new();
    }
}
