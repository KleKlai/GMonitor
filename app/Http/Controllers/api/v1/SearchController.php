<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;

class SearchController extends Controller
{
    public function searchClassroom(Request $request)
    {
        // User can search classroom where she is currently enroll in

        $classroom = Classroom::where('name', 'LIKE', "%{$request->name}%")->get();

        return response($classroom);
    }
}
