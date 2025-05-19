<?php

namespace App\Http\Controllers;

use App\Models\Devicebrands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DevicebrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $devicebrands = Devicebrands::all();
        return view('dashboard.devicebrands.index', compact('devicebrands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $devicebrands = Devicebrands::all();
        return view('dashboard.devicebrands.create', compact('devicebrands'));
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name'  => 'required|string|max:255|unique:devicebrands,name',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = [
        'name' => $validatedData['name'],
    ];

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')
                                ->store('uploads', ['disk' => 'public']);
    }

    Devicebrands::create($data);

    session()->flash('Add', 'Brand registration successful');
    return redirect()->route('devicebrands.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return view('dashboard.devicebrands.show', compact('devicebrand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
       public function edit($id)
    {
        try{
            $devicebrands = Devicebrands::findOrFail($id);
        }catch(Exception $e){

            return redirect('/devicebrands')->with('error', 'Record not found!');
        }

       return view('dashboard.devicebrands.edit',compact('devicebrands'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $brand = Devicebrands::findOrFail($id);

    $validated = $request->validate([
        'name'  => 'required|string|max:255|unique:devicebrands,name,'.$brand->id,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = [
        'name' => $validated['name'],
    ];

    if ($request->hasFile('image')) {
        if ($brand->image) {
            \Storage::disk('public')->delete($brand->image);
        }
        $data['image'] = $request->file('image')
                               ->store('uploads', ['disk' => 'public']);
    }

    // 5. حدّث السجل
    $brand->update($data);

    session()->flash('Add', 'Registration successful.');
    return redirect()->route('devicebrands.index');
}

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Request $request)
    {
        $id=$request->id;
        Devicebrands::find($id)->delete();
        session()->flash('delete', 'Deleted successfully');
             return redirect('/devicebrands');
    }
}
