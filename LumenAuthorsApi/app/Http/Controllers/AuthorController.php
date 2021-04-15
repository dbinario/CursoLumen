<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Author;

class AuthorController extends Controller
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
        $authors=Author::all();
        return $this->successResponse($authors);
    }


    public function store(Request $request)
    {

        $rules=[

            'name'=>'required|max:255',
            'gender'=>'required|max:255|in:male,female',
            'country'=>'required|max:225',
        ];

        $this->validate($request,$rules);

        $author=Author::create($request->all());

        return $this->successResponse($author,Response::HTTP_CREATED);

    }

    public function show($author)
    {


        $author=Author::findOrFail($author);

        return $this->successResponse($author);

    }

    
    public function update(Request $request,$author)
    {

        $rules=[

            'name'=>'max:255',
            'gender'=>'max:255|in:male,female',
            'country'=>'max:225',
        ];

        $this->validate($request,$rules);

        $author=Author::findOrFail($author);

        $author->fill($request->all());

        if($author->isClean()){

            return $this->errorResponse('At Least one value must change',Response::HTTP_UNPROCESSABLE_ENTITY);

        }else{

            $author->save();

            return $this->successResponse($author);

        }

        



    }

    public function destroy($author)
    {



    $author=Author::findOrFail($author);

    $author->delete();

    return $this->successResponse($author);



    }


}
