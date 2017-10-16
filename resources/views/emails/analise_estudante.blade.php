@extends('emails.layout.master') 
 @section('content')
	<tr>
		<td width="44" > </td>
		<td width="500" >
		    <h2>DOCUMENTO ESTUDANTE EM ANÁLISE</h2>
            <strong>Oi {{$user->name}},</strong>
            
<p>
           O seu documento de estudante foi aprovado. Estudar e buscar conhecimento é o caminho certo para inovar e ter sucesso nos negócios.</p>
<p>
           Em breve você terá acesso ao conteúdo completo do curso.</p>
            
<br/>
            Muito obrigada,<br/>
            Camila Farani
        </td>
		<td width="56"></td>
	</tr>
	@endsection