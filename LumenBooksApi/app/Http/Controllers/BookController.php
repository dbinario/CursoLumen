<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Book;

class BookController extends Controller
{

    use ApiResponser;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    
    public function index()
    {
  


    }


    public function store(Request $request)
    {

    }

    public function show($book)
    {


    }

    
    public function update(Request $request,$book)
    {

    }

    public function destroy($book)
    {


    }


    //
}
