@extends('emails.layout.master') 
 @section('content')
	<tr>
		<td width="44" > </td>
		<td width="500" >
		    <h2>PAGAMENTO APROVADO</h2>
            <strong>Oi {{$user->name}},</strong>
            
          <p>Obrigada por adquirir o curso. O seu pagamento foi aprovado pelo cartão.</p> 
 
<p>
Comece a empreender agora!
</p>

<br/>
            Muito obrigada,
            Camila Farani
        </td>
		<td width="56"></td>
	</tr>
	@endsection