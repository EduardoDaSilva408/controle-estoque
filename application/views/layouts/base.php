<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include Tom Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Controle Estoque | Início</title>

    <?php if (isset($css)) { echo $css; } ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow mb-4">
    <div class="container mx-auto flex items-center justify-between px-4 py-3">
        <img src="<?php echo base_url('Imagens/logo.png'); ?>" onclick="location.href='/'" alt="Controle Estoque" class="h-12 cursor-pointer">
        <nav class="space-x-4">
            <a href="/" class="text-blue-600 hover:underline">Página Inicial</a>
            <a href="/produtos" class="text-blue-600 hover:underline">Produtos</a>
            <a href="/cupons" class="text-blue-600 hover:underline">Cupons</a>
        </nav>
    </div>
</header>

<main class="container mx-auto px-4">
    <?php if (isset($content)) { echo $content; } ?>
</main>

<footer class="bg-gray-200 text-center text-sm py-4 mt-8">
    &copy; <?php echo date('Y'); ?> Controle Estoque. Todos os direitos reservados.
</footer>

<?php if (isset($js)) { echo $js; } ?>

</body>
</html>
