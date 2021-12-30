<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function all()
    {
        return Students::All();
    }

    public function selectById(Request $request)
    {
        return Students::where('id_student', $request->id)->get();
    }

    public function selectByEmail(Request $request)
    {
        return Students::where('email_student', $request->email)->get();
    }

    public function selectBySince(Request $request)
    {

        return Students::where('since_student', $request->since)->get();
    }

}
