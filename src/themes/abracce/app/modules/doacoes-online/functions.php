<?php

define('PS_EMAIL', 'abraccepagseguro@gmail.com');
define('PS_TOKEN', 'D70996C0FFD24532B68CAE3D26928E84');

function abracce_pagseguro() {

	require_once 'PagSeguroLibrary/PagSeguroLibrary.php';
	$paymentRequest = new PagSeguroPaymentRequest();

	$id    = "ABRCC001";
	// $nome  = trim($_POST['doacao_nome']);
	// $email = trim($_POST['doacao_email']);
	// $ddd   = trim($_POST['doacao_ddd']);
	// $fone  = trim($_POST['doacao_fone']);
	$cpf   = trim($_POST['doacao_cpf']);


	if(!empty($_POST['doacao_valor_fx'])) {
		$valor = trim($_POST['doacao_valor_fx']);
	} else {
		$valor = trim($_POST['doacao_valor']);
		$valor = str_replace('R$', '', $valor);
		$valor = str_replace('.', '', $valor);
		$valor = str_replace(',', '.', $valor);
	}


	/* Adiciona o produto no carrinho */
	$paymentRequest->addItem($id, 'Doação Abracce', 1, $valor);

	/* Dados de quem esta comprando */
	// $paymentRequest->setSender(
	//     $nome,
	//     $email,
	//     $ddd,
	//     $fone
	// );
	$paymentRequest->addParameter('senderCPF', $cpf);

	// moeda padrão é Real Brasileiro
	$paymentRequest->setCurrency("BRL");

	/* Numero de referencia do Produto */
	$paymentRequest->setReference($id);

	/* Tipo de Frete
		1 - Encomenda normal (PAC)
		2 - SEDEX
		3 - Tipo de frete não especificado
	*/
	$paymentRequest->setShippingType(3);

	/* Credenciais do vendedor/desenvolvedor */
	$credentials = new PagSeguroAccountCredentials( PS_EMAIL, PS_TOKEN );
	$paymentUrl  = $paymentRequest->register($credentials);

	header("Location: $paymentUrl");
	die();
}

function abracce_form_doacao() {
?>

	<!-- #doacao_form -->
	<form id="doacao_form" class="form" method="post" role="form">

		<?php /*
		<div class="page-header text-center">
			<h3>SEJA UM HERÓI DE UMA CRIANÇA</h3>

		</div>

		<div class="form-group">
			<label for="doacao_nome">Nome completo</label>
			<input type="text" class="form-control" id="doacao_nome" name="doacao_nome" required>
		</div>

		<div class="form-group">
			<label for="doacao_email">E-mail</label>
			<input type="text" class="form-control" id="doacao_email" name="doacao_email" required>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="doacao_ddd">DDD</label>
					<input type="text" class="form-control" id="doacao_ddd" name="doacao_ddd" required>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="doacao_fone">Telefone</label>
					<input type="text" class="form-control" id="doacao_fone" name="doacao_fone" required>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		*/ ?>

		<div class="form-group">
			<label for="doacao_valor">Valor da contribuição</label>

			<div class="row">
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" name="doacao_valor_fx" value="5.00">
							<h4 class="no-margin">R$ 5<small>,00</small></h4>
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" name="doacao_valor_fx" value="10.00">
							<h4 class="no-margin">R$ 10<small>,00</small></h4>
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" name="doacao_valor_fx" value="30.00">
							<h4 class="no-margin">R$ 30<small>,00</small></h4>
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" name="doacao_valor_fx" value="50.00" checked>
							<h4 class="no-margin">R$ 50<small>,00</small></h4>
						</label>
					</div>
				</div>
				<div class="col-md-2">
					<h4>R$</h4>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" id="doacao_valor" name="doacao_valor">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="doacao_cpf">CPF <small>(apenas números)</small></label>
			<input type="text" class="form-control" id="doacao_cpf" name="doacao_cpf" required>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block"><i class="icon icon-heart-o"></i> DOAR</button>
			<input type="hidden" name="doacao_abracce" value="yes">
		</div>
	</form>
	<!-- /#doacao_form -->

<?php
}
