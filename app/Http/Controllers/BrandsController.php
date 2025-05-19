<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\DeviceBrands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {           $brands = Brands::with('deviceBrand')->get();
                // $brands= Brands::all();
                $deviceBrands= DeviceBrands::all();
                return view('dashboard.brands.index', compact('deviceBrands', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'serial_number' => 'required|string|unique:brands,serial_number',
'devicebrand_id' => 'required|integer|exists:devicebrands,id',
            'model' => 'required|string|max:255',
        ]);
        $b_exists = Brands::where('serial_number', $validatedData['serial_number'])->exists();

 if ($b_exists) {
            session()->flash('Error', 'The serial number already exists');
            return redirect('/brands');
        } else {
            Brands::create([
                'serial_number' => $validatedData['serial_number'],
                'devicebrand_id' => $validatedData['devicebrand_id'],
                'model' => $validatedData['model'],
            ]);
            session()->flash('Add', 'Add successful');
            return redirect('/brands');
        }    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
                return Brands::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
                 $id = $request->id;

        $validatedData = $request->validate([
            'serial_number' => 'required|string|unique:brands,serial_number,' . $id,
            'devicebrand_id' => 'required|string|max:255',
            'model' => 'required|string|max:255',
        ]);

        $brands = Brands::findOrFail($id);
        $brands->update([
            'serial_number' => $request->serial_number,
            'devicebrand_id' => $request->brand,
            'model' => $request->model,
        ]);

        session()->flash('edit', 'The section has been successfully modified');
        return redirect('/brands');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // $brand = Brands::findOrFail($id);
        // $brand->delete();

        // return response()->json(['message' => 'Brand deleted successfully']);

        $id=$request->id;
        Brands::find($id)->delete();
        session()->flash('delete', 'Deleted successfully');
        return redirect('/brands');
    }
}
