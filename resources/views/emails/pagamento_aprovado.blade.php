@extends('emails.layout.master') 
 @section('content')
	<tr>
		<td width="44" > </td>
		<td width="500" >
		    <h2>PAGAMENTO APROVADO</h2>
            <strong>Oi {{$user->name}},</strong>
            <p>
            Seu pagamento autorizado foi aprovado. Como está sua influência na sua rede de contatos? O extrato abaixo mostra quantos amigos utilizaram o cupom e o desconto que você obteve.</p>
<p>
<strong>VALOR DO CURSO</strong> = R$ 2.995,00 <br>
<strong>(-) DESCONTOS</strong> = R$ {{$order['valor_desconto']}} <br>
<strong>VALOR PAGO PELO CURSO</strong> = R$ {{$order['valor']}} <br>
</p>
<p>
Nos vemos em breve. Boa aula, aproveite o conteúdo exclusivo.
   </p>         
             
 

<br/>
            Muito obrigada,
            Camila Farani
        </td>
		<td width="56"></td>
	</tr>
	@endsection