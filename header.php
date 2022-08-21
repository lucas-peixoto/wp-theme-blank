<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width">

        <title><?php bloginfo('name'); ?></title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="author" content="Lucas Peixoto" />
        <meta name="language" content="pt-br" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="Abstract" content="" />
        <meta name="url" content="" />
        <meta name="Audience" content="all" />
        <meta name="rating" content="general" />
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
        <meta name="msnbot" content="index,follow,all" />
        <meta name="inktomislurp" content="index,follow,all" />
        <meta name="unknownrobot" content="index,follow,all" />
        <meta name="classification" content="commercial" />
        <meta name="distribution" content="global" />
        
        <?php if (has_post_thumbnail()) : ?>
        <meta property="og:image" content="<?= get_the_post_thumbnail_url(null, 'medium', ''); ?>" />
        <?php else : ?>
        <meta property="og:image" content="<?= DIR; ?>/assets/img/logo.png" />
        <?php endif; ?>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header class="header">
            <?php get_template_part( 'templates/menu' ); ?>
        </header>
