<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        return Program::paginate(10);
    }

    public function show($id)
    {
        return Program::findOrFail($id);
    }

    public function store(Request $request)
    {

        $program = new Program();
        $program->name = $request->input('name');
        $program->company_id = $request->input('company_id');
        if($request->input('type')) $program->type = $request->input('type');
        if($request->file('logo')) $program->logo = $request->file('logo')->storeAs('programs', $request->logo->getClientOriginalName(), 'public');
        if($request->input('status')) $program->status = $request->input('status');
        if($request->input('min_bounty')) $program->min_bounty = $request->input('min_bounty');
        if($request->input('max_bounty')) $program->max_bounty = $request->input('max_bounty');
        if($request->input('begin_at')) $program->begin_at = $request->input('begin_at');
        if($request->input('finish_at')) $program->finish_at = $request->input('finish_at');
        if($request->input('range_response')) $program->range_response = $request->input('range_response');
        if($request->input('description')) $program->description = $request->input('description');
        if($request->input('scopes')) $program->scopes = $request->input('scopes');
        if($request->input('rules')) $program->rules = $request->input('rules');
        if($request->input('conditions')) $program->conditions = $request->input('conditions');
        $program->save();
        return $program;
    }

    public function update(Request $request,$id)
    {
        $program = Program::findOrFail($id);
        if($request->input('name')) $program->name = $request->input('name');
        if($request->input('company_id')) $program->company_id = $request->input('company_id');
        if($request->input('type')) $program->type = $request->input('type');
        if($request->file('logo')) $program->logo = $request->file('logo')->storeAs('programs', $request->logo->getClientOriginalName(), 'public');
        if($request->input('status')) $program->status = $request->input('status');
        if($request->input('min_bounty')) $program->min_bounty = $request->input('min_bounty');
        if($request->input('max_bounty')) $program->max_bounty = $request->input('max_bounty');
        if($request->input('begin_at')) $program->begin_at = $request->input('begin_at');
        if($request->input('finish_at')) $program->finish_at = $request->input('finish_at');
        if($request->input('range_response')) $program->range_response = $request->input('range_response');
        if($request->input('description')) $program->description = $request->input('description');
        if($request->input('scopes')) $program->scopes = $request->input('scopes');
        if($request->input('rules')) $program->rules = $request->input('rules');
        if($request->input('conditions')) $program->conditions = $request->input('conditions');
        $program->save();
        return $program;
    }
    public function destroy($id)
    {
        $program = Program::findOrfail($id);
        if($program->delete()) return  true;
        return "Error while deleting";
    }
}
