<?php
/**
 * The init module
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

// include functions
include_once 'functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doacao_abracce']) && $_POST['doacao_abracce'] === 'yes') {
	abracce_pagseguro();
}
