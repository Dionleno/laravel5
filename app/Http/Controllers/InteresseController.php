<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\EmailSend;
use App\Http\Requests;
use App\Insteresse;
use App\Jobs\EmailEbook;

class InteresseController extends Controller
{
    
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             
        Insteresse::create($request->all());

         $MsgReturno = ['status'=>0,'message'=>'cadastrado com sucesso!'];
        return response($MsgReturno)->header('Content-Type', 'application/json');    
    }

    public function ebook(Request $request)
    {
             
        Insteresse::create($request->all());
      

        $this->dispatch(new EmailEbook($request->email));
         
         $MsgReturno = ['status'=>0,'message'=>'cadastrado com sucesso!'];
        return response($MsgReturno)->header('Content-Type', 'application/json');    
    }

    
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
