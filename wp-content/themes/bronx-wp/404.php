<?php get_header(); ?>
<?php if (ot_get_option('404-image')) { $image = ot_get_option('404-image'); } else { $image = THB_THEME_ROOT. '/assets/img/404.png'; } ?>
<section class="content404 table full-height-content">
	<div>
	<div class="row">
		<div class="small-12 medium-10 medium-centered xlarge-8 columns text-center">
			<img src="<?php echo esc_url($image); ?>" alt="<?php _e( "Error 404", 'bronx' ); ?>" class="animation fade-in"/>
			<h2 class="animation fade-in"><?php _e( "Page Not Found", 'bronx' ); ?></h2>
			<p><?php _e( "We are sorry, but the page you are looking for cannot be found. <br>You might try searching our site.", 'bronx' ); ?></p>
			
			<div class="small-12 medium-10 medium-centered large-6 xlarge-4 columns">
				<?php get_search_form(); ?> 
			</div>
		</div>
  </div>
  </div>
</section>
<?php get_footer(); ?>