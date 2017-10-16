<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class loginController extends Controller
{
   public function index(){
        return view('admin.login');
    }

   public function logIn(Request $request){
             $this->validate($request, [          
                'name' => 'required',
                'password' => 'required'                                             
            ]);

            if($request->name == 'victor' && $request->password == '#Gaveta01'){
                 return redirect()->route('dashboard');
            }
          

             return redirect()->route('admin')->with('status', 'Book was added');

    }
}
