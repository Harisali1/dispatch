<?php

namespace App\Models;


use App\Models\Interfaces\SprintConfirmationInterface;
use Illuminate\Database\Eloquent\Model;


class JoeyLocation extends Model
{
    /**
     * Table name.
     *
     * @var array
     */

    public $table = 'joey_locations';

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [
    ];


}