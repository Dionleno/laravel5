@extends('layout.master') 
 @section('content')
 
   <div class="container center-lp  foot bg " id="assine" ng-app="app" ng-controller="paymentController" ng-init="started_payment()">
            
            
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 tdwhite" style="padding:20px !important;height:auto !important;">
<div class="col-xs-12 col-sm-12 " id="tdwhite" >
                <h3>Pagamento.</h3>
                <hr>

<form onsubmit="return false;" id="usarCupom">
       {{ csrf_field() }}     

                <div class="input-group " style="max-width:300px;">
                    <input type="text" class="form-control" ng-model="cupom" id="exampleInputAmount" name="cupom" placeholder="Insira seu cupom de desconto">
                    <span class="input-group-btn">
                    <button type="button" ng-click="useCupom()" class="btn btn-default" >Inserir <img class="btnicn" src="/images/icns_btn02.png"/></button>
                </span>
                </div>
                </form>
                <hr>



         <div class="visible-xs">
         <div style="width:100%;padding:2px 0px;" >
             <strong>Curso</strong><span class="pull-right">Algoritmo do sucesso</span> 
         </div>
          <div style="width:100%;padding:2px 0px;">
           <strong>Valor</strong><span class="pull-right"> R$ @{{order.valor_curso}}</span>
         </div>
          <div style="width:100%;padding:2px 0px;" ng-if="order.estudante != ''">
           <strong>Desc. estudante (50%)</strong><span class="pull-right"> (-) R$ @{{order.estudante}}</span>
         </div>
          <div style="width:100%;padding:2px 0px;" ng-if="cupomcode != ''">
           <strong>Cupom de Desc.</strong><span class="pull-right">(-) R$ @{{order.cupom}}</span>
         </div>

          <div style="width:100%;background:#888;color:#FFF;padding:10px 5px;margin:10px 0;">
           <strong>Total</strong><span class="pull-right">R$ @{{order.total }}</span>
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
                                <td style="text-align:right;font-weight:bold;">R$ @{{order.valor_curso}}</td>
                            </tr>
                            <tr ng-if="order.estudante != ''">
                                <td colspan="" style="border:0px">&nbsp;</td>
                                <td style="font-weight:bold;">Desconto de estudante (50%)</td>
                                <td style="text-align:right;">(-) R$ @{{order.estudante}}</td>
                            </tr>
                            <tr ng-if="cupomcode != ''">
                                <td colspan="" style="border:0px">&nbsp;</td>
                                <td style="font-weight:bold;">Cupom de Desconto</td>
                                <td style="text-align:right;">(-) R$ @{{order.cupom}}</td>
                            </tr>
                            <tr>
                                <td colspan="" style="border:0px">&nbsp;</td>
                                <td style="font-weight:bold;font-size:18px;"><strong>Total</strong></td>
                                <td style="text-align:right;font-weight:bold;font-size:18px;">R$ @{{order.total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>


<div class="col-xs-12 col-sm-8 colum">


                <div class="form-base">


                    <form action="" method="POST" id="formularioDeCompra" class="form-horizontal" onsubmit="return false;" role="form">
                        {{ csrf_field() }}
                        <div class="informacaoDoCartao">

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="label-form">Nome do titular exatamente como está no cartão:</label>
                                    <input type="text" class="field-footer" name="titularCartao" ng-model="order.titularCartao" placeholder="Nome do titular">
                                </div>
                                <div class="col-sm-12">
                                    <label class="label-form">Quantidade de parcelas:</label>

                                    <select name="parcelas" id="input" class="field-footer" ng-model="order.parcelas" required="required">
                                                        <option value="1">Á vista</option>
                                                        <option value="2">2 Parcelas</option>
                                                        <option value="3">3 Parcelas</option>
                                                        <option value="4">4 Parcelas</option>
                                                        <option value="5">5 Parcelas</option>
                                                        <option value="6">6 Parcelas</option>                                                       
                                                </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="label-form">Número do cartão:</label>
                                    <input type="text" class="field-footer maskCC" name="ncartao" mask='9999 9999 9999 9999' ng-model="order.ncartao" placeholder="Número do cartão">
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-form">Validade do cartão:</label>
                                    <input type="text" class="field-footer maskValidade" ng-model="order.validade" mask='99/9999' name="validade" placeholder="00/0000">
                                </div>

                                <div class="col-sm-6">
                                    <label class="label-form">Código CVV: 
                                                       
                                                       </label><span class="glyphicon glyphicon-info-sign pull-right hidden"
                                        aria-hidden="true"></span>
                                    <input type="text" class="field-footer maskCvv" ng-model="order.cvv" mask='999' maxlength="3" name="cvv" placeholder="Código de segurança">
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <span>O valor pago pode ser devolvido em até sete dias antes do início do curso.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-default pull-right btn-lg" id="finalizar" ng-click="payment()">Finalizar <img class="btnicn" src="/images/icns_btn02.png"/></button>
                                    <p class="mensagemPagamento" style="color:#e73634;float: right;margin-right: 20px;"></p>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>


             <hr>
             <div class="text-center hidden">
                    <strong>Ou pague com o Pagseguro</strong>
<br>
           
             
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
             <hr>
            </div>

            </div>
            
             
        </div>

@endsection