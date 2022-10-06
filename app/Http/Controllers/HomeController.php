<?php

namespace App\Http\Controllers;

use App\Models\Breakdown;
use App\Models\Random;
use Faker\Factory as Faker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $randomCount = Random::count();

        if($randomCount <= 0){
            return view('home')->with('status', 'warning');
        }else{
            return view('home');
        }
  
    }

    public function createSpiral() {
    

        if(Random::where('flag', false)->count() <= 30){

            $generatedNum = $this->randomNumber();
            
            for($i=0; $i <= $generatedNum; $i++){

                $random = Random::create([
                    'values' => $this->randomName(),
                    'flag' => false, //true if showed to user
                ]);

                for($j=0; $j <= $this->randomNumber(); $j++ ){
                    Breakdown::create([
                        'values' => $this->random_strings(5),
                        'random_id' => $random->id,
                    ]);
                }
            }


            
        return redirect('/')->with([
            'status' => 'success',
            'new_spiral' => $generatedNum
        ]);

        }
        else{
            return redirect('/home')->with('status', 'error');
        }


    }

    protected function randomNumber(){
       
            $randomNumber = rand(5, 10);

            //function randomizerNumber 5-10 () { }
            return $randomNumber;

    }

    protected function randomName(){

         $faker = Faker::create();
            //function randomizerName ex john1WASWS() { }
            return $faker->firstName;
    }


    protected function random_strings($length_of_string)
    {
 
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
    }
}
