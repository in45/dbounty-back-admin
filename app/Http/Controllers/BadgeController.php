<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\UserBadge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function index()
    {
        return Badge::paginate(10);
    }

    public function show($id)
    {
        return Badge::findOrFail($id);
    }

    public function store(Request $request)
    {
        $badge = new Badge();
        if($request->input('title')) $badge->title = $request->input('title');
        if($request->input('description')) $badge->description = $request->input('description');
        if($request->input('tokens')) $badge->tokens= $request->input('tokens');
        $badge->save();
        return $badge;
    }

    public function update(Request $request,$id)
    {
        $badge = Badge::findOrFail($id);
        if($request->input('title')) $badge->title = $request->input('title');
        if($request->input('description')) $badge->description = $request->input('description');
        if($request->input('tokens')) $badge->tokens= $request->input('tokens');
        $badge->save();
        return $badge;
    }
    public function destroy($id)
    {
        $badge = Badge::findOrfail($id);
        if($badge->delete()) return  true;
        return "Error while deleting";
    }


    public function updateAvatar($id, Request $request)
    {
        $badge = Badge::findOrFail($id);
        $badge->avatar = $request->file('img')->store('badges_avatar');
        $badge->save();
        return $badge;

    }

    public function getBadgesOfUser($id)
    {
        return UserBadge::where('user_id',$id)->with('badge')->get();
    }
}
