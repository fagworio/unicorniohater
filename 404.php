<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>
	<section class="full-width content-news-s"> 
	<h1 class="page-title" style="text-align: center; font-size: 2rem; line-height: 4rem; text-transform: uppercase; "><?php esc_html_e( 'Curioso em? Nada encontrado!', 'unicornioHater' ); ?> </h1>

		<div class="error-404 not-found default-max-width">
			<?php $not_found_image = get_template_directory_uri() . '/assets/images/404.webp' ?>
			<img src="<?php echo $not_found_image ?>" style="display: block; width: 50%; margin: 0 auto;" alt="Página Não Encontrada">
			<div class="page-content">
				<p style="padding: 1rem 1rem; text-align: center; font-size: 2rem; line-height: 2rem; text-transform: uppercase;"><?php esc_html_e( 'Parece que nada foi encontrado neste local! Volte para a página inicial.', 'unicornioHater' ); ?></p>
				<a href="/" aria-label="Página inicial" style="display: block; text-align: center; font-size: 2rem;line-height: 5rem; color: #ff00de; text-transform: uppercase;">Página inicial</a>
			</div><!-- .page-content -->
		</div><!-- .error-404 -->

	</section>

<?php
get_footer();
