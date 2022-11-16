<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $reservations=Reservation::all();
        $tables=Table::all();
        return view('admin.reservations.index',compact('reservations','tables'));
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

            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'tel_number'=>'required',
            'res_date'=>'required',
            'guest_number'=>'required',
            'table_id'=>'required',

        ]);

        Reservation::create([
           'first_name'=>$request->first_name,
           'last_name'=>$request->last_name,
           'email'=>$request->email,
           'res_date'=>$request->res_date,
           'guest_number'=>$request->guest_number,
           'phone'=>$request->tel_number,
            'table_id'=>$request->table_id,
        ]);

        alert()->success('Success','Data Saved Successfully');
        return redirect()->route('admin.reserv.index');
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

            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'tel_number'=>'required',
            'res_date'=>'required',
            'guest_number'=>'required',
            'table_id'=>'required',

        ]);

        $res=Reservation::findOrFail($request->id);


        $res->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'res_date'=>$request->res_date,
            'guest_number'=>$request->guest_number,
            'phone'=>$request->tel_number,
            'table_id'=>$request->table_id,
        ]);

        alert()->success('Success','Data Saved Successfully');
        return redirect()->route('admin.reserv.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $res=Reservation::findOrFail($request->id);
        $res->delete();
        alert()->success('Success','Data Deleted Successfully');
        return redirect()->route('admin.reserv.index');
    }
}
