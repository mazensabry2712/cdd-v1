<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('dashboard.companies.index', compact('companies'));
    }

    public function create()
    {
        // return view('companies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'web' => 'required|url',
            'email'   => 'required|email',
            'phone'   => 'required|string',
        ]);
if (Company::where('name', $validatedData['name'])->exists()) {
    session()->flash('Error', 'The name already exists');
    return redirect('/company');
}
        Company::create($validatedData);
 session()->flash('Add', 'Registration successful');
return redirect('/company');
    }


 public function update(Request $request)
     {


        $id = $request->id;

        $request->validate([
             'name'    => 'required|string|max:255'.$id,
             'web' => 'required|url',
            'email'   => 'required|email',
            'phone'   => 'required|string',
        ]);

        $Company = Company::find($id);
        $Company->update([
            'name' => $request->name,
            'web' => $request->web,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'company updated successfully!');
               return redirect('/company');

    }




    public function destroy(Request $request)
    {

          $id=$request->id;
    Company::find($id)->delete();
    session()->flash('delete', 'Deleted successfully');
        return redirect('/company');

    }




}
