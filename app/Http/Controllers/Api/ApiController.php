<?php

namespace App\Http\Controllers\Api;

use App\Models\Random;
use App\Models\Breakdown;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function index() {


    

        //Remaining Spiral
        $randomCount = Random::where('flag', false)->count();

        //look for first spiral that has not seen yet
        if(empty(Random::where('flag', false)->first())){
            $firstSpiral = Random::where('flag', true)->orderBy('id', 'desc')->first();
        }else{
            $firstSpiral = Random::where('flag', false)->first();
        }
       
        $breakdowns = Breakdown::where('random_id', $firstSpiral->id)->get();
        $firstSpiral->update(['flag' => true]);

        $paragraph = "";
        for ($i=0; $i < 5; $i++) { 
            $paragraph = $paragraph . " " . $this->toSentence($breakdowns) . " ...";
        }

        //Return data to API 
        return response()->json([
            'random_remaining' => $randomCount,
            'spiral' => $firstSpiral->values,
            'breakdowns' => $breakdowns,
            'paragraph' => $paragraph
        ]);



    }

    protected function toSentence($breakdowns){
        
        $text = "";
        foreach ($breakdowns as $breakdown => $value) {
            # code...
            $text = $text . " " . $value->values;
        }

        return $text;
    }
}
