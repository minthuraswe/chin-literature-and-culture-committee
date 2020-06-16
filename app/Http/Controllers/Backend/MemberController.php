<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\Phototitle;
use App\Responsible;
use App\University;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mem = Member::paginate(10);

        return view('member.index', compact('mem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = Responsible::orderBy('res_name')->get();
        $uni = University::orderBy('uni_name')->get();
        $photo = Phototitle::orderBy('photo_name')->get();
        return view('member.create', compact('uni', 'res', 'photo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->except());
        $this->validateData($request);

        $member = Member::create([
            'mem_name' => request('name'),
            'mem_email' => request('email'),
            'mem_phone' => request('phone'),
            'mem_age' => request('age'),
            'mem_address' => request('address'),
            'mem_description' => request('description'),
            'photo_id' => request('photo'),
            'res_id' => request('position'),
            'uni_id' => request('university'),
        ]);

        return redirect('member');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mem = Member::find($id);
        $uni = University::all();
        $res = Responsible::all();
        $photo = Phototitle::all();
        return view('member.show', compact('mem', 'uni', 'photo', 'res'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mem = Member::find($id);
        $uni = University::all();
        $res = Responsible::all();
        $photo = Phototitle::all();
        return view('member.edit', compact('mem', 'uni', 'res', 'photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mem = Member::find($id);
        $mem->fill($request->except('_token'));

        $mem->save();
        return redirect('member');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mem = Member::find($id)->delete();
        return redirect('member');
    }

    private function validateData($request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'age' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'position' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'university' => 'required',
        ]);
    }

}
