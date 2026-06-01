<?php

namespace App\Http\Controllers\Api\V0;

use App\Http\Controllers\Controller;
use App\Models\GeneralOption;
use App\Models\Machine;

class MachineApiController extends Controller
{
    public function index()
    {
        $machines = Machine::query()
            ->where('is_active', true)
            ->whereNotNull('product_code')
            ->whereRaw('LOWER(product_code) != ?', ['geen'])
            ->orderBy('id', 'desc')
            ->get();

        $machines->transform(function ($machine) {
            $machineFolder = public_path(
                'storage/machines/' . $machine->product_code
            );

            $images = [];

            if (is_dir($machineFolder)) {
                $files = scandir($machineFolder);

                foreach ($files as $file) {
                    $extension = strtolower(
                        pathinfo($file, PATHINFO_EXTENSION)
                    );

                    if (
                        in_array($extension, [
                            'jpg',
                            'jpeg',
                            'png',
                            'webp',
                        ])
                    ) {
                        $images[] =
                            '/storage/machines/'
                            . $machine->product_code
                            . '/'
                            . $file;
                    }
                }
            }

            /*
             * |--------------------------------------------------------------------------
             * | Move main image to first position
             * |--------------------------------------------------------------------------
             */

            if ($machine->image) {
                $mainImage = '/storage/' . $machine->image;

                $images = array_values(array_filter(
                    $images,
                    function ($image) use ($mainImage) {
                        return $image !== $mainImage;
                    }
                ));

                array_unshift($images, $mainImage);
            }

            $machine->images = $images;

            return $machine;
        });

        return $machines;
    }

    /*
     * |--------------------------------------------------------------------------
     * | geef de categorieën mee aan de machine
     * |--------------------------------------------------------------------------
     */

    public function categories()
    {
        return GeneralOption::where('option_name', 'machine_categories')
            ->where('is_active', 1)
            ->where('is_excluded', 0)
            ->orderBy('id')
            ->get([
                'id',
                'title',
                'value',
                'lbl_text',
                'icon_image',
            ]);
    }

    public function show(Machine $machine)
    {
        return $machine;
    }
}
