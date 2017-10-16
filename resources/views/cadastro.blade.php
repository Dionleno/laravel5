 @extends('layout.master') 
 @section('content')
<div class="container center-lp foot bg" id="assine" ng-app="app" ng-controller="userController">

    

     
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 tdblack">
          <div class=" fp-auto-height-responsive bgParallax" data-speed="45" id="section-black">
            <div class="intro">
                    <h3 class="listheading">Turma limitada a 100 vagas.</h3><br/>
                    <ul class="list-group">
                    <li class="list-group-item">Aprenda a levantar investimento com a presidente da Gávea Angels e uma Shark do programa Shark Tank Brasil.</li>
                    <li class="list-group-item">Investidora com atuação nos principais fundos de investimento anjo do Brasil.</li>
                    <li class="list-group-item">Conteúdo baseado em método científico.</li>
                    <li class="list-group-item">Método pode ser aplicado ao seu dia a dia.</li>
                    <li class="list-group-item">Rede de empreendedores exclusiva para os alunos.</li>			  
                    </ul>			
                </div>
            </div> 
     </div>
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 tdwhite">
         <div class="form-footer" id="tdwhite">

            <div class="form-base">
                <form action="" method="POST" id="formCadastro" class="form-horizontal" onsubmit="return false;" role="form" enctype="multipart/form-data">
                    <h3>Faça sua inscrição agora.</h3>
                    <p class="faixa-preco" style="font-size:18px;">Início das aulas: 06 de novembro de 2017</p>
                    <p class="faixa-preco">R$ 2.995,00 (parcele em até 6x sem juros)</p>
                    
                    
                    <br>
                    {{ csrf_field() }}
                    <div class="label-form">SEU NOME</div>
                    <input tabindex="1" type="text" class="field-footer faker" ng-model="user.name" name="name" placeholder="Nome completo" maxlength="181" required="required">
                    <div class="label-form">SEU EMAIL</div>
                    <input tabindex="2" title="Insira seu endereço de e-mail" class="field-footer js-email faker" placeholder="ex: nome@email.com"
                        required="required" name="email" ng-model="user.email" type="email">

                    <div class="label-form">CPF</div>
                    <input type="hidden" name="documento" value="cpf">
                    <input tabindex="2" title="Insira seu cpf" class="field-footer maskCpf" placeholder="ex: 000.000.000-00" required="required"
                       ng-model="user.ndocumento" name="ndocumento" mask='999.999.999-99' maxlength="14" type="text">
                    <div class="label-form">TELEFONE</div>
                    <input tabindex="2" placeholder="ex: (99) 99999-9999" mask='(99) 99999-9999' class="field-footer" required="required" ng-model="user.telefone" name="telefone" type="telefone">

                    <div class="checkbox">
                        <label>
                         <input type="checkbox" name="studant" ng-model="user.studant" value="1">
                         Estudante
                     </label>
                    </div><br/>
                    <div class="label-form">CARTEIRINHA DE ESTUDANTE</div>
                    <input class="" name="file" type="file" ng-model="user.file" data-file="file">
                 <br/>
                    <button type="button" class="btn btn-default pull-right btn-lg" id="prosseguir" ng-click="registerUser()">Prosseguir <img class="btnicn" src="/images/icns_btn02.png"/></button>
                </form>



            </div>
        </div>
     </div>

 
  
</div>

@endsection




 



