<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Duration;
use Illuminate\Support\Facades\DB;

class DurationController extends Controller
{
    

    public function index()
    {
        $durations = Duration::paginate(15);
        return view('admin.durations.index', compact('durations'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add()
    {
        return view('admin.durations.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required',
        ]);
        $requestData = $request->all();
        Duration::create($requestData);
        return redirect()->route('admin.durations.index')->with('success', 'Duration added successfully');

    }

    public function edit($id) {
        $duration = DB::table('durations')->where('id', $id)->first();
        return view('admin.durations.add', compact('duration'));
    }

    public function updateDuration(Request $request, $id) {
        $request->validate([
            'duration' => 'required',
        ]);
        $requestData = $request->all();
        $durationData = Duration::where('id', $id)->update(['duration' => $requestData['duration'], 'updated_at' => now()]);
        
        return redirect()->route('admin.durations.index')->with('success', 'Duration update successfully');
    }

    public function delete($id){
        DB::table('durations')->where('id', $id)->delete();
        return redirect()->back()->with('success','Duration Deleted!');
    }
}
