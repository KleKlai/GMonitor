<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Classroom;

class JoinController extends Controller
{
    public function joinClassroom(Request $request)
    {
        // return response(Auth()->user()->getRoleNames());

        // Validate Incoming Data
        $request->validate([
            'code'  => 'required'
        ]);

        //Validate current user role
        if(!Auth()->user()->hasRole('student'))
        {
            return response('unauthorized');
        }

        // Find the classroom using $request->code
        $classroom = Classroom::where('code', $request->code)->first();

        // Make restriction here process if the classroom is not found!
        if($classroom == null){
            return response('Classroom not found!');
        }

        //Attach the user to the classroom
        //"syncWithoutDetaching" enable the pivot table to prevent duplicate entry if send the request twice
        $classroom->users()->syncWithoutDetaching(Auth()->user(), ['is_teacher' => false]);

        return response()->json([
            "Status"    => "OK",
            "Message"   => "User " . Auth()->user()->email . " joined classroom " . $classroom->name,
            "Classroom" => $classroom,
        ], 201);
    }
}
