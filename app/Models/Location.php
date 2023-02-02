<?php

namespace App\Models;



use App\Models\Interfaces\LocationInterface;
use Illuminate\Database\Eloquent\Model;


class Location extends Model implements LocationInterface
{
    /**
     * Table name.
     *
     * @var array
     */

    public $table = 'locations';

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [
    ];


}