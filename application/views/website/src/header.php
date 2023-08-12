<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title><?= PROJECT_NAME ?> | <?= $title ?></title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php
  if(!empty($keyword))
  {
      echo '<meta name="keywords" content="'.$keyword.'">';
  }
  
  if(!empty($meta))
  {
      echo '<meta name="description" content="'.$meta.'">';
  }
  ?>
  
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?= base_url('website/plugins/bootstrap/bootstrap.min.css') ?>">
  <!-- slick slider -->
  <link rel="stylesheet" href="<?= base_url('website/plugins/slick/slick.css') ?>">
  <link rel="stylesheet" href="<?= base_url('website/plugins/themify-icons/themify-icons.css') ?>">
  <link rel="stylesheet" href="<?= base_url('website/css/style.css') ?>">
  <link rel="shortcut icon" href="<?= base_url('website/images/favicon.ico') ?>" type="image/x-icon">
  <link rel="icon" href="<?= base_url('website/images/favicon.ico') ?>" type="image/x-icon">

</head>
<body>
  <div class="preloader">
    <div class="loader">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>