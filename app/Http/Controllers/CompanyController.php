<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyManager;
use App\Models\Manager;
use Illuminate\Http\Request;
use App\Mail\InviteManager;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class CompanyController extends Controller
{
    public function index()
    {
        return Company::withCount(['managers','programs'])->paginate(10);
    }

    public function show($id)
    {
        return Company::findOrFail($id);
    }
     public function getCodes($id)
    {
      $company = Company::findOrFail($id);
      $company = $company->makeVisible(['alpha_code', 'beta_code']);
       return $company;
    }

    public function store(Request $request)
    {
        $company = new Company();
        if($request->input('name')) $company->name = $request->input('name');
        if($request->input('website')) $company->website = $request->input('website');
        if($request->input('email')) $company->email = $request->input('email');
        if($request->input('phone')) $company->phone = $request->input('phone');
        if($request->input('description')) $company->description = $request->input('description');
         if($request->file('logo')) $company->logo = $request->file('logo')->storeAs('companies', $request->logo->getClientOriginalName(), 'public');
        $company->alpha_code = substr(strtoupper(chunk_split(Str::random(16), 4, '-')),0,-1);
        $company->beta_code = substr(strtoupper(chunk_split(Str::random(16), 4, '-')),0,-1);
        $company->save();
        $password = substr(strtoupper(Str::random(12)),0,-1);
        $manager = new Manager();
        $manager->username = 'Manager-'.substr(strtoupper(Str::random(4)),0,-1);
        $manager->email = $company->email;
        $manager->public_address = "";
        $manager->role = 'sysalpha';
        $manager->password = bcrypt($password);
        $manager->save();
        $details = [
            'email' => $company->email,
            'password' => $password,
            'role' => $manager->role,
            'company' => $company->name,
        ];
        $cm = new CompanyManager();
        $cm->company_id = $company->id;
        $cm->manager_id = $manager->id;
        $cm->save();
        Mail::to($company->email)->send(new inviteManager($details));
        return $company;
    }

    public function update(Request $request,$id)
    {
        $company = Company::findOrFail($id);
        if($request->input('name')) $company->name = $request->input('name');
        if($request->input('website')) $company->website = $request->input('website');
        if($request->input('email')) $company->email = $request->input('email');
        if($request->input('phone')) $company->phone = $request->input('phone');
        if($request->input('description')) $company->description = $request->input('description');
         if($request->file('logo')) $company->logo = $request->file('logo')->storeAs('companies', $request->logo->getClientOriginalName(), 'public');
        $company->save();
        return $company;
    }
    public function generate(Request $request,$id)
    {
        $company = Company::findOrFail($id);
       if($request->input('type') == 'alpha_code') $company->alpha_code = substr(strtoupper(chunk_split(Str::random(16), 4, '-')),0,-1);
       else $company->beta_code = substr(strtoupper(chunk_split(Str::random(16), 4, '-')),0,-1);
        $company->save();
        $company = $company->makeVisible(['alpha_code', 'beta_code']);
       return $company;
    }


    public function destroy($id)
    {
        $company = Company::findOrfail($id);
        if($company->delete()) return  true;
        return "Error while deleting";
    }

    public function getManagers($id)
    {
        return CompanyManager::with('manager')->where('company_id',$id)->get();
    }


    public function addManager(Request $request,$id)
    {
        $company = new CompanyManager();
        $company->company_id = $id;
        $company->manager_id = $request->input('manager_id');
        $company->save();
        return $company;
    }
    public function deleteManager($id, $manager_id)
    {
        $company_manager = CompanyManager::where('manager_id',$manager_id)
            ->where('company_id',$id);
        if($company_manager->delete()) return  true;
        return "Error while deleting";
    }

 
}
