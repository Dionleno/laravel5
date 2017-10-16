
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
         <link href="/css/admin/style.css" rel="stylesheet">

       <META NAME="ROBOTS" CONTENT="NOINDEX, FOLLOW">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        
        
            
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                 
            <div class="container">
                
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Algoritmo do sucesso</a>
                </div>
            
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                       
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{route('dashboard')}}">Pagamentos</a></li>
                        <li><a href="{{route('cadastros')}}">Cadastros</a></li>
                        <li><a href="{{route('bebook')}}">Baixaram o ebook</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrador <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('admin')}}">Sair</a></li>                                
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
                </div>
            </nav>
           <div class="container" id="boxitems">
               
               <div class="col-xs-12 col-sm-12 col-md-6" style="padding:30px 15px;border-bottom:1px solid #f1f1f1;margin-bottom:20px;">
                   <h1 style="margin:0;">@yield('title-h1')</h1>
                   
               </div>  
           @yield('content')
        
        </div>

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>
</html>
