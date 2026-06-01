<?php

namespace App\Http\Controllers\Bpanel;

use App\Http\Controllers\Controller;
use App\Models\GeneralOption;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $allowedSorts = [
            'title',
            'brand',
            'category',
            'condition',
            'material',
            'year',
            'stock_status',
            'is_active',
            'is_featured',
        ];

        $sort = request('sort', 'title');
        $direction = request('direction', 'asc');

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'title';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $machines = Machine::query()
            ->when($search, function ($query, $searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query
                        ->where('title', 'like', '%' . $searchTerm . '%')
                        ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                        ->orWhere('category', 'like', '%' . $searchTerm . '%');
                });
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('bpanel.machines.index', compact(
            'machines',
            'search',
            'sort',
            'direction'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $machine = Machine::create([
            'title' => 'Nieuwe machine',
            'product_code' => 'geen',
            'short_description' => '',
            'description' => '',
            'extra_info' => '',
            'brand' => '',
            'category' => '',
            'condition' => '',
            'material' => '',
            'year' => null,
            'stock_status' => '',
            'is_active' => false,
            'is_featured' => false,
        ]);

        return redirect()->route('machines.edit', $machine);
    }

    /**
     * Display the specified resource.
     */
    public function show(Machine $machine)
    {
        return view('bpanel.machines.show', compact(
            'machine'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
/**
 * Show the form for editing the specified resource.
 */
public function edit(Machine $machine)
{
    $folderFiles = [];

    $productCode = trim($machine->product_code);

    if (
        $productCode !== '' &&
        strtolower($productCode) !== 'geen'
    ) {
        $folderFiles = Storage::disk('public')->files(
            'machines/' . $productCode
        );
    }

    $categories = GeneralOption::where('option_name', 'machine_categories')
       ->where('is_active', 1)
       ->orderBy('title')
        ->get();

    $brands = GeneralOption::where('option_name', 'machine_brands')
       ->where('is_active', 1)
        ->orderBy('title')
        ->get();

    $conditions = GeneralOption::where('option_name', 'machine_conditions')
      ->where('is_active', 1)
        ->orderBy('title')
        ->get();

    $materials = GeneralOption::where('option_name', 'machine_suitable_for')
       ->where('is_active', 1)
        ->orderBy('title')
        ->get();

    $stockStatuses = GeneralOption::where('option_name', 'machine_stock_statuses')
      ->where('is_active', 1)
        ->orderBy('title')
        ->get();
    
    $years = GeneralOption::where('option_name', 'machine_years')
    ->where('is_active', 1)
    ->orderBy('title')
    ->get();

    return view('bpanel.machines.edit', compact(
        'machine',
        'folderFiles',
        'categories',
        'brands',
        'conditions',
        'materials',
        'stockStatuses',
        'years',
    ));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Machine $machine)
    {
        $productCode = trim($request->product_code);

        $machine->update([
            'title' => $request->title,
            'product_code' => $productCode,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'extra_info' => $request->extra_info,
            'brand' => $request->brand,
            'category' => $request->category,
            'condition' => $request->condition,
            'material' => $request->material,
            'year' => $request->year,
            'stock_status' => $request->stock_status,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        if (
            $productCode !== '' &&
            strtolower($productCode) !== 'geen'
        ) {
            Storage::disk('public')->makeDirectory(
                'machines/' . $productCode
            );
        }

        return redirect()
            ->route('machines.edit', $machine)
            ->with(
                'success',
                'Machine succesvol opgeslagen.'
            );
    }

    /**
     * Copy the specified machine.
     */
    public function copy(Machine $machine)
    {
        $newMachine = $machine->replicate();

        $newMachine->title = $machine->title . ' (Copy)';
        $newMachine->product_code = 'geen';
        $newMachine->is_active = false;
        $newMachine->is_featured = false;

        $newMachine->save();

        return redirect()->route(
            'machines.edit',
            $newMachine
        );
    }

    /**
     * Show delete confirmation.
     */
    public function delete(Machine $machine)
    {
        return view('bpanel.machines.delete', compact(
            'machine'
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        $machine->delete();

        return redirect(
            route('machines.edit', $machine) . '?#tab-filess'
        )->with(
            'success',
            'Bestand verwijderd.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // not used, because we create a machine in the
        // create() method and then redirect to the
        // edit() method where we can update the machine with the form data
    }

    public function uploadFile(Request $request, Machine $machine)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:10240',
            ],
        ]);

        $productCode = trim($machine->product_code);

        if (
            $productCode === '' ||
            strtolower($productCode) === 'geen'
        ) {
            return redirect()
                ->route('machines.edit', $machine)
                ->with(
                    'error',
                    'Geen geldige productcode.'
                );
        }

        $file = $request->file('file');

        $file->storeAs(
            'machines/' . $productCode,
            $file->getClientOriginalName(),
            'public'
        );

        return redirect()
            ->route(
                'machines.edit',
                $machine
            )
            ->with(
                'success',
                'Bestand succesvol geüpload.'
            );
    }

    public function deleteFile(Request $request, Machine $machine)
    {
        $request->validate([
            'file' => ['required', 'string'],
        ]);

        $productCode = trim($machine->product_code);

        $filePath = 'machines/' . $productCode . '/' . $request->file;

        if (
            Storage::disk('public')->exists($filePath)
        ) {
            Storage::disk('public')->delete($filePath);
        }

        return redirect()
            ->route(
                'machines.edit',
                $machine
            )
            ->with(
                'success',
                'Bestand verwijderd.'
            );
    }

    public function renameFile(Request $request, Machine $machine)
    {
        $oldFile = $request->input('old_file');
        $newFile = $request->input('new_file');

        if (!$oldFile || !$newFile) {
            return back();
        }

        /*
         * |--------------------------------------------------------------------------
         * | Keep original extension
         * |--------------------------------------------------------------------------
         */

        $newFile =
            pathinfo($newFile, PATHINFO_FILENAME)
            . '.'
            . pathinfo($oldFile, PATHINFO_EXTENSION);

        $folder = 'machines/' . $machine->product_code;

        $oldPath = $folder . '/' . $oldFile;
        $newPath = $folder . '/' . $newFile;

        if (!Storage::disk('public')->exists($oldPath)) {
            return back();
        }

        Storage::disk('public')->move(
            $oldPath,
            $newPath
        );

        /*
         * |--------------------------------------------------------------------------
         * | Update main image if needed
         * |--------------------------------------------------------------------------
         */

        if ($machine->image === $oldPath) {
            $machine->image = $newPath;
            $machine->save();
        }

        return redirect(
            route('machines.edit', $machine)
            . '?tab=files#tab-files'
        )->with(
            'success',
            'Bestand hernoemd.'
        );
    }

    public function setmainimage(Request $request, Machine $machine)
    {
        $file = $request->input('file');

        if (!$file) {
            return redirect()
                ->route('machines.edit', $machine)
                ->with('error', 'Geen bestand geselecteerd.');
        }

        $productCode = trim($machine->product_code);

        $filePath = 'machines/' . $productCode . '/' . $file;

        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()
                ->route('machines.edit', $machine)
                ->with('error', 'Bestand niet gevonden.');
        }

        $machine->image = $filePath;
        $machine->save();

        return redirect(
            route('machines.edit', $machine)
            . '?tab=files#tab-files'
        )->with(
            'success',
            'Hoofdafbeelding ingesteld.'
        );
    }
}
