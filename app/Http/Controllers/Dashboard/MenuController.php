<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $menus=Menu::all();
        $categories=Category::all();
        return view('admin.menues.index',compact('menus','categories'));
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
           'img'=>'required',
           'price'=>'required',
           'description'=>'required',
        ]);

        if ($request->hasFile('img'))
        {
            $file=$request->img;
            $fileName=$file->getClientOriginalName();
            $file->storeAs('menus',$fileName,'uploads');
        }

        $menu=Menu::create([
           'name'=>$request->name,
           'desc'=>$request->description,
           'price'=>$request->price,
            'img'=>$fileName,
        ]);

        if ($request->has('categories'))
        {
            $menu->categories()->attach($request->categories);
        }

        Alert::alert('Success', 'Data Saved Successfully');
        return redirect()->route('admin.menues.index');

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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'img'=>'required',
            'price'=>'required',
            'description'=>'required',
        ]);
        $old=Menu::findOrFail($request->id)->img;
        if ($request->hasFile('img'))
        {
            Storage::disk('uploads')->delete('menus/'.$old);
            $file=$request->img;
            $fileName=$file->getClientOriginalName();
            $file->storeAs('menus',$fileName,'uploads');
        }
        $menu=Menu::findOrFail($request->id);
        $menu->update([
            'name'=>$request->name,
            'desc'=>$request->description,
            'price'=>$request->price,
            'img'=>$fileName,
        ]);

        if ($request->has('categories'))
        {
            $menu->categories()->sync($request->categories);
        }

        Alert::alert('Success', 'Data Saved Successfully');
        return redirect()->route('admin.menues.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $menu=Menu::findOrFail($request->id);
        Storage::disk('uploads')->delete('menus/'.$menu->img);
        $menu->categories()->detach();
        $menu->delete();

        Alert::alert('Success', 'Data Deleted Successfully');
        return redirect()->route('admin.menues.index');
    }
}
