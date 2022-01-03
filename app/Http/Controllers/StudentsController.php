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

    public function register(Request $request)
    {
        // Check if exist
        $exist = $this->selectByEmail($request);
        if ($exist->count() > 0) {
            return response()->json([
                'status'=> 409,
                'message' => 'This email is already registered!'
            ]);
        }
        elseif (!isset($request->name) ||
                !isset($request->email) ||
                !isset($request->password) ||
                !isset($request->since) ||
                !isset($request->google))
        {
            return response()->json([
                'status' => 400,
                'message' => 'The request failed. We need the name, email, password, since and Google to make the request.'
            ]);
        }
        else {
            $student = new Students();
            $student->name_student = $request->name;
            $student->email_student = $request->email;
            $student->password_student = $request->password;
            $student->since_student = $request->since;
            $student->google_student = $request->google;

            if ($student->save()) {
                return response()->json([
                    'status' => 201,
                    'message' => 'Registration performed successfully'
                ]);
            }else {
                return response()->json([
                    'status' => 500,
                    'message' => 'The request failed'
                ]);
            }
        }
    }

    public function delete(Request $request)
    {
        $exist = $this->selectById($request);
        $student = Students::where('id_student', $request->id);

        // Check datas
        if(!isset($request->id)) {
            // ID is empty
            return response()->json([
                'status' => 400,
                'message' => 'The request failed. We need the ID to make the request.']);
        }
        // Check if exist
        elseif ($exist->count() < 1){
            // Doesnt exist
            return response()->json([
                'status'=> 409,
                'message' => 'This ID dont exist!'
            ]);
        }
        // Delete
        else{
            if ($student->delete()){
                // Student was deleted
                return response()->json([
                    'status' => 201,
                    'message' => 'Successfully deleted'
                ]);
            }else {
                // Error
                return response()->json([
                    'status' => 500,
                    'message' => 'The request failed'
                ]);
            }

        }

    }
}
