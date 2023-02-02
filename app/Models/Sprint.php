<?php

namespace App\Models;

use App\Models\Interfaces\SprintInterface;
use Illuminate\Database\Eloquent\Model;


class Sprint extends Model implements SprintInterface
{
    /**
     * Table name.
     *
     * @var array
     */

    public $table = 'sprint__sprints';

    protected $guarded = [];

    public function Brand()
    {
        return $this->belongsTo(Brand::class,'creator_id','vendor_id');
    }

    /**
     * Get Joeys
     */
    public function Joeys()
    {
        return $this->belongsTo(Joey::class,'joey_id','id');
    }

    /**
     * Get Sprint Task
     */
    public function SprintTasks()
    {
        return $this->hasMany( SprintTask::class,'sprint_id', 'id');
    }

    /**
     * Get last drop Sprint Task
     */
    public function LastDropOffTasks()
    {
        return $this->hasOne( SprintTask::class,'sprint_id', 'id')->orderBy('id','DESC')->where('type','dropoff');
    }

    /**
     * Relation With Vendor.
     *
     */
    public function Vendor()
    {
        return $this->belongsTo(Vendor::class,'creator_id','id');
    }

    /**
     * Get Sprint Task
     */
    /*public function Tasks()
    {
        return $this->hasMany( SprintTask::class,'sprint_id', 'id')->where('type','dropoff')->orderBy('id','desc');
    }*/

    public function sprintZoneSchedule()
    {
        return $this->belongsToMany(ZoneSchedule::class);
    }



}