<?php

namespace App\Http\Controllers\Bpanel;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use Illuminate\Http\Request;

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

    if (! in_array($sort, $allowedSorts)) {
        $sort = 'title';
    }

    if (! in_array($direction, ['asc', 'desc'])) {
        $direction = 'asc';
    }

    $machines = Machine::query()
        ->when($search, function ($query, $searchTerm) {

            $query->where(function ($query) use ($searchTerm) {

                $query->where('title', 'like', '%' . $searchTerm . '%')
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
    public function edit(Machine $machine)
    {
        return view('bpanel.machines.edit', compact(
            'machine'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Machine $machine)
    {
        $machine->update([
            'title' => $request->title,
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

        return redirect()
            ->route('machines.index')
            ->with(
                'success',
                'Machine verwijderd.'
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
}
