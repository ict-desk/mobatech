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

        $machines = Machine::query()

            ->when($search, function ($query, $search) {

                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('brand', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');

            })

            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('bpanel.machines.index', compact(
            'machines',
            'search'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bpanel.machines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        //
    }
}