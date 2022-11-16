<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tables=Table::all();
        return view('admin.tables.index',compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'guest_number'=>'required',
            'status'=>'required',
            'location'=>'required',
        ]);

        Table::create([
           'name'=>$request->name,
            'guest_number'=>$request->guest_number,
            'status'=>$request->status,
            'location'=>$request->location,
        ]);

        alert()->success('Success','Data Saved Successfully');
        return redirect()->route('admin.tables.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'guest_number'=>'required',
            'status'=>'required',
            'location'=>'required',
        ]);

        $table=Table::findOrFail($request->id);
        $table->update([

            'name'=>$request->name,
            'guest_number'=>$request->guest_number,
            'status'=>$request->status,
            'location'=>$request->location,

        ]);

        alert()->success('Success','Data Saved Successfully');
        return redirect()->route('admin.tables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $table=Table::findOrFail($request->id);
        $table->delete();
        alert()->warning('Success','Data Deleted Successfully');
        return redirect()->route('admin.tables.index');
    }
}
