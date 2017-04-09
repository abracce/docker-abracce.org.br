<?php

/**
 * KR_Contact_Form
 */
class KR_Contact_Form extends Odin_Post_Form {

	var $_id     = 'contact';
	var $_status = 'publish';
	var $_custom_fields = array();

	public function __construct() {
		parent::__construct( $this->_id, $this->_id, $this->_status );
		$this->kr_custom_fieds();
		$this->kr_save_post();
	}

	public function kr_save_post() {
		$this->set_content_field( 'form_message' );
		$this->set_title_field( 'form_name' );
		$this->set_custom_fields( $this->_custom_fields );
		$this->save_post( $_POST );
		add_action( 'init', array( kr_contact_form(), 'init' ), 1 );
	}

	public function kr_custom_fieds() {
		global $fields_form;

		foreach ($fields_form as $field) {
			$this->_custom_fields[] = $field['id'];
		}

		return $this->_custom_fields;
	}

} # End Class KR_Contact_Form
