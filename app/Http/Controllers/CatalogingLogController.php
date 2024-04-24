<?php

namespace App\Http\Controllers;

use App\Models\CatalogingLog;
use Illuminate\Http\Request;

class CatalogingLogController extends Controller
{
    public function get() {
        return CatalogingLog::all();
    }

    public function add(string $action, string $title, string $type, ?string $location) {
        if(in_array($type, ['book', 'thesis', 'dissertation', 'feasibility study'])) {
            if($action == 'Added')
                $pre = 'to';
            else
                $pre = 'from';
            $log = $action . ' \'' . $title . '\' ' . $type . ' ' . $pre . ' ' . $location;
        } else {
            $log = $action . ' \'' . $title . '\' ' . $type;
        }

        $model = CatalogingLog::create([
            'action' => $action,
            'log' => $log
        ]);
    }
}
