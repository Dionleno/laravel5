@extends('layout.master') 
 @section('content')
 <style>
body{
    background: url('/images/contbg02.jpg') no-repeat;
    background-size: auto auto;
    background-size: cover;

}

 </style>
   <div class="container center-lp  foot bg " id="assine" ng-app="app" ng-controller="paymentController" ng-init="started_payment()">
            
            
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 tdwhite" style="padding:20px 20px 90px 20px !important;height:auto !important;">
<div class="col-xs-12 col-sm-12 " id="tdwhite" >
                <h3>Pagamento.</h3>
                <hr>

<form onsubmit="return false;" id="usarCupom" class="hidden">
       {{ csrf_field() }}     

                <div class="input-group " style="max-width:300px;">
                    <input type="text" class="form-control" ng-model="cupom" id="exampleInputAmount" name="cupom" placeholder="Insira seu cupom de desconto">
                    <span class="input-group-btn">
                    <button type="button" ng-click="useCupom()" class="btn btn-default" >Inserir <img class="btnicn" src="/images/icns_btn02.png"/></button>
                </span>
                </div>
                </form>
             



         <div class="visible-xs">
         <div style="width:100%;padding:2px 0px;" >
             <strong>Curso</strong><span class="pull-right">Algoritmo do sucesso</span> 
         </div>
          <div style="width:100%;padding:2px 0px;">
           <strong>Valor</strong><span class="pull-right"> R$ 995,00</span>
         </div>            
          
         </div>


                <div class="table-responsive payment hidden-xs">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="40%">Curso</th>
                                <th>&nbsp;</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" style="border-bottom:1px solid #ddd;font-weight:bold;">Algoritmo do sucesso</td>
                                <td style="text-align:right;font-weight:bold;">R$ 995,00</td>
                            </tr>                           
                        </tbody>
                    </table>
                </div>
                <hr>

                
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="PTF6PBA3MF3GC">
<input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">
<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
</form>
            </div>

            </div>
            
             
        </div>

@endsection


