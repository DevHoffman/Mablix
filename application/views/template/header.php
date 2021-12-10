<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title><?php echo "{$title}"; ?></title>
    <meta name="description" content="hoffmandev@outlook.com">
    <meta name="author" content="Thyago Hoffman">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="<?php echo base_url('assets/js/pace.min.js') ?>"></script>
    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>" type="image/x-icon" />

    <?php if (isset($styles)) foreach ($styles as $css) { ?>
        <link rel="stylesheet" href="<?php echo base_url($css) ?>" />
    <?php } ?>
    
    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/base.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vendor.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>" />

</head>