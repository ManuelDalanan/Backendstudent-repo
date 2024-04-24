<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Exception;

class ArticleController extends Controller
{
    public function getArticles() {
        return Article::all();
    }

    public function getArticle($id) {
        return Article::find($id);
    }

    public function add(Request $request) {
        $model = new Article();

        try {
            $model->fill($request->all());
            $model->save();
    
            $log = new CatalogingLogController();
            $log->add('Added', $model->title, 'article', null);
    
            return response()->json($model, 200);
        } catch (Exception $e) {
            return response()->json(['Error' => 'Invalid form request. Check values if on correct data format.', 400]);
        }
    }

    public function update(Request $request, $id) {
        $model = Article::findOrFail($id);
        try {            
            $model->update($request->all());
            $model->save();

            $log = new CatalogingLogController();
            $log->add('Updated', $model->title, 'article', null);
    
            return response()->json($model, 200);
        } catch (Exception $e) {
            return response()->json(['Error' => 'Invalid form request. Check values if on correct data format.', 400]);
        }
    }
    
    public function delete($id) {
        $model = Article::findOrFail($id);
        $model->delete();

        $log = new CatalogingLogController();
        $log->add('Deleted', $model->title, 'article', null);

        return response('Record Deleted', 200);
    }
}
