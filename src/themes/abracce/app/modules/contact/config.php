<?php

/* get email principal e emails extras */
$_email_principal = kr_option_theme('email');
$_assuntos        = kr_option_theme('contato_assuntos');
$_emails_extras   = kr_option_theme('emails_extras');
$_contato_assuntos = array();

$prefix      = 'form_';
$fields_form = array();
$fields_meta = array();

$_contato_assuntos[''] = '-- Selecione --';
if( is_array($_assuntos) ) {
	foreach ($_assuntos as $v) {
		$_contato_assuntos[$v] = $v;
	}
}
else {
	$_contato_assuntos['Contato'] = 'Contato';
}

/*
	Mudamos as configuracoes padroes
	do Wordpress de From Name e From email
*/
add_filter( 'wp_mail_from_name', 'kr_mail_from_name' );
function kr_mail_from_name() {
	return THEME_NAME;
}

$email_from = kr_option_theme('email_from');
function kr_change_mail_from( $old ) {
	global $email_from;
	return $email_from;
}
if( !empty($email_from) ) {
	add_filter( 'wp_mail_from', 'kr_change_mail_from' );
}


$fields_form = array(
	array(
		'id'       => $prefix . 'name',
		'label'    => 'Nome',
		'type'     => 'text',
		'required' => true,
	),
	array(
		'id'       => $prefix . 'mail',
		'label'    => 'E-mail',
		'type'     => 'email',
		'required' => true,
	),
	array(
		'id'    => $prefix . 'telefone',
		'label' => 'Telefone',
		'type'  => 'text',
		'attributes'  => array(
            'class' => 'form-control mask-phone'
        )
	),
	array(
		'id'    => $prefix . 'empresa',
		'label' => 'Instituição/Empresa',
		'type'  => 'text',
	),
	array(
		'id'       => $prefix . 'assunto',
		'label'    => 'Assunto',
		'type'     => 'select',
		'required' => true,
		'options'  => $_contato_assuntos,
	),
	array(
		'id'       => $prefix . 'message',
		'label'    => 'Mensagem',
		'type'     => 'textarea',
		'required' => true,
	),
);
