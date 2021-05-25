<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use ApiResponser;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
       

    }

    
    public function index()
    {
  
        $users=User::all();

        return $this->validResponse($users);


    }


    public function store(Request $request)
    {

        $rules=[

            'name'=>'required|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed',
        ];

        $this->validate($request,$rules);

        $fields=$request->all();
        $fields['password']=Hash::make($request->password);

        $users=User::create($fields);

        return $this->successResponse($users,Response::HTTP_CREATED);


    }

    public function show($users)
    {

        
        $users=User::findOrFail($users);

        return $this->successResponse($users);



    }

    
    public function update(Request $request,$users)
    {
        
        $rules=[

            'name'=>'max:255',
            'email'=>'email|unique:users,email' . $user,
            'password'=>'min:8|confirmed',
        ];

        $this->validate($request,$rules);

        $users=User::findOrFail($user);

        $users->fill($request->all());

        if($request->has('password')){

            $user->password=Hash::make($request->password);

        }

        if($users->isClean()){

            return $this->errorResponse('At Least one value must change',Response::HTTP_UNPROCESSABLE_ENTITY);

        }else{

            $users->save();

            return $this->successResponse($users);

        }

        


    }

    public function destroy($user)
    {


    $users=User::findOrFail($user);

    $users->delete();

    return $this->successResponse($user);



    }


    //
}
