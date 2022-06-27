<?php
require_once("../admin/conexao/conecta.php");
require("../admin/functions/limita-texto.php");
?>
<!doctype html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>POSTS</title>
	<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/post.css">
</head>

<body class="l-body">

	<div class="divcenter">
		<ul class="boxposts" id="pgPost">
			<?php
			if (isset($_GET['id'])) {
				$idUrl = $_GET['id'];
			}
			$sql = "SELECT * from tb_postagens WHERE exibir='Sim' AND id=:id LIMIT 1";
			try {
				$resultado = $conexao->prepare($sql);
				$resultado->bindParam('id', $idUrl, PDO::PARAM_INT);
				$resultado->execute();
				$contar = $resultado->rowCount();

				if ($contar > 0) {
					while ($exibe = $resultado->fetch(PDO::FETCH_OBJ)) {
			?>
						<li>
							<span class="thumb">
								<img src="../upload/postagens/<?php echo $exibe->imagem; ?>" alt="<?php echo $exibe->titulo; ?>" title="<?php echo $exibe->titulo; ?>" width="166" height="166">
							</span>
							<span class="c-content">
								<h1><?php echo $exibe->titulo; ?></h1>
								<p><?php echo ($exibe->descricao) ?></p>
								<div class="footer_post">
									<a href="javascript:history.back()">Voltar</a>
									<span class="datapost"><i class='bx bx-time-five'></i><strong><?php echo $exibe->data; ?></strong></span>
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

			<div id="fb-root"></div>

			<div class="fb-comments" data-href="http://wesleydesign.com.br/wvasystem/post.php?id=<?php echo $idUrl; ?>" data-width="100%" data-numposts="5"></div>

		</ul>

	</div><!-- div center -->
	
</body>

</html>