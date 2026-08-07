<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminSliderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Move the file to public/images/sliders directory
            $destinationPath = public_path('images/sliders');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);

            $order = Slider::max('order') + 1;

            Slider::create([
                'image_path' => 'images/sliders/' . $imageName,
                'is_active' => true,
                'order' => $order
            ]);

            return redirect()->back()->with('success', 'Slider image uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload image.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        
        $imagePath = public_path($slider->image_path);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $slider->delete();

        return redirect()->back()->with('success', 'Slider image deleted successfully.');
    }
}
