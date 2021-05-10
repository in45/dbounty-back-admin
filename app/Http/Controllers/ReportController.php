<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return Report::paginate(10);
    }

    public function show($id)
    {
        return Report::findOrFail($id);
    }

    public function store(Request $request)
    {

        $report = new Report();
        if($request->input('target')) $report->target = $request->input('target');
        if($request->input('vuln_id')) $report->vuln_id = $request->input('vuln_id');
        if($request->input('user_id')) $report->user_id = $request->input('user_id');
        if($request->input('prog_id')) $report->prog_id = $request->input('prog_id');
        if($request->input('vuln_name')) $report->vuln_name = $request->input('vuln_name');
        if($request->input('vuln_details')) $report->vuln_details = $request->input('vuln_details');
        if($request->input('validation_steps')) $report->validation_steps = $request->input('validation_steps');
        if($request->input('severity')) $report->severity = $request->input('severity');
        if($request->file('file_upload')) $report->file_upload = $request->file('file_upload')->storeAs('Reports', $request->file_upload->getClientOriginalName(), 'public');
        if($request->input('status')) $report->status = $request->input('status');
        if($request->input('bounty_win')) $report->bounty_win = $request->input('bounty_win');
        if($request->input('status')) $report->status = $request->input('status');
        $report->save();
        return $report;
    }

    public function update(Request $request,$id)
    {
        $report = Report::findOrFail($id);
        if($request->input('target')) $report->target = $request->input('target');
        if($request->input('vuln_id')) $report->vuln_id = $request->input('vuln_id');
        if($request->input('user_id')) $report->user_id = $request->input('user_id');
        if($request->input('prog_id')) $report->prog_id = $request->input('prog_id');
        if($request->input('vuln_name')) $report->vuln_name = $request->input('vuln_name');
        if($request->input('vuln_details')) $report->vuln_details = $request->input('vuln_details');
        if($request->input('validation_steps')) $report->validation_steps = $request->input('validation_steps');
        if($request->input('severity')) $report->severity = $request->input('severity');
        if($request->file('file_upload')) $report->file_upload = $request->file('file_upload')->storeAs('Reports', $request->file_upload->getClientOriginalName(), 'public');
        if($request->input('status')) $report->status = $request->input('status');
        if($request->input('bounty_win')) $report->bounty_win = $request->input('bounty_win');
        if($request->input('status')) $report->status = $request->input('status');
        $report->save();
        return $report;
    }
    public function destroy($id)
    {
        $report = Report::findOrfail($id);
        if($report->delete()) return  true;
        return "Error while deleting";
    }
}
