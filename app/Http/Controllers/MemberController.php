<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
  public function index()
  {
    $members = Member::orderBy('no', 'asc')->get();
    return response()->json($members);
  }

  public function show($id)
  {
    $member = Member::where('no', $id)->firstOrFail();
    return response()->json($member);
  }
    
  public function store(Request $request)
  {
      $member = new Member;
      $member->nama = $request->nama;
      $member->nim = $request->nim;
      $member->email = $request->email;
      $member->save();
      return response()->json($request);
  }

  public function update(Request $request, $id)
  {
      $member = Member::where('no', $id);
      $member->update([
        'nama' => $request->nama,
        'nim' => $request->nim,
        'email' => $request->email        
      ]);
      return response()->json($request);
  }
  
  public function destroy($id)
  {
    $member = Member::where('no', $id)->delete();
    return response()->json("ok");
  }
}
