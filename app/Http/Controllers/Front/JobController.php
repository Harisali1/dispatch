<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\JoeyRoutificJob;
use App\Models\Joey;
use App\Models\JoeyRoutificJobLocation;
use App\Models\JoeyRoutificJobRoute;
use App\Models\Location;
use App\Models\SprintTask;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $joeys = Joey::where('on_duty', '=', 1)->whereNull('deleted_at')->get();
        return view('front.jobs.job-map-view', compact('joeys'));
    }

    public function jobRoutes($id)
    {

//        $start_date = date('Y-m-d') . ' 00:00:00';
//        $end_date = date('Y-m-d') . ' 23:59:00';
//        $start_date = ConvertTimeZone($start_date, 'America/Toronto', 'UTC');
//        $end_date = ConvertTimeZone($end_date, 'America/Toronto', 'UTC');

        $routes = JoeyRoutificJobRoute::whereJoeyId($id)->whereNull('deleted_at')->pluck('id');
        $jobs = JoeyRoutificJobLocation::whereIn('route_id', $routes)
            ->whereNull('deleted_at')->get();

        $response = [];

        foreach ($jobs as $key => $job) {
            $tasks = SprintTask::where('sprint_id', $job->sprint_id)->whereNull('deleted_at')->get();
            foreach ($tasks as $task) {
                $location = Location::find($task->location_id);
                $response[$task->id] = [
                    'location_id' => $location->id,
                    'lat' => substr($location->latitude,0,8) / 1000000,
                    'lng' => substr($location->longitude,0,9) / 1000000,
                    'location_name' => $location->address,
                    'type' => $task->type,
                ];
            }
        }

        $result = array_values($response);

        return json_encode([ "output" => $result ]);


    }
}
