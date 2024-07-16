<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Report;

use App\Http\Requests\CreateData;


class ReportController extends Controller
{
    //
    public function create(int $id)
    {
        //
        
        return view('report.create',[
            'id' => $id,
        ]);
    }
    public function store(Request $request, $id)
    {
        $report = new Report();
        $report->user_id = Auth::id();
        $report->report = $request->input('report');
        $report->post_id = $id;
        $report->save();

        return redirect()->route('posts.index', ['report' => $id]);
    }
}
