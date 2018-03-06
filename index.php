<?php
	
/**
 * Inffus Web Intelligence
 *
 * @author Inffus
 * @version 1.0
 * @copyright KikoAutos, 2018
 * @link http://www.KikoAutos.com.br
*/

//Inicia sessions
session_start();

/**
 * Cria session para usuario logado
 *
 */
if(!isset($_SESSION['adminId'])){
	//die();
	header('Location: https://kikoautos.com.br/index.html');
}

//Verifica existencia de arquivo de conexao
if(!file_exists('templates/class/dao/sql/ConnectionProperty.class.php')){ header('Location: install.php'); }



require_once('application/include_dao.php');

/**
 * @var mixed $transaction Cria nova instância da classe
 */
$transaction = new Transaction();





/**
 * @var mixed $transaction Cria nova instância da classe
 */
include_once('core/core.php');


?>

<html lang="pr-BR">
<head>
	<meta charset="UTF-8">
	<title><?=$siteTitle?></title>
    
    <!-- Metas -->
<!-- 	<meta name="google-site-verification" content="" /> -->
    <meta name="description" content="<?=$siteDescription;?>">
    <meta name="keywords" content="<?=$siteKeywords;?>" />
    <meta name="author" content="Inffus WEB">
    
    
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?=$URLSITE?>/assets/img/favicon/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$URLSITE?>/assets/img/favicon/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$URLSITE?>/assets/img/favicon/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$URLSITE?>/assets/img/favicon/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?=$URLSITE?>/assets/img/favicon/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?=$URLSITE?>/assets/img/favicon/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?=$URLSITE?>/assets/img/favicon/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?=$URLSITE?>/assets/img/favicon/apple-touch-icon-152x152.png" />
	<link rel="icon" type="image/png" href="<?=$URLSITE?>/assets/img/favicon/favicon-196x196.png" sizes="196x196" />
	<link rel="icon" type="image/png" href="<?=$URLSITE?>/assets/img/favicon/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/png" href="<?=$URLSITE?>/assets/img/favicon/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?=$URLSITE?>/assets/img/favicon/favicon-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="<?=$URLSITE?>/assets/img/favicon/favicon-128.png" sizes="128x128" />
	<meta name="application-name" content="&nbsp;"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="<?=$URLSITE?>/assets/img/favicon/mstile-144x144.png" />
	<meta name="msapplication-square70x70logo" content="<?=$URLSITE?>/assets/img/favicon/mstile-70x70.png" />
	<meta name="msapplication-square150x150logo" content="<?=$URLSITE?>/assets/img/favicon/mstile-150x150.png" />
	<meta name="msapplication-wide310x150logo" content="<?=$URLSITE?>/assets/img/favicon/mstile-310x150.png" />
	<meta name="msapplication-square310x310logo" content="<?=$URLSITE?>/assets/img/favicon/mstile-310x310.png" />
    
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	
	<!-- Og -->
    <meta property="og:title" content="<?=$siteTitle?>"/>
	<meta property="og:description" content="<?=$siteDescription?>"/>
	<?=$metaImages?>
	<meta property="og:url" content="<?=$siteUrl?>"/>
	<meta property="og:site_name" content="<?=$siteTitle?>"/>
	
	<!-- CSS -->
	<link rel="stylesheet" href="/assets/css/normalize.min.css">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/jquery.fancybox.min.css">
	<link rel="stylesheet" href="/assets/css/slick.css">
	<link rel="stylesheet" href="/assets/css/slick-theme.css">
	<link rel="stylesheet" href="/assets/css/perfect-scrollbar.css">

	<link rel="stylesheet" href="/assets/css/style.css">
	
	<!-- FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

</head>
<body>
	
	<?php //include_once('include/modais.phtml'); ?>
	
	<div class="page-wrapper">
		
		<?php
			
			//if($pagina=="" or file_exists('page/'.$pagina.'.phtml')){ 
				include_once('include/header.phtml'); 
			//} 
		
		?>
		
		<div class="page-content">	

			<!-- INCLUDE SESSIONS OF SITE -->	
			<?php 		
			
				if($pagina!=""){
					
					//Se existir o arquivo correspondente ao texto recebino na variavel modulo inclui
					if(file_exists('page/'.$pagina.'.phtml')){ 
						
						//Verifica se o arquivo existe e um arquivo verdadeiro
						include_once((is_file('page/'.$pagina.'.phtml')) ? 'page/'.$pagina.'.phtml' : 'page/home.phtml');
						
					}else{
					
						//Do contrario mosta a pagina de erro
						include_once("page/error404.phtml"); 
					}
				
				}else{
					
					//Do contrario mosta a pagina de erro
					include_once("page/home.phtml");
				
				}
				
			?>
		
		</div> <!-- PageContent -->

		<?php 
			
			//if($pagina=="" or file_exists('page/'.$pagina.'.phtml')){ 
			
				include_once('include/footer.phtml'); 
			//} 
		?>
		
	</div> <!-- PageWrapper -->
	
	
	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVQh8KHCVUKoqVJHQGZbQNHdYjAPe8Km0"></script>

	  <script src="/assets/js/jquery.min.js"></script>
	  <script src="/assets/js/bootstrap.min.js"></script>
	  <script src="/assets/js/isotope.pkgd.min.js"></script>
	  <script src="/assets/js/jquery.autocomplete.min.js"></script>
	  <script src="/assets/js/jquery.fancybox.min.js"></script>
	  <script src="/assets/js/perfect-scrollbar.jquery.min.js"></script>
	  <script src="/assets/js/jquery.form.min.js"></script>
	  <script src="/assets/js/slick.min.js"></script>
	  <script src="/assets/js/instafeed.min.js"></script>
	  <script src="/assets/js/jquery.validate.min.js"></script>
	  <script src="/assets/js/jquery.mask.min.js"></script>
	  <script src="/assets/js/slick.min.js"></script>
	  
	  <script src="/assets/js/js.js"></script>
		

	<?php if($siteAnalytics!=''){ ?>
	
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', '<?php echo $siteAnalytics; ?>', 'auto');
		  ga('send', 'pageview');
		
		</script>
	
	<?php } ?>
	
</body>
</html>

<?php
	
//commit transaction
$transaction->commit();	
	
?>