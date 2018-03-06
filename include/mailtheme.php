<?php

$siteTitle = 'Kikoautos';
$siteDescription = 'Multimarcas . Multipossibilidades.';

$mail->Body = '

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>'.utf8_decode($siteTitle).'</title>
		</head>
	</head>
	   
	<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" style="margin: 0px; background-color: #666666; font-family: Helvetica, Arial, sans-serif;">
	<!--100% body table-->
	<table cellspacing="0" border="0" bgcolor="#666666" style="margin:0; padding: 0; border: 0;" width="100%" cellpadding="0">
		
		<tr style="margin: 0; padding: 0; border: 0;">
		  <td align="center" style="margin: 0; padding: 0; border: 0;">
		  <p>&nbsp;</p></td></tr>   
		
		<tr style="margin: 0; padding: 0; border: 0;">
			<td align="center" style="margin: 0; padding: 0; border: 0;">   
	   
	   
			<table align="center" cellpadding="0" cellspacing="0" border="0" width="560">
			  <tbody>
				<tr>
				  <td bgcolor="#666666"><img alt="'.utf8_decode($siteTitle).'" style="display:block" border="0" height="34" width="560" src="'.$_SERVER['HTTP_HOST'].'/assets/img/ass-top.jpg?'.uniqid().'" /></td>
				</tr>
				<tr>
				<td bgcolor="#FFFFFF">
					<div style="padding:0 20px 20px 20px;">'.$corpMail.'
					
					<br>
					<br>
					<br>
					--<br>
					<strong>'.utf8_decode($siteTitle).'</strong><br>
					'.utf8_decode($siteDescription).'<br>
					'.$_SERVER['HTTP_HOST'].'
					
					</div>
				</td>
				</tr>
				<tr>
				  <td><img alt="" style="display:block" border="0" height="20" width="560" src="'.$_SERVER['HTTP_HOST'].'/assets/img/ass-footer.jpg?'.uniqid().'" /></td>
				</tr>
			  </tbody>
			</table>
			<table border="0" cellspacing="0" cellpadding="0" align="center" width="524">
			  <tbody>
				<tr>
				  <td align="left"><div><br />
					Copyright &copy; '.date('Y').' '.utf8_decode($siteTitle).'. Todos os direitos reservados.<br />
				  </div></td>
				</tr>
			  </tbody>
			</table>
			
		  
		   </td>
		</tr>
		
		<tr style="margin: 0; padding: 0; border: 0;"><td align="center" style="margin: 0; padding: 0; border: 0;"><p>&nbsp;</p></td></tr> 
	</table>
	
		</body>
	</html>

';

?>