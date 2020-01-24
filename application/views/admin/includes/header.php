<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title><?php echo "{$title}"; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if (isset($styles)) foreach ($styles as $css) { ?>
        <link rel="stylesheet" href="<?php echo $css ?>" />
    <?php } ?>
    
    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/base.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vendor.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>" />

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>" type="image/x-icon" />
    <link rel="icon" href="<?php echo base_url('assets/images/favicon.ico') ?>" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slick/slick.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slick/slick-theme.css') ?>" />
    
</head>