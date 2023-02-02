<?php

namespace App\Http\Controllers\Front;

use App\Models\JoeyDocument;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {


        \View::share('siteSettings', \App\Models\SiteSetting::find(1));

    }
}
