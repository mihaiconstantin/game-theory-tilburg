<?php

namespace App\Http\Controllers;

class InstructionController extends Controller
{

    public function __construct()
    {
        $this->middleware('consent')->except(['start', 'end']);
    }



    public function start()
    {
        return view('instruction', ['data' => $this->InstructionLoader('instruction.start')]);
    }


    public function end()
    {
        return view('end', ['data' => $this->InstructionLoader('instruction.end')]);
    }


    public function announcement()
    {
        return view('instruction', ['data' => $this->InstructionLoader('instruction.game-overview-one')]);
    }


    public function practice()
    {
        $instruction = $this->InstructionLoader('instruction.practice');
        $instruction->url_parameters['gameNumber'] = 1;
        $instruction->url_parameters['phaseNumber'] = 1;
        return view('instruction', ['data' => $instruction]);
    }


    public function condition()
    {
        return view('instruction', ['data' => $this->InstructionLoader('instruction.game-overview-two')]);
    }


    public function newGame($gameNumber)
    {
        return 'stop';
        // $instruction = $this->InstructionLoader('instruction.new-game');
        // $instruction->url_parameters['gameNumber'] = $gameNumber;
        // $instruction->url_parameters['phaseNumber'] = 1;
        // return view('instruction', ['data' => $instruction]);
    }


    public function amazonCode()
    {
        return view('instruction', ['data' => $this->InstructionLoader('instruction.amazon-code')]);
    }

}


/**
 * TODO: Refactor the views from passing the values via properties to array keys.
 *
 */
































