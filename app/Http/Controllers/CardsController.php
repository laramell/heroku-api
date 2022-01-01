<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /*
     * Get Routers
     * */
    public function all()
    {
        return Cards::all();
    }

    public function teste()
    {
        $cards = Cards::all();

        $contents = $cards[1]['content_card'];

        $content = explode('||', $contents);

        return $content;
    }

    public function selectByStudent(Request $request)
    {
        return Cards::where('fk_id_student', $request->student)->get();
    }

    public function selectByReviewAndStudentToday(Request $request)
    {
        return Cards::where('fk_id_student', $request->student)
            ->where('review_card', $request->review)
            ->get();

    }

    public function selectByReviewAndStudentLate(Request $request)
    {
        return Cards::where('fk_id_student', $request->student)
            ->where('review_card','<', $request->review)
            ->get();
    }


    /*
     * Posts Routers
     * */
    public function register(Request $request)
    {
    }
}
