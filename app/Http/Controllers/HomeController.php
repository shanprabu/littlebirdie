<?php

namespace App\Http\Controllers;

use App\Jobs\sendToReqres;
use Illuminate\Http\Request;
use App\User;
use App\UserDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['userlist'] = UserDetail::with('user')->paginate(10);
        return view('home', $data);
    }

    /**
     * Show view to edit user records
     */
    public function edit($userId)
    {
        $data['userinfo'] = UserDetail::with('user')->where('user_id', $userId)->first();
        //dd($data);
        return view('edit', $data);
    }

    /**
     * Validate user details submitted from the edit form and save to table
     * A new job is created for every update to send user data to ReqRes API
     */
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'avatar' => 'url',
            'state' => 'max:3',
            'postcode' => 'max:4'
        ]);

        $userDetail = UserDetail::with('user')->where('user_id',$request->user_id)->first();

        $userDetail->first_name = $request->first_name;
        $userDetail->last_name = $request->last_name;
        $userDetail->user->email = $request->email;
        $userDetail->user->name = $request->first_name . " " . $request->last_name;
        $userDetail->avatar = $request->avatar;
        $userDetail->state = $request->state;
        $userDetail->postcode = $request->postcode;
        $userDetail->push();

        $userData = [
            'id' => $userDetail->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'avatar' => $request->avatar,
            'state' => $request->state,
            'postcode' => $request->postcode
        ];
        sendToReqres::dispatch($userData); //Create job to update remote through the API
        return redirect('home');
    }
}
