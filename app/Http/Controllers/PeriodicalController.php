<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodical;

class PeriodicalController extends Controller
{
    public function getPeriodicals() {
        return Periodical::all();
    }

    public function getByType($type) {
        return Periodical::where('material_type', $type)->get();
    }

    public function getPeriodical($id) {
        return Periodical::find($id);
    }

    public function image($id) {
        $Periodical = Periodical::find($id);

        // check if it has image
        if($Periodical->image_location == null)
            return response('', 200);

        $image = 'app/public/' . $Periodical->image_location;
        $path = storage_path($image);
        return response()->file($path);
    }
    
    public function add(Request $request) {
        // Validate image
        $request->validate([
            'image_location' => 'required|image|mimes:jpeg,png,jpg|max:4096', // Adjust the max size as needed
        ]);

        $model = new Periodical();
        try {
            $model->fill($request->except('image_location'));
        } catch (Exception) {
            return response()->json(['Error' => 'Invalid form request. Check values if on correct data format.', 400]);
        }

        $ext = $request->file('image_location')->extension();

        // Check file extension and raise error
        if (!in_array($ext, ['png', 'jpg', 'jpeg'])) {
            return response()->json(['Error' => 'Invalid image format. Only PNG, JPG, and JPEG formats are allowed.'], 415);
        }

        // Store image and save path
        $path = $request->file('image_location')->store('images', 'public');

        $model->image_location = $path;
        $model->save();
        
        $type = strtolower($model->material_type);
        $log = new CatalogingLogController();
        $log->add('Added', $model->title, $type, null);

        return response()->json($model, 201);
    }

    public function update(Request $request, $id) {
        // return response($request);
        $model = Periodical::findOrFail($id);
        // return response($model);

        try {
            $model->fill($request->except('image_location'));
        } catch (Exception) {
            return response()->json(['Error' => 'Invalid form request. Check values if on correct data format.', 400]);
        }

        if(!empty($request->image_location)) {
            $ext = $request->file('image_location')->extension();

            // Check file extension and raise error
            if (!in_array($ext, ['png', 'jpg', 'jpeg'])) {
                return response()->json(['Error' => 'Invalid image format. Only PNG, JPG, and JPEG formats are allowed.'], 415);
            }

            // Store image and save path
            $path = $request->file('image_location')->store('images', 'public');

            $model->image_location = $path;
        }

        $model->save();

        $type = strtolower($model->material_type);
        $log = new CatalogingLogController();
        $log->add('Updated', $model->title, $type, null);

        return response()->json($model, 200);
    }

    public function delete($id) {
        $model = Periodical::findOrFail($id);
        $model->delete();

        $type = strtolower($model->material_type);
        $log = new CatalogingLogController();
        $log->add('Deleted', $model->title, $type, null);

        return response('Record Deleted', 200);
    }
}
