<?php
require_once("admin/conexao/conecta.php");
require("admin/functions/limita-texto.php");

// echo "<meta HTTP-EQUIV='refresh' CONTENT='5;URL=index.php'>";

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jornal</title>
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/menu.css">
	<link rel="stylesheet" href="assets/css/media.css">
	<link rel="stylesheet" href="assets/css/posts.css">

	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body class="l-body">

	<header class="l-header">
		<nav class="c-navbar">
			<div class="c-navbar__content">

				<div class="c-navbar__sal">
					<img class="c-navbar__sal--img" src="assets/img/sal.png">
				</div>

				<ul class="c-navbar__menu-list">
					<div class="c-navbar__btn c-navbar__btn--cancel">
						<img class="c-navbar__icon" src="assets/img/menu-cancel.svg" alt="" />
					</div>

					<li class="c-navbar__item-list">
						<div class="c-navbar__perfil c-navbar__perfil--mobile c-navbar__perfil--active">
							<a href="pages/perfil.php">
								<i class='c-navbar__perfil--img bx bx-user'></i>
							</a>
						</div>
					</li>

					<li class="c-navbar__item-list">
						<a href="admin/index.php" class="c-navbar__itens" target="_self" rel="next">Admin</a>
					</li>

					<li class="c-navbar__item-list">
						<a href="#jornal" class="c-navbar__itens" target="_self" rel="next">Jornal</a>
					</li>

					<li class="c-navbar__item-list">
						<a href="" class="c-navbar__itens" target="_self" rel="next">Biblioteca</a>
					</li>

					<li class="c-navbar__item-list">
						<a href="" class="c-navbar__itens" target="_self" rel="next">Comunicados</a>
					</li>
					<li class="c-navbar__item-list">
						<a href="pages/sobre.html" class="c-navbar__itens" target="_self" rel="next">Sobre</a>
					</li>

				</ul>

				<div class="c-navbar__perfil">
					<a href="pages/perfil.php">
						<i class='c-navbar__perfil--img bx bx-user'></i>
					</a>
				</div>

				<div class="c-navbar__btn c-navbar__btn--menu">
					<img class="c-navbar__icon" src="assets/img/menu-open.svg">
				</div>
			</div>
		</nav>
	</header>

	<main class="c-main">

		<section class="c-principal">
			<div class="c-principal__texto">
				<h2 class="c-principal__titulo">Portal Salaberga</h2>
				<p class="c-principal__descricao"> Seja bem vindo(a) ao site site da EEEP Salaberga Torquato Gomes de Matos. </p>
				<div class="c-principal__button">
					<a class="c-principal__link-btn" href="pages/saibamais.html">
						<button class="c-principal__btn bn632-hover bn28">Saiba mais...</button>
					</a>
				</div>
			</div>

			<div class="c-principal__container-img">
				<img class="c-principal__img" src="assets/img/class.png" alt="">
			</div>
		</section>

		<h2 class="c-titulo" id="jornal">Jornal</h2>

		<section class="c-posts">
			<div class="divcenter">
				<ul class="boxposts">

					<?php

					if (empty($_GET['pg'])) {
					} else {
						$pg = $_GET['pg'];
						if (!is_numeric($pg)) {

							echo '<script language= "JavaScript">
					location.href="index.php";
		</script>';
						}
					}

					if (isset($pg)) {
						$pg = $_GET['pg'];
					} else {
						$pg = 1;
					}

					$quantidade = 3;
					$inicio = ($pg * $quantidade) - $quantidade;

					$sql = "SELECT * from tb_postagens WHERE exibir='Sim' ORDER BY id DESC LIMIT $inicio, $quantidade";
					try {
						$resultado = $conexao->prepare($sql);
						$resultado->execute();
						$contar = $resultado->rowCount();

						if ($contar > 0) {
							while ($exibe = $resultado->fetch(PDO::FETCH_OBJ)) {
					?>
								<li>
									<span class="thumb">
										<img src="upload/postagens/<?php echo $exibe->imagem; ?>" alt="<?php echo $exibe->titulo; ?>" title="<?php echo $exibe->titulo; ?>" width="166" height="166">
									</span>
									<span class="c-content">
										<h1><?php echo $exibe->titulo; ?></h1>
										<p><?php echo limitarTexto($exibe->descricao, $limite = 380) ?><br></p>
										<div class="footer_post">
											<span class="datapost"><i class='bx bx-time-five'></i><strong><?php echo $exibe->data; ?></strong></span>
											<a href="pages/post.php?id=<?php echo $exibe->id; ?>">Ver mais...</a>
										</div><!-- footer post -->
									</span>
								</li>
					<?php
							} //while
						} else {
							echo '<li>Não existe post cadastrados no sistema</li>';
						}
					} catch (PDOException $erro) {
						echo $erro;
					}
					?>

				</ul>

				<!-- inicio botoes -->

				<style>
					/* paginacao */

					.paginas {
						width: 100%;
						padding: 10px 0;
						text-align: center;
						background: #fff;
						margin: 10px auto;
						display: none;
					}

					.paginas a {
						width: auto;
						padding: 4px 10px;
						background: #eee;
						color: #333;
						margin: 0px 2.5px;
						text-decoration: none;
						font-family: tahoma, "Trebuchet Ms", arial;
						font-size: 13px;

					}

					.paginas a:hover {
						text-decoration: none;
						background: #00BA8B;
						color: #fff;
					}

					<?php
					if (isset($_GET['pg'])) {
						$num_pg = $_GET['pg'];
					} else {
						$num_pg = 1;
					}
					?>.paginas a.ativo<?php echo $num_pg; ?> {
						background: #00BA8B;
						color: #fff;
					}
				</style>


				<?php
				$sql = "SELECT * from tb_postagens";
				try {
					$result = $conexao->prepare($sql);
					$result->execute();
					$totalRegistros = $result->rowCount();
				} catch (PDOException $e) {
					echo $e;
				}

				if ($totalRegistros <= $quantidade) {
				} else {
					$paginas = ceil($totalRegistros / $quantidade);
					if ($pg > $paginas) {
						echo '<script language= "JavaScript">
					location.href="index.php";
					</script>';
					}
					$links = 5;

					if (isset($i)) {
					} else {
						$i = '1';
					}

				?>
					<div class="paginas">

						<a href="index.php?pg=1">Primeira Página</a>

						<?php
						if (isset($_GET['pg'])) {
							$num_pg = $_GET['pg'];
						}

						for ($i = $pg - $links; $i <= $pg - 1; $i++) {
							if ($i <= 0) {
							} else {
						?>
								<a href="index.php?pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>"><?php echo $i; ?></a>

						<?php  }
						} ?>

						<a href="index.php?pg=<?php echo $pg; ?>" class="ativo<?php echo $i; ?>"><?php echo $pg; ?></a>

						<?php
						for ($i = $pg + 1; $i <= $pg + $links; $i++) {
							if ($i > $paginas) {
							} else {
						?>

								<a href="index.php?pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>"><?php echo $i; ?></a>

						<?php
							}
						}
						?>

						<a href="index.php?pg=<?php echo $paginas; ?>">Última página</a>

					</div><!-- paginas -->

				<?php
				}
				?>
				<!-- fim botoes paginacao -->

			</div><!-- div center -->
		</section>
	</main>
	<script src="assets/js/script.js"></script>
</body>

</html>