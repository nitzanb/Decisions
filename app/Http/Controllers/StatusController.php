<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Inertia\Inertia;


class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $statuses = Status::all();
        return Inertia::render('Admin/Statuses', [
            'statuses' => $statuses,
        ]);
    }
    
    public function store(Request $request)
    {
        Status::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if($request->has('id'))
        {
            Status::find($request->input('id'))->update($request->all());
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        if($request->has('id'))
        {
            Status::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }

}
