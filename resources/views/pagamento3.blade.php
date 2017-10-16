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

    <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="5CA51F6C7D7D5D9664091F9209D7543B" />
<input type="hidden" name="iot" value="button" />
<input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-comprar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->

            </div>

            </div>
            
             
        </div>

@endsection