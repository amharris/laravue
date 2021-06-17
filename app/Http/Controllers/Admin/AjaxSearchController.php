<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionItem;

class AjaxSearchController extends Controller
{
    public function execute(Request $request)
    {
        $data = [];

        if($request->has('term')){
            $search = $request->term;
            $items = TransactionItem::where('name', 'LIKE', "%$search%")
                ->get(['id', 'name', 'price', 'description']);
            $data['results'] = $items;
            // $data['pagination'] = ['more' => false];
        }

        return response()->json($data);
    }
}