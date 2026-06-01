<?php

namespace App\Http\Controllers\Bpanel;

use App\Http\Controllers\Controller;
use App\Models\GeneralOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $option_name)
    {
        $options = GeneralOption::query()
            ->where('option_name', $option_name)
            ->orderBy('title')
            ->get();

        return view('bpanel.general-options.index', compact(
            'options',
            'option_name'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $option_name)
    {
        $icons = Storage::disk('public')->files('icons');
        $generalOption = new GeneralOption();

        $generalOption->new = true;

        $generalOption->option_name = $option_name;

        $generalOption->title = 'Nieuw item';

        $generalOption->value = 'nieuw_item';

        $generalOption->description = null;

        $generalOption->lbl_text = null;

        $generalOption->is_active = false;

        $generalOption->is_excluded = false;

        $generalOption->is_default = false;

         $generalOption->icon_image = 'icons/default.svg';
        return view('bpanel.general-options.edit', compact(
            'generalOption',
            'option_name',
            'icons'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $option_name)
    {
        GeneralOption::create([
            'option_name' => $option_name,
            'title' => $request->input('title'),
            'value' => $request->input('value'),
            'description' => $request->input('description'),
            'lbl_text' => $request->input('lbl_text'),
            'is_active' => $request->boolean('is_active'),
            'is_excluded' => $request->boolean('is_excluded'),
            'is_default' => $request->boolean('is_default'),
            'icon_image' => 'icons/default.svg',
        ]);

        return redirect()
            ->route('general-options.index', $option_name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        string $option_name,
               GeneralOption $generalOption
    ) {
        $icons = Storage::disk('public')->files('icons');

        return view('bpanel.general-options.edit', compact(
            'generalOption',
            'option_name',
            'icons'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        string $option_name,
        int $generalOption
    ) {
        $data = [
            'option_name' => $option_name,
            'title' => $request->input('title'),
            'value' => $request->input('value'),
            'description' => $request->input('description'),
            'lbl_text' => $request->input('lbl_text'),
            'icon_image' => $request->input('icon_image') ?: 'icons/default.svg',
            'is_active' => $request->boolean('is_active'),
            'is_excluded' => $request->boolean('is_excluded'),
            'is_default' => $request->boolean('is_default'),
        ];

        /*
         * |--------------------------------------------------------------------------
         * | New item
         * |--------------------------------------------------------------------------
         */

        if ($request->boolean('is_new')) {
            GeneralOption::create($data);
        }
        /*
         * |--------------------------------------------------------------------------
         * | Existing item
         * |--------------------------------------------------------------------------
         */ else {
            $option = GeneralOption::findOrFail($generalOption);

            $option->update($data);
        }

        return redirect()
            ->route('general-options.index', $option_name)
            ->with(
                'success',
                'Optie opgeslagen.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(
        string $option_name,
        GeneralOption $generalOption
    ) {
        $generalOption->delete();

        return redirect()
            ->route('general-options.index', $option_name);
    }
}
