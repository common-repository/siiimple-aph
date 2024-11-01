<?php if ( get_option( 'iiiaph_ga_tracking_id' ) != 'UA-10781172-10-xx' ) : $tracking_id = get_option( 'iiiaph_ga_tracking_id' ); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $tracking_id; ?>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', '<?php echo $tracking_id; ?>');
	</script>
<?php endif; ?>