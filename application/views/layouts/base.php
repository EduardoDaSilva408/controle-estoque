<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <title>Teste MontInk | Início</title>

    <?php if (isset($css)) { echo $css; } ?>
</head>
<body>

<header id="cabeca">
    <div id="logo-container">
        <img src="<?php echo base_url('Imagens/logo.png'); ?>" onclick="location.href='/'" alt="Teste Montink" id="logo" title="Voltar à Página Inicial">
    </div>
</header>

<section id="corpo">
    <nav id="navbar">
        <a class="navbutton btn" href='/'>Página Inicial</a>
        <a class="navbutton btn" href='/produtos'>Produtos</a>
    </nav>

    <div id="content">
        <?php if (isset($content)) { echo $content; } ?>
    </div>
</section>

<footer id="footer"></footer>

<style>
    .select2-container .select2-selection--single {
        height: calc(1.5em + 0.75rem + 2px)!important;
    }
</style>

<?php if (isset($js)) { echo $js; } ?>

</body>
</html>
