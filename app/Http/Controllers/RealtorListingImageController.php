<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);

        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(Listing $listing, Request $request)
    {
        if ($request->hasFile('images')) {
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'mimes:jpg,png,jpeg,webp|max:5000',
            ], [
                'images.*.mimes' => 'The file should be in one of the formats: jpg, png, jpeg, webp',
            ]);

            /** @var array<int, UploadedFile> $files */
            $files = $request->file('images');
            foreach ($files as $file) {
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path,
                ]));
            }
        }

        return redirect()->back()->with('success', 'Images uploaded!');
    }

    public function destroy(ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image was deleted!');
    }
}
