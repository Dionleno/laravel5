
@extends('admin.master') 
 @section('content')
           
          @section('title-h1','Pagamentos')

                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Bandeira</th>
                                    <th>Parcela</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($orders) > 0)
                                @foreach($orders as $key => $order)
                                <tr>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->bandeira}}</td>
                                    <td>{{$order->parcelas}}</td>
                                    <td>R$ {{$order->formatted_price}}</td>
                                </tr>
                                @endforeach
                                @endif                                
                            </tbody>
                        </table>
                    </div>
                    
               </div>
               
        

@endsection           