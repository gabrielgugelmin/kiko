<?php
		
/**
 * CMS INFFUS
 *
 * Arquivo para criar conexao com o database
 *
 * @author Diego Rodrigo Santos
 * @version 1.0
 * @copyright Inffus, 2015
 * @link http://www.inffus.com.br
*/

ini_set('display_errors',1);
ini_set('display_startup_erros',1);

error_reporting(E_ALL & ~ E_NOTICE); 
//error_reporting(E_ALL);

//Verifica existencia de arquivo de conexao
if(file_exists('templates/class/dao/sql/ConnectionProperty.class.php')){ header('Location: http://'.$_SERVER['HTTP_HOST'].' '); }

include 'util/valid.php';
include 'util/garbage.php';


// Define a constant para o caminho das imagens
$URLSITE 	= "http://".$_SERVER['HTTP_HOST'];
	
/**
 * @var mixed $valid Cria nova instância da classe Validacao
 */
$valid 	= new Validacao();

/**
 * @var mixed $r Cria nova instância da classe Garbage
 */
$r 	= new Garbage();

/**
 * @var array $erro Retorna erros de formularios
 */
$erro	= array();

/**
 * @var array $succ Retorna erros de formularios
 */
$succ	= array();

/*
$servername = 'base.cms2.inffus.com.br';
$username	= 'cms2_user';
$password 	= 'XP7?YwWY';
$database	= 'cms2_data2';

$emailHost = 'mail.inffus.com.br';
$emailUserName = 'contato@inffus.com.br';
$emailPassword = 'drsarl86';
*/
$emailPort	= '587';
	
if(isset($_POST['instalar'])){
	
	//print_r($_POST); die();

	$email 		= $_POST["email"];
	$senha 		= $_POST["senha"];
	$diretorio 	= $_POST["diretorio"];
	
	$emailHost 			= $_POST["emailHost"];
	$emailUserName 		= $_POST["emailUserName"];
	$emailPassword 		= $_POST["emailPassword"];
	$emailPort 			= $_POST["emailPort"];
	
	$servername 	= $_POST["servername"];
	$username 		= $_POST["username"];
	$password 		= $_POST["password"];
	$database 		= $_POST["database"];
	
	if(!$valid->validaEmail($email))										$erro[] = 'E-mail incorreto. Tente novamente.';		
	if(!$valid->validaString($senha, 8))									$erro[] = 'Informe uma senha com no mínimo 8 dígitos.';
	if(!$valid->validaString($servername, 3))								$erro[] = 'Informe o nome do servidor corretamente.';
	if(!$valid->validaString($username, 3))									$erro[] = 'Informe o nome do usuário do CMS.';
	if(!$valid->validaString($database, 3))									$erro[] = 'Informe o nome da base de dados corretamente.';
	if(!$valid->validaString($password, 3) and $servername!='localhost') 	$erro[] = 'Informe a senha do usuário do banco de dados corretamente.';

	if(empty($erro)){
		
		// Cria conexao
		$mysqli = new mysqli($servername, $username, $password, $database);
	
		
		// Check conexao
		if($mysqli->connect_errno){
			
		    printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		
		}else{
	
			$string = '<?php
			/**
			 * Connection properties
			 *
			 * @author: http://phpdao.com
			 * @date: 27.11.2007
			 */
			class ConnectionProperty{
				private static $host = "'. $r->limpa($servername). '";
				private static $user = "'. $r->limpa($username). '";
				private static $password = "'. $r->limpa($password). '";
				private static $database = "'. $r->limpa($database). '";
			
				public static function getHost(){
					return ConnectionProperty::$host;
				}
			
				public static function getUser(){
					return ConnectionProperty::$user;
				}
			
				public static function getPassword(){
					return ConnectionProperty::$password;
				}
			
				public static function getDatabase(){
					return ConnectionProperty::$database;
				}
			}
			?>';
			
			//Cria arquivo de conexao com a base
			$fp = fopen("templates/class/dao/sql/ConnectionProperty.class.php", "w");
			fwrite($fp, $string);
			fclose($fp);
			
			//Cria .htaccess
			$string_htaccess = '
				
				RewriteEngine On 
				RewriteCond %{REQUEST_FILENAME} !-f 
				RewriteCond %{REQUEST_FILENAME} !-d
				RewriteRule ^(.*)$ index.php?url=$1
				 
				#Redireciona o erro 
				ErrorDocument 404 /view/erro404.html
				ErrorDocument 500 /view/erro500.html 
			
			';
			
			$fpH = fopen(".htaccess", "w");
			fwrite($fpH, $string_htaccess);
			fclose($fpH);
			
			//Admin .htaccess
			$fpH = fopen("admin/.htaccess", "w");
			fwrite($fpH, $string_htaccess);
			fclose($fpH);
			
			//Caso o arquivo de conexao tenha sido criado, será criado as tabelas padroes do banco
			if(file_exists('templates/class/dao/sql/ConnectionProperty.class.php')){
					
				$senhaCript = md5(sha1($senha));
				
				/* Table: usuario */
				$mysqli->query("
				CREATE TABLE IF NOT EXISTS usuario (
				  idUsuario int(11) NOT NULL AUTO_INCREMENT,
				  nome varchar(255) NOT NULL,
				  email varchar(255) NOT NULL,
				  senha varchar(255) NOT NULL,
				  moderador int(1) NOT NULL,
				  gerente int(11) NOT NULL,
				  avisos int(11) NOT NULL,
				  obs varchar(555) NOT NULL,
				  status int(1) NOT NULL,
				  PRIMARY KEY (idUsuario)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ENGINE=InnoDB  ");
				
				
				/* Table: usuarioLog */
				$mysqli->query("
				  CREATE TABLE IF NOT EXISTS usuarioLog (
				  idUsuarioLog int(11) NOT NULL AUTO_INCREMENT,
				  ip varchar(255) COLLATE latin1_general_ci NOT NULL,
				  data datetime NOT NULL,
				  admin varchar(255) COLLATE latin1_general_ci NOT NULL,
				  tabela varchar(255) COLLATE latin1_general_ci NOT NULL,
				  acao varchar(255) COLLATE latin1_general_ci NOT NULL,
				  registro int(11) NOT NULL,
				  idUsuario int(11) NOT NULL,
				  PRIMARY KEY (idUsuarioLog)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ENGINE=InnoDB ");
				
				/* Table: permissao */
				$mysqli->query("
				CREATE TABLE IF NOT EXISTS permissao (
				  idPermissao int(11) NOT NULL AUTO_INCREMENT,
				  modulo int(1) NOT NULL,
				  permission varchar(3) NOT NULL,
				  status int(11) NOT NULL,
				  idUsuario int(11) NOT NULL,
				  PRIMARY KEY (idPermissao)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ENGINE=InnoDB ");
				
				/* Create table modulos and insert */
				$mysqli->query("
				CREATE TABLE IF NOT EXISTS modulo (
				  idModulo int(11) NOT NULL AUTO_INCREMENT,
				  ordem int(11) NOT NULL,
				  nome varchar(255) COLLATE latin1_general_ci NOT NULL,
				  alias varchar(255) COLLATE latin1_general_ci NOT NULL,
				  alt varchar(255) COLLATE latin1_general_ci NOT NULL,
				  descricao varchar(300) COLLATE latin1_general_ci NOT NULL,
				  icone varchar(55) COLLATE latin1_general_ci NOT NULL,
				  status varchar(1) COLLATE latin1_general_ci NOT NULL,
				  idModuloCategoria int(11) NOT NULL,
				  PRIMARY KEY (idModulo)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ENGINE=InnoDB ");

				/* Create table moduloCategoria and insert */
				$mysqli->query("
				CREATE TABLE IF NOT EXISTS moduloCategoria (
				  idModuloCategoria int(11) NOT NULL AUTO_INCREMENT,
				  nome varchar(255) NOT NULL,
				  status int(11) NOT NULL,
				  PRIMARY KEY (idModuloCategoria)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ENGINE=InnoDB ");

				/* Table: configuracao */
				$mysqli->query(" 
				CREATE TABLE IF NOT EXISTS configuracao (
				  idConfiguracao int(11) NOT NULL,
				  title varchar(255) NOT NULL,
				  description varchar(600) NOT NULL,
				  keywords varchar(255) NOT NULL,
				  idAnalytics varchar(255) NOT NULL,
				  diretorio varchar(255) NOT NULL,
				  emailHost varchar(255) NOT NULL,
				  emailUserName varchar(255) NOT NULL,
				  emailPassword varchar(255) NOT NULL,
				  emailPort int(3) NOT NULL,
				  PRIMARY KEY (idConfiguracao)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 ENGINE=InnoDB ");
				
				/* Table: album */
				$mysqli->query(" 
				CREATE TABLE IF NOT EXISTS album (
				  idAlbum int(11) NOT NULL AUTO_INCREMENT,
				  nome varchar(255) NOT NULL,
				  descricao varchar(6000) NOT NULL,
				  tipo int(1) NOT NULL,
				  status int(1) NOT NULL,
				  PRIMARY KEY (idAlbum)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ENGINE=InnoDB ");
				
				/* Table: albumMidia */
				$mysqli->query(" 
				CREATE TABLE IF NOT EXISTS albumMidia (
				  idAlbumMidia int(11) NOT NULL AUTO_INCREMENT,
				  idAlbum int(11) NOT NULL,
				  file varchar(255) NOT NULL,
				  nome varchar(255) NOT NULL,
				  alt varchar(5000) NOT NULL,
				  link varchar(255) NOT NULL,
				  target varchar(10) NOT NULL,
				  ordem int(1) NOT NULL,
				  status int(11) NOT NULL,
				  PRIMARY KEY (idAlbumMidia)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ENGINE=InnoDB ");
				
				/* Table: categoria */
				$mysqli->query(" 
				CREATE TABLE IF NOT EXISTS conteudoCategoria (
				  idConteudoCategoria int(11) NOT NULL AUTO_INCREMENT,
				  categoria varchar(255) NOT NULL,
				  alias varchar(255) NOT NULL,
				  status int(11) NOT NULL,
				  PRIMARY KEY (idConteudoCategoria)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ENGINE=InnoDB ");
				
				/* Table: contato */
				$mysqli->query("
				CREATE TABLE IF NOT EXISTS contato (
				  idContato int(11) NOT NULL AUTO_INCREMENT,
				  data datetime NOT NULL,
				  nome varchar(255) NOT NULL,
				  email varchar(255) NOT NULL,
				  assunto varchar(255) NOT NULL,
				  mensagem text NOT NULL,
				  status int(1) NOT NULL,
				  idFacebook varchar(255) NOT NULL,
				  PRIMARY KEY (idContato)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 ENGINE=InnoDB ");
				
				/* Table: conteudo */
				$mysqli->query("
				CREATE TABLE IF NOT EXISTS conteudo (
				  idConteudo int(1) NOT NULL AUTO_INCREMENT,
				  dataCad datetime NOT NULL,
				  dataAlt datetime NOT NULL,
				  titulo varchar(255) NOT NULL,
				  subtitulo varchar(255) NOT NULL,
				  alias varchar(255) NOT NULL,
				  texto varchar(6000) NOT NULL,
				  legendaCapa varchar(255) NOT NULL,
				  tipo varchar(55) NOT NULL,
				  capa varchar(255) NOT NULL,
				  capaTipo varchar(55) NOT NULL,
				  ordem int(11) NOT NULL,
				  tags varchar(255) NOT NULL,
				  status int(1) NOT NULL,
				  idAlbum int(11) NOT NULL,
				  idConteudoCategoria int(1) NOT NULL,
				  PRIMARY KEY (idConteudo)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 ENGINE=InnoDB ");

				/* Relacionamentos and Indices */
				$mysqli->query("
					ALTER TABLE `albumMidia`
				ADD CONSTRAINT `FK_albumMidia_9` FOREIGN KEY (`idAlbum`) REFERENCES `album` (`idAlbum`) on update no action on delete no action;");

				$mysqli->query("
					ALTER TABLE `conteudo`
				ADD CONSTRAINT `FK_conteudo_17` FOREIGN KEY (`idAlbum`) REFERENCES `album` (`idAlbum`) on update no action on delete no action,
				ADD CONSTRAINT `FK_conteudo_24` FOREIGN KEY (`idConteudoCategoria`) REFERENCES `conteudoCategoria` (`idConteudoCategoria`) on update no action on delete no action;");

				$mysqli->query("
					ALTER TABLE `modulo`
				ADD CONSTRAINT `FK_modulo_21` FOREIGN KEY (`idModuloCategoria`) REFERENCES `moduloCategoria` (`idModuloCategoria`) on update no action on delete no action;");

				$mysqli->query("
					ALTER TABLE `permissao`
				ADD CONSTRAINT `FK_permissao_20` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) on update cascade on delete cascade;");

				$mysqli->query("
					ALTER TABLE `usuarioLog`
				ADD CONSTRAINT `FK_usuarioLog_19` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) on update cascade on delete cascade;");

				/* Insert conteudoCategoria */
				$resCategoria = $mysqli->query("SELECT * FROM conteudoCategoria");
				if($resCategoria->num_rows==0){
					$mysqli->query("
					INSERT INTO `conteudoCategoria` (`idConteudoCategoria`, `categoria`, `alias`, `status`) VALUES
					(1, 'Not&iacute;cias', 'noticias', 1),
					(2, 'Portf&oacute;lio', 'portfolio', 1),
					(3, 'Sobre', 'sobre', 1),
					(4, 'Servi&ccedil;os', 'servicos', 1),
					(6, 'Depoimentos', 'depoimentos', 1);");
				}

				/* Insert moduloCategoria */
				$resMCategorias = $mysqli->query("SELECT * FROM moduloCategoria");
				if($resMCategorias->num_rows==0){
					$mysqli->query("
					INSERT INTO moduloCategoria (nome, status) VALUES
					('Conte&uacute;do', 1),
					('CRM', 1),
					('Config', 1)");
				}

				/* Insert album */
				$resAlbum = $mysqli->query("SELECT * FROM album");
				if($resAlbum->num_rows==0){
					$mysqli->query("
					INSERT INTO album (idAlbum, nome, descricao, tipo, status) 
										VALUES
					(1,'Home','Home page','3',1)");
				}

				/* Insert configuracao */
				$resConfig = $mysqli->query("SELECT * FROM configuracao");
				if($resConfig->num_rows==0){
					$mysqli->query("
					INSERT INTO configuracao (idConfiguracao, title, description, keywords, diretorio, emailHost, emailUserName, emailPassword) 
										VALUES
					(1,'CMS INFFUS', 'Descricao do site', 'site, cms, inffus', '$diretorio', '$emailHost', '$emailUserName', '$emailPassword')");
				}

				/* Insert usuario */
				$res = $mysqli->query("SELECT * FROM usuario");
				if($res->num_rows==0){
					$mysqli->query("INSERT INTO usuario (nome,email,senha,moderador,gerente,avisos,obs,status) VALUES
					('$email', '$email', '$senhaCript', 1, 1, 1, '', 1) "); 
				}

				/* Insert modulo */
				$resModulos = $mysqli->query("SELECT * FROM modulo");
				if($resModulos->num_rows==0){
					$mysqli->query("INSERT INTO modulo (ordem, nome, alias, alt, descricao, icone, idModuloCategoria, status) VALUES
					(1, 'Usu&aacute;rio', 'usuario', 'Gerenciamento de Usuários.', 'Crie e gerencie todos os usuários do site ou aplicação.', 'fa fa-user', 3, '1'),
					(2, 'Conte&uacute;do', 'conteudo', 'Gerenciamento de Conteúdo.', 'Crie e gerencie todo conteúdo do site ou aplicação.', 'fa fa-file', 1, '1'),
					(3, 'Conte&uacute;do Categoria', 'conteudo-categoria', 'Gerenciamento de categorias.', 'Crie e gerencie categorias.', 'fa fa-list', 2, '1'),
					(4, 'Contato', 'contato', 'Gerenciamento de Mensagens.', 'Gerencie as mensagens enviadas através do site ou aplicação.', 'fa fa-comment', 2, '1'),
					(5, '&Aacute;lbum', 'album', 'Gerenciamento de Álbuns.', 'Crie e gerencie álbuns de arquivos.', 'fa fa-picture-o', 1, '1'),
					(6, 'Blog', 'blog', 'Gerenciamento do blog.', 'Crie e gerencie artigos para seu blog.', 'fa fa-comments-o', 2, '1'),
					(7, 'Blog Categoria', 'blog-categoria', 'Gerenciamento de categorias para o blog.', 'Crie e gerencie categorias para seu blog.', 'fa fa-list', 2, '1'),
					(8, 'Configura&ccedil;&atilde;o', 'configuracao', 'Gerenciamento adminstrativo.', 'Configure informa&ccedil;&otilde;es importantes.', 'fa fa-cogs', 3, '1')
					"); 
				}
				
				//Fecha conexao					
				$mysqli->close();
				
				
				echo '<script>window.open("generate.php","_top");</script>';
				
			}
		
		}
		
	
	}// se nao existir erros
		
}// se existir post instalar	

	
?>




<!DOCTYPE html>
<html lang="pr-BR">
	
<head>
	
	<meta charset="utf-8">
	
	<title>CMS INFFUS - Instalação</title>
	
	<!-- Bootstrap core CSS -->
	<link href="inc/bootstrap/css/bootstrap.css" rel="stylesheet">
	
	<!-- Bootstrap Validation CSS -->
<!-- 	<link rel="stylesheet" href="inc/bootstrapvalidator/dist/css/bootstrapValidator.css"/> -->
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<!--[if gte IE 9]>
	  <style type="text/css">
	    .gradient {
	       filter: none;
	    }
	  </style>
	<![endif]-->
	
	<style>
	
		/*
		 * Base structure
		 */
		
		html,
		body {
		  height: 100%;
		  background-color: #FFF;
		}
		.site-wrapper {
			padding-top: 40px;
		  color: #fff;
		  text-align: center;
		  text-shadow: 0 1px 3px rgba(0,0,0,.5);
		}
		.site-wrapper-install{
			text-align: left !important;
			background: #FFF !important;
			color: #333 !important;
			text-shadow: none !important;
		}
		.site-wrapper-install .mastfoot{
			color: #333 !important;
		}
		
		
		/*
		 * Cover - tela de login e instalacoes
		 *
		 */
		 
		/* Extra markup and styles for table-esque vertical and horizontal centering */
		.site-wrapper {
		  display: table;
		  width: 100%;
		  height: 100%; /* For at least Firefox */
		  min-height: 100%;
		  background-color: #333;
		  -webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
		          box-shadow: inset 0 0 100px rgba(0,0,0,.5);
		}
		.site-wrapper-inner {
		  display: table-cell;
		  vertical-align: top;
		}
		.cover-container {
		  margin-right: auto;
		  margin-left: auto;
		}
		
		/* Padding for spacing */
		.inner {
		  padding: 30px;
		}
		
		
		/*
		 * Header
		 */
		.masthead-brand {
		  margin-top: 10px;
		  margin-bottom: 10px;
		}
		
		.masthead-nav > li {
		  display: inline-block;
		}
		.masthead-nav > li + li {
		  margin-left: 20px;
		}
		.masthead-nav > li > a {
		  padding-right: 0;
		  padding-left: 0;
		  font-size: 16px;
		  font-weight: bold;
		  color: #fff; /* IE8 proofing */
		  color: rgba(255,255,255,.75);
		  border-bottom: 2px solid transparent;
		}
		.masthead-nav > li > a:hover,
		.masthead-nav > li > a:focus {
		  background-color: transparent;
		  border-bottom-color: #a9a9a9;
		  border-bottom-color: rgba(255,255,255,.25);
		}
		.masthead-nav > .active > a,
		.masthead-nav > .active > a:hover,
		.masthead-nav > .active > a:focus {
		  color: #fff;
		  border-bottom-color: #fff;
		}
		
		@media (min-width: 768px) {
		  .masthead-brand {
		    float: left;
		  }
		  .masthead-nav {
		    float: right;
		  }
		}
		
		
		/*
		 * Cover
		 */
		
		.cover {
		  padding: 0 20px;
		}
		.cover .btn-lg {
		  padding: 10px 20px;
		  font-weight: bold;
		}
		
		
		/*
		 * Footer
		 */
		
		.mastfoot {
		  color: #999; /* IE8 proofing */
		  color: rgba(255,255,255,.5);
		}
		
		
		/*
		 * Affix and center
		 */
		
		@media (min-width: 768px) {
		  /* Pull out the header and footer */
		  .masthead {
		    position: fixed;
		    top: 0;
		  }
		  .mastfoot {
		/*     position: fixed; */
			margin-top: 40px;
		    bottom: 0;
		  }
		  /* Start the vertical centering */
		  .site-wrapper-inner {
		    vertical-align: middle;
		  }
		  /* Handle the widths */
		  .masthead,
		  .mastfoot,
		  .cover-container {
		    width: 100%; /* Must be percentage or pixels for horizontal alignment */
		  }
		}
		
		@media (min-width: 992px) {
		  .masthead,
		  .mastfoot,
		  .cover-container {
		    width: 1200px;
		  }
		}
	</style>
	
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script language="JavaScript" type="text/javascript" src="//code.jquery.com/jquery.js"></script>
	<script language="JavaScript" type="text/javascript" src="inc/bootstrap/js/bootstrap.min.js"></script>

</head>


<body>

	<div class="site-wrapper site-wrapper-install">
	
	  <div class="site-wrapper-inner">
	
	    <div class="cover-container">
	
	
	      <div class="inner cover">
		      
	        <h1 class="cover-heading">CMS INFFUS <span class="text-muted">Instalação</span></h1>
	        <p class="lead">Gerencie o conteúdo do seu Website e o relacionamento com seu Cliente através de de um sistema simples e funcional, pensado sob medida para seu negócio.</p>
			
			<hr>
	        
	        <form class="form-horizontal" method="post" action="">
		    
		    <div class="row">
			    
			    <div class="col-md-4">
			    
			    <h3 class="text-primary"><span class="text-muted">1. </span> Usuário do CMS</h3>
			    <p>Preencha os campos com o e-mail e senha que irá utilizar para acessar o CMS. Em seguida informe o nome do diretório onde será realizada a instalação, caso for direto no diretório root, deixe em branco.</p>
				<br>
				
				<div class="form-group">
			    <label for="email" class="col-sm-3 control-label">E-mail</label>
			    <div class="col-sm-9">
				<input type="text" class="form-control" placeholder="Endereço de e-mail" name="email" autofocus value="<?php echo $email; ?>">
			    </div>
				</div>
								
				<div class="form-group">
			    <label for="senha" class="col-sm-3 control-label">Senha</label>
			    <div class="col-sm-9">
				<input type="password" class="form-control" placeholder="Senha" name="senha" value="<?php echo $senha; ?>">
			    </div>
				</div>
				
				<div class="form-group">
			    <label for="email" class="col-sm-3 control-label">Diretório</label>
			    <div class="col-sm-9">
				<input type="text" class="form-control" placeholder="Deixei em branco se a instalação for na raiz" name="diretorio" autofocus value="<?php echo $diretorio; ?>">
			    </div>
				</div>
				
			    </div>
			    
			    
			    <div class="col-md-4">
				
				<h3 class="text-primary"><span class="text-muted">2. </span> Servidor de e-mails</h3>
				<p>Informe os dados do seu servidor de e-mails SMTP, e-mail de remetente e senha. Eles serão utilizados para realização e disparos com avisos e mensagens de usuários.</p><br>	
					
				<div class="form-group">
			    <label for="email" class="col-sm-4 control-label">User Name</label>
			    <div class="col-sm-8">
				<input type="text" class="form-control" placeholder="Endereço de e-mail remetente" name="emailUserName" autofocus value="<?php echo $emailUserName; ?>">
			    </div>
				</div>
								
				<div class="form-group">
			    <label for="senha" class="col-sm-4 control-label">Password</label>
			    <div class="col-sm-8">
				<input type="password" class="form-control" placeholder="Senha do e-mail remetente" name="emailPassword" value="<?php echo $emailPassword; ?>">
			    </div>
				</div>
				
				<div class="form-group">
			    <label for="email" class="col-sm-4 control-label">Email host</label>
			    <div class="col-sm-8">
				<input type="text" class="form-control" placeholder="Ex: smtp.site.com.br" name="emailHost" autofocus value="<?php echo $emailHost; ?>">
			    </div>
				</div>	
				
				<div class="form-group">
			    <label for="email" class="col-sm-4 control-label">Port</label>
			    <div class="col-sm-8">
				<input type="text" class="form-control" placeholder="587" name="emailPort" autofocus value="<?php echo $emailPort; ?>">
			    </div>
				</div>
				
				
			    </div> 
			    
				<div class="col-md-4">
				
				<h3 class="text-primary"><span class="text-muted">3. </span> Banco de dados</h3>
				<p>Os dados a seguir servirão para realizar a conexão com o bando de dados. Informe o nome do servidor, usuário, senha e nome do bancod de dados.</p><br>
					
				<div class="form-group">
			    <label for="servername" class="col-sm-3 control-label">Servername</label>
			    <div class="col-sm-9">
				<input type="text" class="form-control" placeholder="Servername" name="servername" value="<?php echo $servername; ?>">
			    </div>
				</div>
				
				<div class="form-group">
			    <label for="username" class="col-sm-3 control-label">Username</label>
			    <div class="col-sm-9">
				<input type="text" class="form-control" placeholder="Usuário" name="username" value="<?php echo $username; ?>">
			    </div>
				</div>
				
				<div class="form-group">
			    <label for="password" class="col-sm-3 control-label">Password</label>
			    <div class="col-sm-9">
				<input type="password" class="form-control" placeholder="password" name="password" value="<?php echo $password; ?>">
			    </div>
				</div>
				
				<div class="form-group">
			    <label for="database" class="col-sm-3 control-label">Database</label>
			    <div class="col-sm-9">
				<input type="text" class="form-control" placeholder="database de dados" name="database" value="<?php echo $database; ?>">
			    </div>
				</div>
				
				<p class="lead">
				<button name="instalar" class="btn btn-success pull-right" type="submit">Instalar</button>
				</p>
				
				</div>
			
			</div>
					
			</form>
	        
	        
	      </div>
	
	      <div class="mastfoot">
	        <div class="inner">
	          <p>Criado com <a href="http://getbootstrap.com" target="_blank">Bootstrap</a>, por <a href="https://inffus.com" target="_blank">Inffus</a>.</p>
	        </div>
	      </div>
	
	    </div>
	
	  </div><!-- //site-wrapper-inner -->
	
	</div><!-- //site-wrapper -->

	<?php include_once('include/alert.phtml'); ?>
</body>

</html>