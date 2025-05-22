<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Harddisk;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HarddiskController extends Controller
{
    protected PdfService $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $harddisks = Harddisk::all();
        return view('dashboard.harddisks.index', compact('harddisks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $harddisks = Harddisk::all();
         $deviceBrands = Brands::all();
        return view('dashboard.harddisks.create', compact('harddisks','deviceBrands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brands_id'          => 'required|string|max:100',
            'health'         => 'required|in:Good,Warning,Critical',
            'interface'      => 'nullable|in:SATA,NVMe,SAS,PCIe',
            'capacity_gb'    => 'required|integer|min:0',
            'capacity_unit'  => 'required|in:GB,TB',
            'serial_number'  => 'required|string|unique:harddisks,serial_number',
            'pdf'            => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = [
            'brands_id'          => $validated['brands_id'],
            'health'         => $validated['health'],
            'interface'      => $validated['interface'],
            'capacity_gb'    => $validated['capacity_gb'],
            'capacity_unit'  => $validated['capacity_unit'],
            'serial_number'  => $validated['serial_number'],
        ];

        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('harddisks/pdfs', 'public');
        } else {
            $data['pdf'] = null;
        }

        Harddisk::create($data);

        session()->flash('success', 'Hard disk added successfully');
        return redirect()->route('harddisks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $harddisk = Harddisk::findOrFail($id);
        return view('dashboard.harddisks.show', compact('harddisk'));
    }

    /**
     * Print the specified resource as PDF.
     */
    public function print(string $id)
    {
        $harddisk = Harddisk::findOrFail($id);

        // توليد PDF جديد عبر TCPDF
        $html = view('dashboard.harddisks.pdf-template', [
            'harddisk' => $harddisk,
        ])->render();

        return $this->pdfService->outputHtml($html, "harddisk-{$id}.pdf");
    }

    /**
     * Download or display the stored PDF file.
     */
    public function download(string $id)
    {
        $harddisk = Harddisk::findOrFail($id);

        // تحقق من وجود الملف
        if (! $harddisk->pdf || ! Storage::disk('public')->exists($harddisk->pdf)) {
            abort(404, 'PDF not found');
        }

        $path = storage_path('app/public/' . $harddisk->pdf);

        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $harddisks = Harddisk::findOrFail($id);
        return view('dashboard.harddisks.edit', compact('harddisks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $harddisks = Harddisk::findOrFail($id);

   $validated = $request->validate([
        'brands_id'          => 'required|string|max:100'.$harddisks->id,
        'health'         => 'required|in:Good,Warning,Critical',
        'interface'      => 'nullable|in:SATA,NVMe,SAS,PCIe',
        'capacity_gb'    => 'required|integer|min:0',
        'capacity_unit'  => 'required|in:GB,TB',
        'serial_number'  => [
            'required',
            'string',
            Rule::unique('harddisks', 'serial_number')->ignore($harddisks->id),
        ],
        'pdf'            => 'nullable|file|mimes:pdf|max:5120',
    ]);

    $data = [
        'brands_id'          => $validated['brands_id'],
        'health'         => $validated['health'],
        'interface'      => $validated['interface'],
        'capacity_gb'    => $validated['capacity_gb'],
        'capacity_unit'  => $validated['capacity_unit'],
        'serial_number'  => $validated['serial_number'],
    ];


    if ($request->hasFile('pdf')) {
        // delete old PDF if exists
        if ($harddisks->pdf && Storage::disk('public')->exists($harddisks->pdf)) {
            Storage::disk('public')->delete($harddisks->pdf);
        }
        // store new PDF
        $data['pdf'] = $request->file('pdf')->store('harddisks/pdfs', 'public');
    } else {
        // if you want to allow “removing” the PDF via form checkbox, handle here;
        // otherwise, leave existing $harddisk->pdf untouched:
        $data['pdf'] = $harddisks->pdf;
    }



    // 5. حدّث السجل
    $harddisks->update($data);

      session()->flash('success', 'Hard disk updated successfully');
    return redirect()->route('harddisks.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Harddisk::findOrFail($id)->delete();
        session()->flash('delete', 'Deleted successfully');
        return redirect()->route('harddisks.index');
    }
}
