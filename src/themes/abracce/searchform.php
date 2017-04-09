
<!-- .search-form -->
<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<div class="input-group">
		<input type="text" class="form-control" name="s" placeholder="Procurar..." value="<?php echo get_search_query() ?>">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-success"><i class="icon icon-search"></i></button>
		</span>
	</div>
</form>
<!-- /.search-form -->
