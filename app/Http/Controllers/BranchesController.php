<?php

namespace App\Http\Controllers;

use App\Models\branches;
use App\Models\company;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $branches = Branches::all();
          $companies = company::all();
        return view('dashboard.branches.index', compact('branches', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = company::all();
        return view('dashboard.branches.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
      public function store(Request $request)
    {
        $validatedData = $request->validate(
            [

                'compony_id'        => 'required|string|max:255',
                'name'        => 'required|string|max:255',
           'br_location' => 'required|string|max:255',
            'country'     => 'required|string|max:100',
            'city'        => 'required|string|max:100',
            'phone'       => 'required|string',
        ]);
if (Branches::where('name', $validatedData['name'])->exists()) {
    session()->flash('Error', 'The name already exists');
    return redirect('/branches');
}
        Branches::create($validatedData);
 session()->flash('Add', 'Registration successful');
return redirect('/branches');
    }

    /**
     * Display the specified resource.
     */
    public function show(branches $branches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(branches $branches)
    {
         $companies = company::all();
        return view('dashboard.branches.create', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request)
     {


        $id = $request->id;

        $request->validate([
            'compony_id'=> 'required|string|max:255'.$id,
            'name' => 'required|string|max:255'.$id,
            'br_location' => 'required|string|max:255',
            'country'  => 'required|string|max:100',
            'city'  => 'required|string|max:100',
            'phone'  => 'required|string',
        ]);

        $Branches = Branches::find($id);
        $Branches->update([
            'compony_id' => $request->compony_id,
            'name' => $request->name,
            'br_location' => $request->br_location,
            'country' => $request->country,
            'city' => $request->city,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'updated successfully!');
               return redirect('/branches');

    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Request $request)
    {

    $id=$request->id;
    Branches::find($id)->delete();
    session()->flash('delete', 'Deleted successfully');
        return redirect('/branches');

    }
}
