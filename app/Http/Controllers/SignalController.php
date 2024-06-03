<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signal;

class SignalController extends Controller
{
    public function index(){
        return view('index');
    }

    public function store(Request $request){
          $validated_sequence = $request->validate([
            'red' => 'required|regex:/^[ABCD]$/|min:0|max:1',
            'yellow' => 'required|regex:/^[ABCD]$/|min:0|max:1',
            'green' => 'required|regex:/^[ABCD]$/|min:0|max:1',
            'orange' => 'required|regex:/^[ABCD]$/|min:0|max:1',
          ]);

          $interval_validation = $request->validate([
            'green_interval' => 'required|numeric',
            'yellow_interval' => 'required|numeric',
          ]);

          $signal = new Signal([
          'sequence' => implode(',',  $validated_sequence),
          'green_interval' => $interval_validation['green_interval'],
          'yellow_interval' => $interval_validation['yellow_interval']
          ]);

          $signal->save();

          return response()->json(['message' => 'Data save Sucessfully!']);
    }

    public function showSequence(Request $request){
       $records = Signal::latest()->first();

       if(!$records){
        return response()->json(['message' => 'No new sequence data found!'],404);
       }
       
       $sequence = explode(',', $records->sequence);

       if(count($sequence)< 4){
        return response()->json(['message' => 'Invalid sequence Data!'],400);

       }

       $recorded_sequence = [
        $sequence[0],
        $sequence[1],
        $sequence[2],
        $sequence[3],
       ];

       return response()->json(['sequence' => $recorded_sequence, 'record' => $records]);
    }
}
