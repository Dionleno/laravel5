
@extends('admin.master') 
 @section('content')
           
          @section('title-h1','Baixaram o ebook')
     <div class="col-xs-12 col-sm-12 col-md-6" style="padding:33px 15px;border-bottom:1px solid #f1f1f1;margin-bottom:20px;">
           <a href="{{route('downloadcsv',['tipo'=>'ebook'])}}" class="btn btn-info pull-right">Download csv</a>
       </div>
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>                                    
                                    <th>Email</th>
                                    <th>Telefone</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users->items()) > 0)
                                @foreach($users->items() as $key => $user)
                                <tr>                                    
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->telefone}}</td>                                   
                                </tr>
                                @endforeach
                                @endif                                
                            </tbody>
                        </table>
                    </div>
                    
                  <div class="text-center">
                       
                  @if($users->hasMorePages())
                  <ul class="pagination pagination-sm">                                     
                      <li><a href="{{$users->previousPageUrl()}}">&laquo;</a></li>
                      @for ($i = 1; $i <= $users->lastPage(); $i++)
                         @if($users->currentPage() == $i) 
                             <li class="active"><a href="{{$users->url($i)}}">{{$i}}</a></li>                          
                         @else
                              <li><a href="{{$users->url($i)}}" >{{$i}}</a></li>
                         @endif
                     
                      @endfor                     
                      <li><a href="{{$users->nextPageUrl()}}">&raquo;</a></li>
                  </ul>
                  @endif
                  </div>
                  

               </div>
               
        

@endsection           