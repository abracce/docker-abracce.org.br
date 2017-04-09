<?php
/**
 * The option sections
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

global $prefix, $config;

$sections[] = array(
	'title'  => 'Contato',
	'desc'   => '<p class="description">Configurações de contato e formulários do site</p>',
	'icon'   => 'admin-comments',
	'fields' => array(
		array(
			'id'       => $prefix.'email',
			'type'     => 'text',
			'title'    => 'E-mail',
			'std'      => $email_default,
			'sub_desc' => 'E-mail padrão para envio do formulário de Contato'
		),
		// array(
		// 	'id'       => $prefix.'msg_success',
		// 	'type'     => 'text',
		// 	'title'    => 'Mensagem de sucesso',
		// 	'std'      => 'Sua mensagem foi enviada com sucesso!',
		// 	'sub_desc' => 'Mensagem de retorno de sucesso para o formulário de Contato'
		// ),
		array(
			'id'       => $prefix.'emails_extras',
			'type'     => 'multi_text',
			'title'    => 'Emails extras',
			// 'std'      => array($email_default),
			'sub_desc' => 'Emails extras para envio do formulário de contato'
		),
		array(
			'id'       => $prefix.'contato_assuntos',
			'type'     => 'multi_text',
			'title'    => 'Assuntos',
			'std'      => array(
				'Contato',
			),
			'sub_desc' => 'Assuntos para seleção do Formulário de contato'
		),
		array(
			'id'       => $prefix.'email_from',
			'type'     => 'text',
			'title'    => 'E-mail From',
			'std'      => $email_default,
			'sub_desc' => 'E-mail que vai enviar a mensagem para caixa de entrada do e-mail padrão, se estiver em branco pegará o e-mail padrão.'
		),
	),
);



// $sections[] = array(
// 	'title'  => 'Conteúdo',
// 	// 'desc'   => '<p class="description">Configurações de conteudos do tema. <br><strong>OBS.: Apenas chamar a função <code>conteudo(\'id_conteudo\')</code> onde quer que apareca o conteúdo.</strong></p>',
// 	'icon'   => 'edit',
// 	'fields' => array(
// 		array(
// 			'id'    => $prefix.'email_conteudo',
// 			'type'  => 'text',
// 			'title' => 'E-mail',
// 			// 'sub_desc' => 'E-mail padrão para envio do formulário de Contato'
// 		),
// 		array(
// 			'id'    => $prefix.'fone_conteudo',
// 			'type'  => 'text',
// 			'title' => 'Telefone',
// 		),
// 		array(
// 			'id'    => $prefix.'endereco_conteudo',
// 			'type'  => 'textarea',
// 			'title' => 'Endereço',
// 		),
// 	)
// );


// $sections[] = array(
// 	'title'  => 'Opções gerais',
// 	'desc'   => '<p class="description">Configurações gerais para o tema</p>',
// 	'icon'   => 'admin-settings',
// 	'fields' => array(
// 		array(
// 			'id'       => $prefix.'site_favicon',
// 			'type'     => 'upload_image',
// 			'title'    => 'Favicon',
// 			'sub_desc' => ' * Envie o favicon com formato .ico com dimensões de 16x16 pixes'
// 		),
// 		array(
// 			'id'       => $prefix.'analytics',
// 			'type'     => 'text',
// 			'title'    => 'Google Analytics',
// 			'sub_desc' => 'Apenas o código contendo 13 caracteres. Ex: "UA-47470793-1"'
// 		),
// 		array(
// 			'id'       => $prefix.'responsivo',
// 			'type'     => 'radio',
// 			'title'    => 'Site responsivo?',
// 			'options'  => array(
// 				's' => 'Sim',
// 				'n' => 'Não',
// 			),
// 			'std' => 's',
// 			'sub_desc' => 'Apenas para habilitar a meta viewport no cabeçalho do site.'
// 		),
// 	)
// );

// $sections[] = array(
// 	'title'  => 'Sidebar',
// 	'desc'   => '<p class="description">Sidebars personalizadas para o site</p>',
// 	'icon'   => 'list-view',
// 	'fields' => array(
// 		array(
// 			'id'       => $prefix.'sidebars',
// 			'type'     => 'multi_text',
// 			'title'    => 'Sidebars',
// 			// 'sub_desc' => '',
// 			// 'desc'     => ''
// 		),
// 	)
// );

// $sections[] = array(
// 	'title'  => 'Social',
// 	// 'desc'   => '<p class="description">Configurações de conteudos do tema. <br><strong>OBS.: Apenas chamar a função <code>conteudo(\'id_conteudo\')</code> onde quer que apareca o conteúdo.</strong></p>',
// 	'icon'   => 'facebook',
// 	'fields' => array(
// 		array(
// 			'id'    => $prefix.'facebook',
// 			'title' => 'Facebook',
// 			'type'  => 'text',
// 		),
// 		array(
// 			'id'    => $prefix.'twitter',
// 			'title' => 'Twitter',
// 			'type'  => 'text',
// 		),
// 		array(
// 			'id'    => $prefix.'youtube',
// 			'title' => 'Youtube',
// 			'type'  => 'text',
// 		),
// 	)
// );
