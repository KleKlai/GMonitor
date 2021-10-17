<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Models\Attendance;
use Auth;

class AttendanceController extends Controller
{
    public function recordAttendance(Request $request)
    {
        // Who is the current login user?
        // What classroom post request came from?

        //is the user enrolled in the current classroom?

        Attendance::create([
            'user_id'       =>  Auth::user(),
            'classroom_id'  =>  $request->classroom,
        ]);

        return response("test");
    }
}
