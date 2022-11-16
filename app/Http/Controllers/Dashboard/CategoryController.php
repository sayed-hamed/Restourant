<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.categories.index',compact('categories'));
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
           'desc'=>'required',
           'img'=>'required|image|mimes:jpg,png,svg,jpeg',
        ]);

        if ($request->hasFile('img'))
        {
            $file=$request->img;
            $fileName=$file->getClientOriginalName();
            $file->storeAs('categories',$fileName,'uploads');
        }

        Category::create([
           'name'=>$request->name,
           'desc'=>$request->desc,
            'img'=>$fileName,
        ]);

        Alert::alert('Success', 'Data Saved Successfully');
        return redirect()->route('admin.categories.index');


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
            'desc'=>'required',
            'img'=>'required|image|mimes:jpg,png,svg,jpeg',
        ]);

        $oldImg=Category::findOrFail($request->id)->img;
        if ($request->file('img'))
        {
            Storage::disk('uploads')->delete('categories/'.$oldImg);
            $file=$request->img;
            $fileName=$file->getClientOriginalName();
            $file->storeAs('categories',$fileName,'uploads');
        }
        $cat=Category::findOrFail($request->id);

        $cat->update([
            'name'=>$request->name,
            'desc'=>$request->desc,
            'img'=>$fileName,
        ]);

        alert()->success('Success','Data Updated Successfully');
        return redirect()->route('admin.categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $cat=Category::findOrFail($request->id);
        Storage::disk('uploads')->delete('categories/'.$cat->img);

        $cat->delete();
        alert()->warning('Success','Data Deleted Successfully');
        return redirect()->route('admin.categories.index');
    }
}
