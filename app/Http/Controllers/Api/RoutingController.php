<?php

namespace App\Http\Controllers\Api;

use App\Classes\Client;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Repositories\Interfaces\RouteRequestRepositoryInterface;

class RoutingController extends Controller
{

    private $routeRequestRepository, $client;

    /**
     * Create a new controller instance.
     *
     * @param RouteRequestRepositoryInterface $routeRequestRepository
     * @param Client $client
     */
    public function __construct(RouteRequestRepositoryInterface $routeRequestRepository, Client $client)
    {
        parent::__construct();
        $this->client = $client;
        $this->routeRequestRepository = $routeRequestRepository;
    }


    public function index()
    {
        $response = [];
        $zones = $this->routeRequestRepository->zones();
        foreach ($zones as $zone) {
            $shifts = $this->routeRequestRepository->shifts($zone);
            if(count($shifts) == 0){
                return response()->json(['status' => 'No Shifts Available Today'], 400);
            }
            if (count($shifts) > 0) {
                foreach ($shifts as $shift) {
                    $shiftOrders = $this->routeRequestRepository->shiftOrders($shift->id);
                    if (count($shiftOrders) == 0) {
                        return response()->json(['status' => 'No Orders Available Of The Shift'], 400);
                    }
                    foreach ($shiftOrders as $shiftOrder) {
                        $sprintTasks = $this->routeRequestRepository->sprintTask($shiftOrder);
                        if (count($sprintTasks) == 0) {
                            return response()->json(['status' => 'No Tasks Of The Order'], 400);
                        }
                        foreach ($sprintTasks as $task) {
                            $merchants = $this->routeRequestRepository->merchant($task->id);
                            $location = Location::find($task->location_id);
                            $visits = [
                                "location" => [
                                    "name" => $location->address,
                                    "lat" => substr($location->latitude,0,8) / 1000000,
                                    "lng" => substr($location->longitude,0,9) / 1000000,
                                ],
                                "start" => $merchants->start_time ?? null,
                                "end" => $merchants->end_time ?? null,
                                "duration" => 10
                            ];
                            $response[$shift->id]['visits'][$shiftOrder][$task->type] = $visits;
                        }
                    }

                    $joeySchedules = $this->routeRequestRepository->occupiedJoey($shift->id);

                    if (count($joeySchedules) == 0) {
                        return response()->json(['status' => 'No Joeys In This Shifts'], 400);
                    }


                    $startTime = date('H:i', strtotime($shift->start_time));
                    $endTime = date('H:i', strtotime($shift->end_time));

                    foreach ($joeySchedules as $joeySchedule) {
                        $joeyLocation = $this->routeRequestRepository->joeyLocation($joeySchedule);
                        $fleet = [
                            "start_location" => [
                                "id" => $joeySchedule,
                                "name" => $location->name,
                                "lat" => substr($joeyLocation->latitude,0,8) / 1000000,
                                "lng" => substr($joeyLocation->longitude,0,9) / 1000000,
                            ],
                            'shift_start' => $startTime,
                            'shift_end' => $endTime,
                            'capacity' => $shift->capacity
                        ];
                        $response[$shift->id]['fleet'][$joeySchedule] = $fleet;
                    }

                    $res = json_encode($response[$shift->id]);

//                    echo $res;

                    $result = $this->client->getJobId($res);

                    if(!empty($result->error)){
                        return json_encode([
                            "status" => "Route Creation Error",
                            "output"=> $result->error
                        ]);
                    }

                    $job = json_encode($result, true);
                    $job = json_decode($job, true);

                    $rom = $this->client->getJobResponseByJobId($job['job_id']);

                    echo $rom;

                }
            }
        }
    }

}
