<?php
/**
 * The module functions
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

if (isset($_GET['post_type'])) {

	$_post_type = $_GET['post_type'];

} else {

	$_post_type = 'post';

}


// ADD NEW COLUMN
function kr_columns_head_newsletter($defaults) {

	$defaults['newsletter_name']  = __('Name', THEME_FX);
	$defaults['newsletter_email'] = __('Email', THEME_FX);

	unset($defaults['date']);
	unset($defaults['tags']);
	unset($defaults['categories']);
	unset($defaults['author']);
	unset($defaults['title']);

	return $defaults;
}

// SHOW THE FEATURED IMAGE
function kr_columns_content_newsletter($column_name, $post_ID) {

	switch ($column_name) {

		case 'newsletter_name':

			$name = get_post_meta( $post_ID, 'newsletter_name' );
			if (!empty($name[0])) {
				echo '<strong><a title="Editar" href="'.get_edit_post_link( $post_ID ).'">'.$name[0].'</a></strong>';
			}

		break;

		case 'newsletter_email':

			$email = get_post_meta( $post_ID, 'newsletter_email' );
			if (!empty($email[0])) {
				echo '<a title="clique para enviar um e-mail" href="mailto:'.$email[0].'">'.$email[0].'</a>';
			}

		break;

		default:
		break;

	}

}

add_filter('manage_newsletter_posts_columns', 'kr_columns_head_newsletter');
add_action('manage_newsletter_posts_custom_column', 'kr_columns_content_newsletter', 10, 2);

// assets newsletter
function kr_newsletter_enqueue_scripts() {

	wp_enqueue_script( 'newsletter', NEWSLETTER_URL . '/assets/js/newsletter.js', array( 'jquery' ), null, true );
	wp_enqueue_style( 'newsletter', NEWSLETTER_URL . '/assets/css/newsletter.css', array(), null, 'all' );

}

add_action( 'wp_enqueue_scripts', 'kr_newsletter_enqueue_scripts', 1 );


/**
*	Formulário de Newsletter
*	Montamos o formulário com apenas 2 campos Nome e E-mail
*
*	@param $title string
*	@param $label boolean
*	@param $labels array
*
*	----- EXEMPLO ----
*	$labels['name'] = 'Nome completo';
*	$labels['mail'] = 'Digite seu E-mail';
*	kr_newsletter_form('Cadastre-se', false, $labels);
*/
function kr_newsletter_form( $title = 'Newsletter', $label = false, $labels = array() ) {
	if(count($labels) == 0) {
		$labels['name'] = __('Name', THEME_FX);
		$labels['mail'] = __('Email', THEME_FX);
	}
	?>
	<!-- .news-wrapper -->
	<div class="news-wrapper">

		<?php if(!empty($title)): ?>
			<h3><?php echo $title ?></h3>
		<?php endif; ?>

		<!-- #form_newsletter -->
		<form id="form_newsletter" method="post" role="form">

			<!-- .form-group name -->
			<div class="form-group has-feedback">

				<?php if($label): ?>
					<label for="newsletter_name"><?php echo $labels['name'] ?></label>
					<?php $placeholder = ''; ?>
				<?php else: ?>
					<?php $placeholder = 'placeholder="' . $labels['name'] . '"'; ?>
				<?php endif; ?>

				<input type="text" name="newsletter_name" id="newsletter_name" class="form-control" <?php echo $placeholder ?> />
				<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
			</div>
			<!-- /.form-group name -->

			<div class="clearfix"></div>

			<!-- .form-group email -->
			<div class="form-group has-feedback">

				<?php if($label): ?>
					<label for="newsletter_email"><?php echo $labels['mail'] ?></label>
					<?php $placeholder = ''; ?>
				<?php else: ?>
					<?php $placeholder = 'placeholder="' . $labels['mail'] . '"'; ?>
				<?php endif; ?>

				<input type="email" name="newsletter_email" id="newsletter_email" class="form-control" <?php echo $placeholder ?> />
				<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
			</div>
			<!-- /.form-group email -->

			<div class="clearfix"></div>

			<!-- alert -->
			<div class="alert alert-info"></div>
			<!-- /alert -->

			<div class="clearfix"></div>

			<input type="submit" class="btn btn-primary pull-right" value="<?php _e('Send', THEME_FX) ?>" />

		</form>
		<!-- /#form_newsletter -->

	</div>
	<!-- /.news-wrapper -->
<?php
}


function kr_newsletter_save() {

	/* pegamos os dados necessários */
	$data      = $_POST;
	$newsname  = $data['newsname'];
	$newsemail = $data['newsemail'];

	/* verifica se os campos não estão vazios */
	if( !empty($newsname) && !empty($newsemail) ) {

		/* verifica se o campo email é válido */
		if( is_email($newsemail) ) {

			$_verify = true; // variável de verificação

			/* vamos verificar se existe o e-mail cadastrado */
			$args = array(
				'post_type'      =>	'newsletter',
				'posts_per_page' =>	-1,
			);

			query_posts( $args );

			while ( have_posts() && $_verify ) {
				the_post();

				$post_id = get_the_ID();
				$_post_email = get_post_meta( $post_id, 'newsletter_name', true );

				if($_post_email === $newsemail) {

					$_verify = false;
					die(__('Email already registered in our database!', THEME_FX));
					break;

				}

			}
			/* FIM - vamos verificar se existe o e-mail cadastrado */

			/* Dados que irão ser salvos */
			$newsletter_post = array(
				'post_title'  => 'newsletter',
				'post_status' => 'publish',
				'post_type'   => 'newsletter',
				'post_author' => 1
			);

			// inserimos o post com wp_insert_post($args)
			$post_id = wp_insert_post( $newsletter_post );

			// verificamos se o post for salvo com sucesso com o seu ID
			if( $post_id ) {

				if ( !empty($newsname) ) {

					update_post_meta( $post_id, 'newsletter_name', sanitize_text_field( $newsname ) );

				}

				if ( !empty($newsemail) ) {

					update_post_meta( $post_id, 'newsletter_email', sanitize_text_field( $newsemail ) );

				}

				$json['typ'] = 'success';
				$json['msg'] = __('Newsletter successfully registered!', THEME_FX);
				echo json_encode($json);
				die();

			} else {

				$json['typ'] = 'error';
				$json['msg'] = __('Error in registration!', THEME_FX);
				echo json_encode($json);
				die();

			}

		} else {

			$json['typ'] = 'error';
			$json['msg'] = __('Invalid Email!', THEME_FX);
			echo json_encode($json);
			die();

		}

	} else {

		$json['typ'] = 'error';
		$json['msg'] = __('Do not leave any field blank!', THEME_FX);
		echo json_encode($json);
		die();

	}
	exit;
}
add_action('wp_ajax_nopriv_SaveNewsletter', 'kr_newsletter_save');
add_action('wp_ajax_SaveNewsletter', 'kr_newsletter_save');



/**
 * Add link export to excel
 */
function kr_newsletter_export_to_excel() {
	global $_post_type;

	if ( 'newsletter' == $_post_type ) {
	?>

		<a href="#" class="button button-primary" id="export_to_excel" title="<?php _e('Export subscribers', THEME_FX) ?>">
			<?php _e('Export subscribers', THEME_FX) ?>
		</a>
		<span id="script_redirect_export_to_excel"></span>

	<?php
	}
}
add_action( 'restrict_manage_posts', 'kr_newsletter_export_to_excel' );


/**
 * wp_enqueue_script for export to excel
 */
function kr_newsletter_export_to_excel_js() {

	wp_enqueue_script(
		'export-to-excel',
		MODULES_URL . '/newsletter/assets/js/newsletter.js',
		array(),
		null,
		true
	);

}
if ('newsletter' == $_post_type) {
	add_action( 'admin_enqueue_scripts', 'kr_newsletter_export_to_excel_js' );
}



/**
 * Ajax for export to excel
 */
function kr_newsletter_ajaxme_excel() {

	$link_redirect = MODULES_URL . '/newsletter/excel-export.php?html=';

	$html   = "";
	$html  .= "<table>";
		$html .= "<tr>";
			$html .= "<td><b>".__('Name', THEME_FX)."</b></td>";
			$html .= "<td><b>".__('Email', THEME_FX)."</b></td>";
		$html .= "</tr>";
	$html .= "</table>";

	$args = 'post_status=publish&post_type=newsletter&posts_per_page=-1';
	query_posts($args);
	if (have_posts()) :
		while ( have_posts() ) : the_post();;
			$ass_mail = get_post_meta( get_the_ID(), 'newsletter_email', true );
			$ass_name = get_post_meta( get_the_ID(), 'newsletter_name', true );

			$html  .= "<table>";
			$html .= "<tr>";
				$html .= "<td>{$ass_name}</td>";
				$html .= "<td>{$ass_mail}</td>";
			$html .= "</tr>";
			$html .= "</table>";

		endwhile;

		$link_redirect .= urlencode($html);
		$scrpt_redirect = '<script language="javascript">window.location=\''.$link_redirect.'\';</script>';
		echo $scrpt_redirect;

	endif;
	wp_reset_query();
	exit();

}
add_action('wp_ajax_ExportToExcel','kr_newsletter_ajaxme_excel');
