<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins.js') ?>"></script>
<script src="<?php echo base_url('assets/js/main.js') ?>"></script>

<!-- script
================================================== -->
<script src="<?php echo base_url('assets/js/modernizr.js') ?>"></script>

<script type="text/javascript">
    $(window).scroll(function() {
        if( $(this).scrollTop() > 0 ) {
        	$( '.s-header' ).last().addClass('opaqueHeader');
        } else {
        	$( '.s-header' ).last().removeClass('opaqueHeader');
        }

        if( $(this).scrollTop() > 150 ){
        	$( '.header-menu-toggle' ).last().removeClass('opaque');
        	$( '.header-nav__close' ).css('background-color', 'transparent');
        }
    });
</script>

<?php

if (isset($scripts)) {
    foreach ($scripts as $script) {
        echo "<script src='{$script}'></script>";
    }
}

?>
