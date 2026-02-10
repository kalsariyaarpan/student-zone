<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CoverGenerator
{
    public static function generate($title, $type)
    {
        // Create Image Manager (v3 correct)
        $manager = new ImageManager(new Driver());

        $width  = 800;
        $height = 450;

        // Create canvas with background color
        $img = $manager->create($width, $height)->fill('#0f172a');

        // Title text
        $img->text(strtoupper($title), $width / 2, $height / 2 - 20, function ($font) {
            $font->file(public_path('assets/fonts/Poppins-Bold.ttf'));
            $font->size(40);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('middle');
        });

        // Resource type text
        $img->text(strtoupper($type), $width / 2, $height / 2 + 40, function ($font) {
            $font->file(public_path('assets/fonts/Poppins-Regular.ttf'));
            $font->size(24);
            $font->color('#38bdf8');
            $font->align('center');
            $font->valign('middle');
        });

        // Save image
        $path = 'covers/' . uniqid() . '.jpg';
        $img->save(storage_path('app/public/' . $path));

        return $path;
    }
}
