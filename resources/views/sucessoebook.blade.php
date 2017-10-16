@extends('layout.master') 
 @section('content')
 <script src="/js/core.min.js"></script>
 <script>
 $(function(){
     console.log('item');
     fbq('track', 'Lead');
 }); 
     
 </script>
        <div class="container center-lp foot bg" id="assine">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 tdblack thankyou text-center" style="color:#FFF;">
                    <h1 style="text-align:center;">Cadastrado com sucesso!</h1><br>                
                     <br>
                     
                     <a href="http://algoritmodosucesso.com.br/" class="btn btn-default btn-lg" id="prosseguir" >Voltar <img class="btnicn" src="/images/icns_btn02.png"/></a>
                     
                     <br>                    
 
        </div>                      
        </div>
         
@endsection