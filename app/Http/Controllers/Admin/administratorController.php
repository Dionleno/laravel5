<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Insteresse;

class administratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $orders = Order::where('status','Captured')->with('user')->get();        
         return view('admin.dashboard', compact('orders'));         
    }

    public function cadastros()
    {
         $users = User::paginate(30);         
         
         return view('admin.cadastros', compact('users'));         
    }

    public function ebook()
    {
         $users = Insteresse::paginate(50);        
         
         return view('admin.user_ebook', compact('users'));         
    }

    public function downloadcsv($tipo){
          $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=file.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
         "Expires" => "0"
       );
           
           switch ($tipo) {
               case 'cadastro':
                   $callback = $this->cadastroscsv();
                   break;
               case 'ebook':
                   $callback = $this->ebookcsv();
                   break;    
               
               default:
                   # code...
                   break;
           }
           
           
            return \Response::stream($callback, 200, $headers);
    }

   private function ebookcsv(){
        $reviews = Insteresse::All();
            $columns = ['Email', 'Telefone'];
   
            $callback = function() use ($reviews, $columns)
            {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns,';',' ');

                foreach($reviews as $review) {
                    fputcsv($file, [$review->email, $review->telefone],';',' ');
                }
                fclose($file);
            };

            return $callback;
   }
    private function cadastroscsv(){
         $reviews = User::All();
            $columns = ['Nome', 'Email', 'Telefone'];
   
            $callback = function() use ($reviews, $columns)
            {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns,';',' ');

                foreach($reviews as $review) {
                    fputcsv($file, [$review->name, $review->email, $review->telefone],';',' ');
                }
                fclose($file);
            };

            return $callback;
    }

   
}
