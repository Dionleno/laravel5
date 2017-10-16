@extends('emails.layout.master') 
 @section('content')
	<tr>
		<td width="44" > </td>
		<td width="500" >
		    <h2>CADASTRO EFETUADO</h2>
            <strong>Oi {{$user->name}},</strong>
            
<p>
            Obrigada por se cadastrar no Algoritmo do Sucesso. Por favor, clique no botão abaixo para confirmar o seu cadastro.</p>
<p>
            Sua confirmação nos dará a permissão para enviar novas informações e dicas de conteúdo para o seu email. Assim poderei compartilhar como utilizo diariamente o Algoritmo para obter sucesso nos negócios.</p>

            <p>[CONFIRMAR CADASTRO]</p>
<br/>
            Muito obrigada,
            Camila Farani
        </td>
		<td width="56"></td>
	</tr>
	@endsection