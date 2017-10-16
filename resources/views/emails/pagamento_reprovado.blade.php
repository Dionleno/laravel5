@extends('emails.layout.master') 
 @section('content')
	<tr>
		<td width="44" > </td>
		<td width="500" >
		    <h2>PAGAMENTO REPROVADO</h2>
            <strong>Oi {{$user->name}},</strong>
            <p>
			Obrigado por se inscrever para participar do curso. A sua solicitação de pagamento não foi autorizada pela administradora do cartão. 
</p><p>
Para finalizar a sua matrícula e ter acesso ao conteúdo do curso, você pode fazer a retentativa de pagamento. Caso não consiga você pode verificar seu cartão de crédito ou entre em contato com a administradora.
</p>
 

<br/>
            Muito obrigada,
            Camila Farani
        </td>
		<td width="56"></td>
	</tr>
	@endsection