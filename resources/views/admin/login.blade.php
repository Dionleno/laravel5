
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="background:#f1f1f1;">
        
       
       <div class="container">
           
           <div class="col-xs-12 col-sm-4 col-sm-offset-4" style="background:#FFF;padding:20px; margin-top:90px;">
                  
                <form action="{{route('admin-logar')}}" method="POST" role="form" style="">
                    <legend>Login</legend>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" id="" name="name" placeholder="Nome">
                    </div>
                
                     <div class="form-group">
                        <label for="">Senha</label>
                        <input type="password" class="form-control" id="" name="password" placeholder="Senha">
                    </div>
                     <div class="form-group">
                @if($errors->has('status'))
                        @foreach ($errors->all('status') as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                @endif

                @if($errors->has())
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                @endif
                      </div>

                    <button type="submit" class="btn btn-primary text-center" >Entrar</button>
                </form>
                

           </div>
           
       </div>
       

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>
</html>
