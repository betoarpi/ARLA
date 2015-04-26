<?php
/**
 * The template for displaying the footer
 * @package WordPress
 * @subpackage ARLA_Design_Lab_Theme
 * @since ARLA Design Lab Theme 1.0
 */
?>

	<?php 
	// Display Contact Form in case is Front Page
	if ( is_front_page() ) { ?>
	<div id="contactanos" class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 contactanos-header MB40">
					<h2 class="title">Contáctanos<hr></h2>
					<p class="DB w60 M0A Tcenter">¿Tienes una idea o quieres hacer crecer tu negocio? 
					<br>Contáctanos y platícanos tu idea, será un gusto poder ayudarte.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
					<ul class="contact-options">
						<li><span class="icon-map"></span> San Juan del Río, Qro.</li>
						<li><span class="icon-phone2"></span> (427) 264 8757</li>
						<!-- <li><span class="icon-facebook2"></span> <a href="#">/arladesignlab</a></li> -->
						<li><span class="icon-twitter2"></span> <a href="https://twitter.com/arladesignlab" target="_blank">@arladesignlab</a></li>
					</ul>
				</div>
				<div class="col-sm-6 contact-form">
					<div class="contactForm w100 left" action="form-submit.php" method="post">
						<?php echo do_shortcode('[contact-form-7 id="21" title="Formulario de Contacto"]'); ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- ends Contáctanos -->
	<?php } ?>

	<footer id="footer" class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p class="Tcenter">&copy;2014 ARLA Design Lab. Todos los derechos reservados.</p>
				</div>
			</div>
		</div>
	</footer><!-- ends Footer -->

	<!-- Scripts -->
    <script src="<?php bloginfo( 'template_directory' ); ?>/assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php bloginfo( 'template_directory' ); ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo( 'template_directory' ); ?>/assets/js/jquery.bxslider.min.js"></script>
    <script src="<?php bloginfo( 'template_directory' ); ?>/assets/js/easy-validation.js"></script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.3/jquery.mobile.min.js"></script>-->
    <script src="<?php bloginfo( 'template_directory' ); ?>/assets/js/ux.js"></script>
        
    <!-- Google Analytics -->
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-46110298-1', 'auto');
	   ga('require', 'displayfeatures');
	  ga('send', 'pageview');
	</script>

	<?php wp_footer(); ?>
</body>
</html>