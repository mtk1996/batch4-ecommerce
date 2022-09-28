<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::orderBy('id', 'desc')->get();
        return view('admin.supplier.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'phone' => "required",
            //'image' => "required|mimes:png,jpg"
        ]);

        $file = $request->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('images'), $file_name);

        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'image' => $file_name,
            'description' => $request->description
        ]);
        return redirect()->back()->with('success', 'Supplier Created Success');
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
        $data = Supplier::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Supplier Not Found');
        }
        return view('admin.supplier.edit', compact('data'));
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
        $request->validate([
            'name' => "required",
            'phone' => "required",
        ]);
        $data = Supplier::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Supplier Not Found');
        }

        $file = $request->file('image');

        if ($file) {
            File::delete(public_path('/images') . '/' . $data->image);
            $file = $request->file('image');
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $file_name);
        } else {
            $file_name = $data->image;
        }

        Supplier::where('id', $id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'description' => $request->description,
            'image' => $file_name,
        ]);
        return redirect()->back()->with('success', 'Supplier Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Supplier::find($id);
        File::delete(public_path('/images') . '/' . $data->image);
        Supplier::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Supplier Deleted');
    }
}
