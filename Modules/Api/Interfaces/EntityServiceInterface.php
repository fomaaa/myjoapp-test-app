<?php


namespace Modules\Api\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;
use Modules\Api\Http\Requests\UserRequest;
use Modules\Api\Http\Requests\VehicleRequest;

interface EntityServiceInterface
{
    public function getAll();

    public function getWithTrashedAll();

    public function store($request);

}
