<?php

namespace App\Models;

use App\Models\Interfaces\JoeyRoutesInterface;
use Illuminate\Database\Eloquent\Model;


class JoeyRoutes extends Model implements JoeyRoutesInterface
{

    public $table = 'joey_routes';

    protected $guarded = [];

    public function Hub()
    {
        return $this->hasOne(Hub::class, 'id', 'hub');
    }

    public function Zones()
    {
        return $this->hasOne(ZoneRouting::class, 'id', 'zones');
    }

}