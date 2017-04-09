<?php
/**
 * The module functions
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

// global $_contato_assuntos;

foreach ($fields_form as $field) {
	if($field['type'] == 'email') {
		$field['type'] = 'text';
	}

	if($field['type'] == 'select') {
		$fields_meta[] = array(
			'id'      => $field['id'],
			'label'   => $field['label'],
			'type'    => $field['type'],
			'options' => $field['options'],
		);
	}
	else {
		$fields_meta[] = array(
			'id'    => $field['id'],
			'label' => $field['label'],
			'type'  => $field['type']
		);
	}
}


if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['odin_form_action']) && $_POST['odin_form_action'] === 'contact_form') {
	$KR_Contact_Form = new KR_Contact_Form();
}


/**
 * Function for Contact Form
 **/
function kr_contact_form() {
	global $_email_principal, $_emails_extras, $prefix, $fields_form;

	$contact_form = new Odin_Contact_Form(
		'contact_form',
		$_email_principal,
		$_emails_extras
	);

	$contact_form->set_fields(
		array(
			array('fields' => $fields_form)
		)
	);

	$contact_form->set_content_type( 'html' );
	$contact_form->set_reply_to( $prefix . 'mail' );

	$contact_form->set_subject(
		'(['.$prefix . 'assunto]) '.THEME_NAME.' - Enviado por ['.$prefix . 'name] <['.$prefix . 'mail]>'
	);

	return $contact_form;
}


// // ADD NEW COLUMN
function kr_columns_head_contact($defaults) {
	$defaults['title']   = 'Nome';
	$defaults['email']   = 'E-mail';
	$defaults['assunto'] = 'Assunto';
	unset($defaults['date']);
	unset($defaults['tags']);
	unset($defaults['categories']);
	unset($defaults['author']);
	// unset($defaults['title']);

	return $defaults;
}

// // SHOW THE FEATURED IMAGE
function kr_columns_content_contact($column_name, $post_ID) {
	global $prefix;

	switch ($column_name) {

		case 'email':
			$email = get_post_meta( $post_ID, $prefix.'mail', true );
			if ($email) {
				echo '<a title="Clique para Editar" href="'.get_edit_post_link( $post_ID ).'">'.$email.'</a>';
			}
		break;

		case 'assunto':
			$assunto = get_post_meta( $post_ID, $prefix.'assunto', true );
			if ($assunto) {
				echo $assunto;
			}
		break;

		default:
		break;

	}

}
add_filter('manage_contact_posts_columns', 'kr_columns_head_contact');
add_action('manage_contact_posts_custom_column', 'kr_columns_content_contact', 10, 2);
