<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use App\Models\Location;

class BookController extends Controller
{
    // Get functions 
    public function getBooks() {        
        $books = Book::join('locations', 'books.location_id', '=', 'locations.id')->orderBy('id')
        ->get(['books.id', 'call_number', 'books.title', 'author', 'books.created_at', 'books.author', 'books.language',
        'books.publisher', 'books.copyright', 'books.date_published','books.volume', 'books.pages', 'books.edition', 
        'books.remarks', 'books.main_copy', 'books.available', 'books.purchase_date', 'books.content', 'locations.location']);
        return $books;
    }

    public function getBook($id) {
        $book = Location::join('books', 'locations.id', '=', 'books.location_id')
        ->select('books.id', 'locations.location', 'books.call_number', 'books.title',  'books.copyright',
                'books.author', 'books.date_published','books.volume', 'books.pages', 'books.edition', 'books.remarks',
                'books.purchase_date')
        ->findOrFail($id);
        // return Book::find($id);
        return $book;
    }

    public function image($id) {
        $book = Book::find($id);

        // check if it has no image
        if($book->image_location == null)
            return response('No Image Found', 200);

        $image = 'app/public/' . $book->image_location;
        $path = storage_path($image);
        return response()->file($path);
    }

    public function add(Request $request) {
        
        // Validate image
        $request->validate([
            'image_location' => 'required|image|mimes:jpeg,png,jpg|max:4096', // Adjust the max size as needed
        ]);

        if($request->copies < 1) {
            return response('Error: Invalid number of copies', 400);
        } else {
            for($i = 0; $i < $request->copies; $i++) {

                $model = new Book();
                try {
                    
                    $model->fill($request->except(['id', 'main_copy', 'image_location']));
                    if($i > 0) {
                        $model->main_copy = false;
                        try {
                            if($request->id != null) {
                                $model->id = $request->id + $i;
                            }
                        } catch (Exception) {
                            // do something if needed
                        }
                    }

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
            }
        }

        $location = json_decode(Location::where('id', '=', $model->location_id)->get('location'))[0]->location;

        $log = new CatalogingLogController();

        if($request->copies == 1)
            $title = $model->title;
        else
            $title = $model->title . ' (' . $request->copies . ')';

        $log->add('Added', $title, 'book', $location);
        
        return response()->json($model, 201);
    }

    public function update(Request $request, $id) {
        $model = Book::findOrFail($id);

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

        
        $location = json_decode(Location::where('id', '=', $model->location_id)->get('location'))[0]->location;

        $log = new CatalogingLogController();
        $log->add('Updated', $model->title, 'book', $location);

        return response()->json($model, 200);
    }

    public function delete($id) {
        $model = Book::findOrFail($id);
        $model->delete();

        $location = json_decode(Location::where('id', '=', $model->location_id)->get('location'))[0]->location;

        $log = new CatalogingLogController();
        $log->add('Deleted', $model->title, 'book', $location);

        return response('Record Deleted', 200);
    }
}
