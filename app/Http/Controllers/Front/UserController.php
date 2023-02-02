<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\Front\ProfileUpdateRequest;
use App\Http\Requests\Front\UpdatePasswordRequest;
use App\Models\Hub;
use App\Models\Joey;
use App\Models\JoeyRoutes;
use App\Models\Sprint;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\Zones;
use App\Models\ZoneSchedule;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    private $adminRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepositoryInterface $adminRepository
     */
    public function __construct(UserRepositoryInterface $adminRepository)
    {

        $this->middleware('auth:web');
        parent::__construct();
        $this->adminRepository = $adminRepository;

    }

    /**
     * Dispatch Sign-up Success view
     *
     */
    public function signUpSuccess()
    {


            //Getting vendors count
            $vendors = Vendor::limit(10)->get();
            $vendorCount = Vendor::count();
            //Getting zones count
            $zonesCount = Zones::count();
            //Getting joeys
            $joeys = Joey::where('on_duty', '=', 1 )->limit(10)->get();
            //Get joeys count
            $joeysCount = Joey::count();
            //Check for today date
            $date=new \DateTime();
            $dateFormat =$date->format('Y-m-d');
//            dd($dateFormat);
            //Get shift count
            $shiftCount = ZoneSchedule::where('start_time', '>=', $dateFormat.' 00:00:00')
                ->where('start_time','<=', $dateFormat.' 23.59.59')
                ->count();
            //Get orders counts
            $orderCount = Sprint::where('created_at', '>=', $dateFormat.' 00:00:00')
                ->where('created_at','<=', $dateFormat.' 23.59.59')
                ->count();
            //Get hub count
            $hubCount = Hub::count();

//            dd($dateFormat. ' 00:00:00');
            //Getting Order Detail
            $recentOrders = Sprint::limit(10)->get();
//            dd($recentOrders);

            $recentRoutes = JoeyRoutes::where('created_at', '>=', $dateFormat.' 00:00:00')
                                         ->where('created_at','<=', $dateFormat.' 23.59.59')
                                         ->whereNull('deleted_at')
                                         ->limit(10)->get();

            return view('front.dashboards.dashboard',
                compact(
//                    'record',
//                    'status',
                    'vendorCount',
                    'zonesCount',
                    'joeysCount',
                    'shiftCount',
                    'orderCount',
                    'hubCount',
                    'joeys',
                    'vendors',
                    'recentOrders',
                    'recentRoutes'
                ));


    }

    /**
     * Update Profile View
     *
     */
    public function updateProfileView()
    {

        $data = $this->adminRepository->find(auth()->user()->id);
        return view('front.profile.edit-profile',compact('data'));

    }

    /**
     * Update Profile
     * @param ProfileUpdateRequest $request
     * @return $this
     */
    public function updateEditProfile(ProfileUpdateRequest $request)
    {
        $userRecord = auth()->user();
        $exceptFields = [
            '_token',
            '_method',
            'email',
        ];

        // 1 = super admin user id, and is_active status cannot be set for it
        if ($userRecord->id == 1) {
            $exceptFields[] = 'is_active';
        }
        $data = $request->except($exceptFields);

        $updateRecord = [
            'name' => $data['name'],
            'phone' => phoneFormat($data['phone']),
        ];

        //check logo if exists
        if ($request->hasfile('profile_picture')) {


            //move | upload file on server
            $slug = Str::slug($data['name'], '-');
            $file = $request->file('profile_picture');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = $slug . '-' . time() . '.' . $extension;

            $file->move(backendUserFile(), $filename);

            $updateRecord['profile_picture'] = url(backendUserFile(),$filename);
            $oldImage = $userRecord->profile_picture;

        }
        if (isset($data['password']))
        {
            $updateRecord['password'] = bcrypt($data['password']);
        }
        $this->adminRepository->update($userRecord->id, $updateRecord);

//        if (isset($oldImage)) {
//
//            $this->safeRemoveImage($oldImage, backendUserFile());
//
//        }
        /*return data */
        return redirect()
            ->route('edit-profile')
            ->with('success', 'Profile updated successfully.');
    }


    /**
     * Password Reset View
     *
     */
    public function resetPasswordView()
    {
        return view('front.profile.reset-password');

    }

    public function processChangePassword(UpdatePasswordRequest $request)
    {
        $id = Auth::user()->id;
        if(Hash::check($request->get('oldPassword'),Auth::user()->password)){
            $data['password'] = bcrypt($request->get('password'));
            $this->adminRepository->update($id, $data);
            return redirect()
                ->route('users.change-password')
                ->with('success', 'Password has been changed successfully..');
        }else{
            return redirect()
                ->route('users.change-password')
                ->with('errors', 'Please enter the old password correctly');
        }

    }
}
