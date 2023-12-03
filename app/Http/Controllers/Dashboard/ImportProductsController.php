<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\ImportProducts;
use dispatch;

class ImportProductsController extends Controller
{
    public function create(){
       return view('dashboard.products.import');
    }
    
    public function store( Request $request){
        ImportProducts::dispatch($request->post('count'))
        ->delay(now()->addSeconds(5))
        ->onQueue('import');

        return redirect()
            ->route('products.index')
            ->with('success', 'Import is runing...');
     }
}
