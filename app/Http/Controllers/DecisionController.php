<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Decision;
use Inertia\Inertia;
use App\Models\Status;

class DecisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *  This is the main page handler, It will list all statuses.
     */
    public function index()
    {
        $decisions = Decision::all();
        $statuses = Status::all();
        return Inertia::render('Admin/Decisions', [
            'decisions' => $decisions,
            'statuses' => $statuses,
        ]);
    }
    
    public function store(Request $request)
    {
        Decision::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if($request->has('id'))
        {
            Decision::find($request->input('id'))->update($request->all());
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        if($request->has('id'))
        {
            Decision::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }

}
