
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,maximum-scale=1">
       <title>O Algoritmo do Sucesso</title>
	<meta name="author" content="Rodrigo Simões" />
	<meta name="description" content="O método científico para criar empresas e resolver problemas de mercado." />

      <!-- Bootstrap CSS -->
    <link href="/css/core.min.css" rel="stylesheet">    
    <link href="https://fonts.googleapis.com/css?family=PT+Mono|PT+Sans:400,400i,700,700i" rel="stylesheet">
    <link href="/css/pagamento.css" rel="stylesheet">
    <link href="/css/algo_style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1285375251566977'); 
        fbq('track', 'PageView');
        </script>
        <noscript>
        <img height="1" width="1" 
        src="https://www.facebook.com/tr?id=1285375251566977&ev=PageView
        &noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
    </head>
    <body>
     
<div class="modal fade" tabindex="-1" role="dialog" id="modalebook">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center" style="padding-top: 40px">
       <img src="/images/icns_enviado.png" />
       <h3>Verifique sua caixa de entrada.</h3>
        <p>Você vai receber um email com o link para fazer o download do conteúdo completo.</p>
      </div>
      <div class="modal-footer" style="text-align: center !important;">
        <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
     <section class="div-more base" id="main-assine">
     <div class="logo-pagamento text-center" style="">
     <a href="/#firstPage" ><img src="/images/logomin_algsuc02.png" class=" text-center" style="width:100%;max-width:400px;"/></a>
     </div>
        
          @yield('content')
    </section>
       
 

<div class="section fp-auto-height-responsive hidden" id="bio_ep_content">
		<div class="intro">		
			<h3>Faça o download GRATUITO do ebook do curso.</h3>
			<p>Aprenda as técnicas do Algoritmo do Sucesso e comece a aplicar no seu negócio. Tenha acesso ao conteúdo completo do ebook sem pagar nada. Informe seu email e whatsapp abaixo e fique sempre atualizado.</p>				
			<form onsubmit="save_ebook(this);return false;">
			  <div class="form-group">
				<input type="email" class="form-control input-lg" id="email3" name="email" placeholder="Insira o email que você acessa constantemente">
			  </div>
              <div class="form-group">
				<input type="telefone" class="form-control input-lg" name="telefone" id="emailss" placeholder="Insira seu Whatsapp">
			  </div>
               {{ csrf_field() }}   
			  <input type="hidden" name="formulario" value="ebook">
			  <button type="submit" class="btn btn-lg btn-default" >Quero meu eBook <img class="btnicn" src="/images/icns_btn02.png"/></button>
			</form>
		</div>
	</div>	


        <!-- jQuery AND Bootstrap JavaScript -->
        <script src="/js/core.min.js"></script>
        <script src="/js/jquery.maskedinput.js"></script>
        <!-- <script src="/js/bioep.js"></script>
        <script src="/js/exitpop.js"></script>-->
        <script type="text/javascript" src="/js/scripts-cadastro.js"></script>

         <!-- # APP DEPEDENCIES -->        
         <script src="/js/angular/lib/angular.min.js"></script>
         <script src="/js/angular/lib/ngMask.min.js"></script>       
         
          <script src="/js/angular/app.js"></script>
          <script src="/js/angular/lib/angular-locale_pt-br.js"></script>          
          <script src="/js/angular/services/sistema.service.js"></script>                     
          <script src="/js/angular/controllers/paymentController.js"></script>
          <script src="/js/angular/controllers/userController.js"></script>
<script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-105840629-1', 'auto');
        ga('send', 'pageview');

        </script>
    </body>
</html>



