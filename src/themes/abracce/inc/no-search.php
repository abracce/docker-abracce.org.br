
<!-- .no-search -->
<div class="no-search alert alert-info col-md-12">

	<div class="well text-center">
		<h4 class="no-margin">
			Oops! Nada foi encontrado com termo: <strong><?php echo get_search_query() ?></strong>
		</h4>
	</div>

	<p><strong>Sugestões:</strong></p>
	<ul>
		<li>Certifique-se que todas as palavras estão escritas corretamente.</li>
		<li>Tente palavras-chave diferentes.</li>
		<li>Tente palavras mais genéricas.</li>
	</ul>

	<br>

	<?php get_search_form(); ?>
</div>
<!-- /.no-search -->

<div class="clearfix"></div>
