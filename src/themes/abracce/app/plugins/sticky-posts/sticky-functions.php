<?php

function kr_get_sticky_posts( $post_type = array( 'post' ), $posts_per_page = 3 ) {
	$sticky = get_option( 'sticky_posts' );

	if($sticky):
		$post_args = array(
			'post_status'         => 'publish',
			'post_type'           => $post_type,
			'post__in'            => $sticky,
			'posts_per_page'      => $posts_per_page,
			'ignore_sticky_posts' => 1,
		);
		query_posts($post_args);

			if(have_posts()):

				get_template_part( 'template-part/loop', 'sticky-posts' );

				$page_id = get_ID_by_slug( 'noticias' );
				if($page_id) {
					echo '<div class="clearfix"></div>';
					echo '<a href="'.get_permalink( $page_id ).'" class="pull-right btn btn-link">Ver mais notícias</a>';
				}

			endif;

		wp_reset_query();
	else:
		echo '<div class="alert alert-danger">Nenhum post fixo!</div>';
	endif;

}
