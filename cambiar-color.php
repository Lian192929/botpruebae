<?php

session_start();
error_reporting(0);
include_once('./css/index.php');

$auto = $_GET['veh'];

if(isset($_SESSION['User']))
{
	$User = $_SESSION['User'];
	try
	{
		$stmt = $con->prepare("SELECT * FROM usuarios WHERE Username = :usuario");
		$stmt->bindParam(':usuario', $User, PDO::PARAM_STR);
		$stmt->execute();
		
		$datos = $stmt->fetch();

		$name = $datos['Username'];
		$money = $datos['Money'];
		$fz = $datos['Moneda'];
		$ropa = $datos['Skin'];
		$platabanco = $datos['Banco'];
		$validarcorrero = $datos['CorreoValido'];
		$cambiacorreo = $datos['CambiaCorreo'];
		$correoacambiar = $datos['CorreoACambiar'];
		$tiempocorreo = $datos['TiempoCorreo'];
		$email = $datos['Email'];
		$faccion = $datos['Faccion'];
		$score = $datos['Nivel'];
		$estaonline = $datos['Online'];
		$razon = $datos['razon'];
		$ban = $datos['Baneado'];
		$Conexion = $datos['Conexion'];
		// Auto 1
		$auto1 = $datos['Modelo'];
		$V1Color1 = $datos['Color1'];
		$V1Color2 = $datos['Color2'];
		// Auto 2
		$auto2 = $datos['Modelo2'];
		$V2Color1 = $datos['2Color1'];
		$V2Color2 = $datos['2Color2'];
		// Auto 3
		$auto3 = $datos['Modelo3'];
		$V3Color1 = $datos['3Color1'];
		$V3Color2 = $datos['3Color2'];
		// Auto 4
		$auto4 = $datos['Modelo4'];
		$V4Color1 = $datos['4Color1'];
		$V4Color2 = $datos['4Color2'];

		unset($datos); //Borrar variable datos
	}
	catch(PDOException $e)
	{
		echo 'Error: ' . $e->getMessage();
	}

	if(isset($_POST['enviar']))
	{
		$auto = $_POST['veh'];
		//$fz = $fz-3;
	}

	if($auto == 1)
	{
		$autocoche = $auto1;
		$autocochec1 = $V1Color1;
		$autocochec2 = $V1Color2;
	}
	if($auto == 2)
	{
		$autocoche = $auto2;
		$autocochec1 = $V2Color1;
		$autocochec2 = $V2Color2;
	}
	if($auto == 3)
	{
		$autocoche = $auto3;
		$autocochec1 = $V3Color1;
		$autocochec2 = $V3Color2;
	}
	if($auto == 4)
	{
		$autocoche = $auto4;
		$autocochec1 = $V4Color1;
		$autocochec2 = $V4Color2;
	}

	if(isset($_POST['enviar']))
	{
		if($auto == 1)
		{
			$autocoche = $auto1;
			$autocochec1 = $_POST['color1'];
			$autocochec2 = $_POST['color2'];
		}
		if($auto == 2)
		{
			$autocoche = $auto2;
			$autocochec1 = $_POST['color1'];
			$autocochec2 = $_POST['color2'];
		}
		if($auto == 3)
		{
			$autocoche = $auto3;
			$autocochec1 = $_POST['color1'];
			$autocochec2 = $_POST['color2'];
		}
		if($auto == 4)
		{
			$autocoche = $auto4;
			$autocochec1 = $_POST['color1'];
			$autocochec2 = $_POST['color2'];
		}
	}

}
else echo "<script>window.location='ingresar.php';</script>";
$dinerototal = $money+$platabanco;

if($Conexion == '1')
{
	echo "<script>window.location='reg.php?u=2';</script>";
}
?>

<?php
function validarCadena($cadena)
{
	if(strlen($cadena) > 1)
	{
		return false;
	}
    $permitidos = "1234";
    for ($i=0; $i<strlen($cadena); $i++)
	{
		if (strpos($permitidos, substr($cadena,$i,1))===false)
		{
			return false;
		}
    }
    return true;
}

function validarCadenaColor($cadena)
{
	if(strlen($cadena) > 3)
	{
		return false;
	}
    $permitidos = "0123456789";
    for ($i=0; $i<strlen($cadena); $i++)
	{
		if (strpos($permitidos, substr($cadena,$i,1))===false)
		{
			return false;
		}
    }
    return true;
}

$tucuentaAC = "-ac";
$mcuenta = "actual1";

?>

<?php
require("./conectados/samp_query.php");
try
{
    $rQuery = new QueryServer( $serverIP2, $serverPort );

    $aInformation = $rQuery->GetInfo( );
    $aServerRules = $rQuery->GetRules( );
    $aBasicPlayer = $rQuery->GetPlayers( );
    $aTotalPlayers = $rQuery->GetDetailedPlayers( );

    $rQuery->Close( );
}
catch (QueryServerException $pError)
{

}

$coloresveh = array(
"000000", "FFFFFF", "40868D", "9E1F25", "3E4C42", "9E596A", "F7A125", "6187A5", "DACDB0", "738471", "5E6D75", "7E7E75", "728F83", "6F6D5C", "EEE4BD", "BAB197", "457545", "8C262A", "902438", "BBAB8A",
"516273", "8C4445", "803543", "AEA283", "6C685C", "53534D", "BDB798", "7C6E5C", "525F66", "AEA489", "5C3533", "733D38", "9DA39B", "8D8E76", "7D7765", "706958", "3E3C36", "42503F", "ACB28B", "828E81",
"343329", "8A7D5E", "9A3438", "732427", "305036", "72342C", "B9A86B", "90865F", "AEA37F", "C9BE9C", "9D9A81", "44664D", "617566", "2E3A4D", "3F4450", "9A765B", "BAB19B", "B99C6B", "812E33", "627D78",
"B9AA8B", "AB864D", "7E3435", "ACAA8E", "BDB298", "AA9C4D", "4D342B", "808D82", "C0BA83", "C8A884", "9E353A", "83938B", "6F6D59", "B0B284", "7B3434", "333639", "BDB08B", "C0AB7E", "8F3A38", "21496A",
"8B4145", "90845D", "8C3436", "33443E", "61493A", "9A344D", "436E2C", "506E7E", "824141", "BEB184", "C9BE9C", "4E595A", "817E6A", "227E81", "336069", "41525A", "B0AF8D", "80938A", "619389", "C8A876",
"547F84", "333C42", "C0A272", "24596B", "AD9269", "7D7D68", "226278", "BCA97E", "4F6989", "6C695F", "9A7E5B", "A1A28B", "6F7F7F", "5E4A3E", "5D7551", "8C2436", "344A5A", "7C252B", "BCB9AF", "7F6958",
"B09A77", "7B242B", "706F5D", "7B5936", "8B2E36", "304864", "f27491", "171a18", "2c7c28", "361f1c", "27616b", "573e22", "67342d", "172019", "393757", "3f8e8e", "975b9b", "489841", "c1b497", "585a7a",
"918c79", "8f7f60", "8f8133", "795d65", "694f65", "98b668", "905d6b", "7c3b62", "333325", "332b1c", "343929", "40553a", "335a82", "416a47", "339b4a", "339b83", "a59b6a", "8a8a83", "a5412d", "40341e",
"29391d", "a54f4e", "335a83", "2d8772", "2f3d35", "2b6c65", "307076", "7b4f83", "5a3022", "887b83", "827783", "644a70", "36391d", "513021", "583722", "a5342d", "9a5a7a", "8d6771", "894f70", "4e2e3e",
"824728", "862f29", "91462b", "9a422c", "8b4f52", "8a766e", "192419", "1d391d", "2b4325", "2b432b", "743e4f", "498a51", "a5977c", "8f9181", "a59b2d", "8d9b4d", "90957d", "868830", "3f4d83", "4c4b20",
"967f4e", "24354b", "2a482c", "2a3b40", "4a646a", "1c212e", "1d2b33", "344a4c", "3f5d77", "2a5264", "264550", "382d5d", "793527", "9a917f", "626b25", "1f2719", "986441", "638d7b", "a56851", "a5642d",
"a54c5d", "a5934f", "a5432d", "232f46", "63342d", "545222", "5e9b2d", "1e3e2d", "a1872c", "2e852a", "4e2b2e", "825f28", "954f79", "8d3064", "214820", "3b5522", "1d3531", "865568", "987041", "823a28",
"44977c", "67972d", "682d42", "2f8e39", "4a2d20", "1a2f1b", "48697a", "414f57", "673034", "5f2633", "7e745f", "4e4f46", "41403b", "89846f", "5c5446", "3c464e"
);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $NombreServidor?> Roleplay - <?php include_once('./kev/idioma.php'); echo $Texto_Index_14;?></title>
<link rel="stylesheet" type="text/css" href="./css/estilos3.css"> 
<link rel="shortcut icon" href="./imagenes/favicon/favicon.ico" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>


<script type="text/javascript">
$(document).ready(function(){

  $(".rounded-img").load(function() {
    $(this).wrap(function(){
      return '<span class="' + $(this).attr('class') + '" style="background:url(' + $(this).attr('src') + ') no-repeat center center; width: ' + $(this).width() + 'px; height: ' + $(this).height() + 'px;" />';
    });
    $(this).css("opacity","0");
  });


});
</script>

<script>
	function PonerColor(imp,color,rg)
	{
		if(imp == 1)
		{
			document.getElementById("color1").value = color;
			$('#boxcolor1').css("background-color",rg);
		}
		else
		{
			document.getElementById("color2").value = color;
			$('#boxcolor2').css("background-color",rg);
		}
	}
    $(document).ready(function()
	{
      $('#cambiar-color1').click(function()
	  {
		$('#slickbox2').fadeOut(100);
        $('#slickbox').toggle(400);
        return false;
      });
	  $('#cambiar-color2').click(function()
	  {
		$('#slickbox').fadeOut(100);
        $('#slickbox2').toggle(400);
        return false;
      });
	  $('html').click(function() {
	   $('#slickbox').fadeOut(1000);
	    $('#slickbox2').fadeOut(1000);
	 	});

    });
</script>

<style>.ft1{width:300px;float:left;padding:10px;margin-left:35px;}.ft2{width:300px;float:left;padding:10px;}.ft1 img{background-color:#FFFFFF;padding:5px;border:solid 1px #CCCCCC;width:250px;height:150px}.ft2 img{background-color:#FFFFFF;padding:5px;border:solid 1px #CCCCCC;width:250px;height:150px}.datos2{background-color:#FFFFFF;padding:5px;float:left;width:250px;border-left:solid 1px #CCCCCC;border-right:solid 1px #CCCCCC;border-bottom:solid 1px #CCCCCC;}.datos2 span{text-align:right;float:right;font-weight:bold}.ft1 a{background-image:url(./imagenes/iconos/carrito.png);background-repeat:no-repeat;height:16px;padding-left:20px;width:0;float:right;overflow:hidden;margin-left:5px;}.ft2 a{background-image:url(./imagenes/iconos/carrito.png);background-repeat:no-repeat;height:16px;padding-left:20px;width:0;float:right;overflow:hidden;margin-left:5px;}</style>

</head>

<body>

<table width="997" border="0" cellpadding="0" cellspacing="0" bgcolor="#E4E4E4" align="center">



<tbody><tr>

<td width="997">

<script async="" src="//www.google-analytics.com/analytics.js"></script><script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');



  ga('create', 'UA-16687198-9', 'auto');

  ga('send', 'pageview');



</script>

<?php include("header.php"); ?>

<div id="contenido">
<div id="contenido-izquierdo">



<?php

if(isset($_POST['enviar']))
{

$cc1 = $_POST['color1'];
$cc2 = $_POST['color2'];
$auto = $_POST['veh'];

if(validarCadena($auto) == true)
{
	if($auto == 1)
	{
		if(isset($_POST['color1']) && isset($_POST['color2']))
		{
			if(validarCadenaColor($_POST['color1']) == true && validarCadenaColor($_POST['color2']) == true)
			{
				if($estaonline == 0)
				{
					if($fz > 2)
					{
						$stmt = $con->prepare("UPDATE usuarios SET Moneda = Moneda-3 WHERE Username = :usuario");
						$stmt->bindParam(':usuario', $User, PDO::PARAM_STR);
						$stmt->execute();
						

						$stmt = $con->prepare("UPDATE usuarios SET Color1 = :ccc1, Color2 = :ccc2 WHERE Username= :usuario");
						$stmt->bindParam(':ccc1', $cc1, PDO::PARAM_INT); 
						$stmt->bindParam(':ccc2', $cc2, PDO::PARAM_INT); 
						$stmt->bindParam(':usuario', $User, PDO::PARAM_STR);
						$stmt->execute();
						

						$fz = $fz-3;

						echo '<div class="login" style="padding:5px;top:20px;background-color:#06AD00; color:#FFFFFF; width:667px; text-align:center;"><strong>Veh&iacute;culo pintado correctamente (-3';?><?php echo $Diminutivo?><?php echo ")";?><?php echo '</strong></div>';
					}
					else
					{
						echo '<div class="login" style="padding:5px;top:20px;background-color:#F00; color:#FFFFFF; width:667px; text-align:center;"><strong>No tienes los ';?><?php echo $Diminutivo?><?php echo ' necesarios (3)</strong></div>';
					}
				}
				else
				{
					echo '<div class="login" style="padding:5px;top:20px;background-color:#F00; color:#FFFFFF; width:667px; text-align:center;"><strong>Tienes que estar desconectado para poder pintar tu vehiculo.</strong></div>';
				}
			}
		}
	}
	if($auto == 2)
	{
		if(isset($_POST['color1']) && isset($_POST['color2']))
		{
			if(validarCadenaColor($_POST['color1']) == true && validarCadenaColor($_POST['color2']) == true)
			{
				if($estaonline == 0)
				{
					if($fz > 2)
					{
						$stmt = $con->prepare("UPDATE usuarios SET Moneda = Moneda-3 WHERE Username = :usuario");
						$stmt->bindParam(':usuario', $User, PDO::PARAM_STR);
						$stmt->execute();
						

						$stmt = $con->prepare("UPDATE usuarios SET 2Color1 = :ccc1, 2Color2 = :ccc2 WHERE Username= :usuario");
						$stmt->bindParam(':ccc1', $cc1, PDO::PARAM_INT); 
						$stmt->bindParam(':ccc2', $cc2, PDO::PARAM_INT); 
						$stmt->bindParam(':usuario', $User, PDO::PARAM_STR);
						$stmt->execute();
						

						$fz = $fz-3;

						echo '<div class="login" style="padding:5px;top:20px;background-color:#06AD00; color:#FFFFFF; width:667px; text-align:center;"><strong>Veh&iacute;culo pintado correctamente (-3';?><?php echo $Diminutivo?><?php echo ")";?><?php echo '</strong></div>';
					}
					else
					{
						echo '<div class="login" style="padding:5px;top:20px;background-color:#F00; color:#FFFFFF; width:667px; text-align:center;"><strong>No tienes los ';?><?php echo $Diminutivo?><?php echo ' necesarios (3)</strong></div>';
					}
				}
				else
				{
					echo '<div class="login" style="padding:5px;top:20px;background-color:#F00; color:#FFFFFF; width:667px; text-align:center;"><strong>Tienes que estar desconectado para poder pintar tu vehiculo.</strong></div>';
				}
			}
		}
	}
	if($auto == 3)
	{
		if(isset($_POST['color1']) && isset($_POST['color2']))
		{
			if(validarCadenaColor($_POST['color1']) == true && validarCadenaColor($_POST['color2']) == true)
			{
				if($estaonline == 0)
				{
					if($fz > 2)
					{
						$stmt = $con->prepare("UPDATE usuarios SET Moneda = Moneda-3 WHERE Username = :usuario");
						$stmt->bindParam(':usuario', $User, PDO::PARAM_STR);
						$stmt->execute();
						

						$stmt = $con->prepare("UPDATE usuarios SET 3Color1 = :ccc1, 3Color2 = :ccc2 WHERE Username= :usuario");
						$stmt->bindParam(':ccc1', $cc1, PDO::PARAM_INT); 
						$stmt->bindParam(':ccc2', $cc2, PDO::PARAM_INT); 
						$stmt->bindParam(':usuario', $User, PDO::PARAM_STR);
						$stmt->execute();
						

						$fz = $fz-3;

						echo '<div class="login" style="padding:5px;top:20px;background-color:#06AD00; color:#FFFFFF; width:667px; text-align:center;"><strong>Veh&iacute;culo pintado correctamente (-3';?><?php echo $Diminutivo?><?php echo ")";?><?php echo '</strong></div>';
					}
					else
					{
						echo '<div class="login" style="padding:5px;top:20px;background-color:#F00; color:#FFFFFF; width:667px; text-align:center;"><strong>No tienes los ';?><?php echo $Diminutivo?><?php echo ' necesarios (3)</strong></div>';
					}
				}
				else
				{
					echo '<div class="login" style="padding:5px;top:20px;background-color:#F00; color:#FFFFFF; width:667px; text-align:center;"><strong>Tienes que estar desconectado para poder pintar tu vehiculo.</strong></div>';
				}
			}
		}
	}
	if($auto == 4)
	{
		if(isset($_POST['color1']) && isset($_POST['color2']))
		{
			if(validarCadenaColor($_POST['color1']) == true && validarCadenaColor($_POST['color2']) == true)
			{
				if($estaonline == 0)
				{
					if($fz > 2)
					{
						$stmt = $con->prepare("UPDATE usuarios SET Moneda = Moneda-3 WHERE Username = :usuario");
						$stmt->bindParam(':usuario', $User, PDO::PARAM_STR);
						$stmt->execute();
						

						$stmt = $con->prepare("UPDATE usuarios SET 4Color1 = :ccc1, 4Color2 = :ccc2 WHERE Username= :usuario");
						$stmt->bindParam(':ccc1', $cc1, PDO::PARAM_INT); 
						$stmt->bindParam(':ccc2', $cc2, PDO::PARAM_INT); 
						$stmt->bindParam(':usuario', $User, PDO::PARAM_STR);
						$stmt->execute();
						

						$fz = $fz-3;

						echo '<div class="login" style="padding:5px;top:20px;background-color:#06AD00; color:#FFFFFF; width:667px; text-align:center;"><strong>Veh&iacute;culo pintado correctamente (-3';?><?php echo $Diminutivo?><?php echo ")";?><?php echo '</strong></div>';
					}
					else
					{
						echo '<div class="login" style="padding:5px;top:20px;background-color:#F00; color:#FFFFFF; width:667px; text-align:center;"><strong>No tienes los ';?><?php echo $Diminutivo?><?php echo ' necesarios (3)</strong></div>';
					}
				}
				else
				{
					echo '<div class="login" style="padding:5px;top:20px;background-color:#F00; color:#FFFFFF; width:667px; text-align:center;"><strong>Tienes que estar desconectado para poder pintar tu vehiculo.</strong></div>';
				}
			}
		}
	}
	if($auto > 4)
	{
?>
		<script language="javascript">alert("Error 3");</script>
<?php
		session_start();
		session_destroy();
		echo "<script>window.location='index.php';</script>";
	}
}
else
{
?>
	<script language="javascript">alert("Error 4");</script>
<?php
	session_start();
    session_destroy();
	echo "<script>window.location='index.php';</script>";
}

}
?>



<div id="contenido-izquierdo">
<div class="td-gr">
<div class="icono-td"><img src="imagenes/iconos/auto2.png"/></div>
<div style="height:22px;font-weight:bold; font-size:14px;text-shadow:0 1px 0 #FFFFFF;color:#305B79;padding-top:8px; margin-left:10px; margin-left:34px"><?php echo $Texto_Index_95;?></div>
<div style="padding:10px; float:left; width:610px; margin-left:22px">
<table width="610" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">

<tr>
<td height="22" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><strong><font size="2px"><?php echo GetVehicleName($autocoche);?></strong></td>
</tr>
<tr>
<td height="180" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF">
<div style="border: solid 1px #999999; margin-left:173px; padding:5px;margin-right:173px; background-color:#F5F5F5"><img src="imagenes/autos/<?php echo $autocoche?>.jpg"/></div>
</td>
</tr>

<form method="post" action="cambiar-color.php">

<input name="veh" type="hidden" value="<?php echo $auto;?>"/>
<tr>
<td height="44" valign="middle" bgcolor="#FFFFFF" width="250">&nbsp;<font size="2px"><?php echo $Texto_Index_144;?>: </td>
<td align="center" valign="middle" bgcolor="#FFFFFF">

<div style="background-color:#F5F5F5;margin-left:10px;float:left; width:26px; height:22px;border-top:1px solid #999999;border-left:1px solid #999999;border-bottom:1px solid #999999;margin-top:2px; padding-left:2px;padding:5px">
<input name="color1" id="color1" type="text" value="<?php echo $autocochec1?>" style="width:24px" readonly="1"/>
</div>

<div id="boxcolor1" style="border:1px solid #999999; background-color:#<?php echo $coloresveh[''.$autocochec1.'']?>;float:left; width:74px; height:22px;margin-top:2px;padding:5px"></div>
<div style="float:left; width:40px; height:40px; margin-left:5px;"><img src="imagenes/baldes.gif" align="absmiddle" style="cursor:pointer" alt="<?php echo $Texto_Index_148;?>" title="<?php echo $Texto_Index_148;?>" id="cambiar-color1"/></div>
<div id="slickbox" style="display:none; float:left; font-size:11px;border-top:solid 1px #D6D6D6;border-left:solid 1px #D6D6D6; width:560px; margin-left: -220px; margin-top: 36px;position: absolute;">
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#000000;cursor:pointer;" onClick="javascript:PonerColor('1','0','#000000')" title="Seleccionar el color 0 como primario">0</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#FFFFFF;cursor:pointer;" onClick="javascript:PonerColor('1','1','#FFFFFF')" title="Seleccionar el color 1 como primario">1</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#40868D;cursor:pointer;" onClick="javascript:PonerColor('1','2','#40868D')" title="Seleccionar el color 2 como primario">2</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9E1F25;cursor:pointer;" onClick="javascript:PonerColor('1','3','#9E1F25')" title="Seleccionar el color 3 como primario">3</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3E4C42;cursor:pointer;" onClick="javascript:PonerColor('1','4','#3E4C42')" title="Seleccionar el color 4 como primario">4</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9E596A;cursor:pointer;" onClick="javascript:PonerColor('1','5','#9E596A')" title="Seleccionar el color 5 como primario">5</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#F7A125;cursor:pointer;" onClick="javascript:PonerColor('1','6','#F7A125')" title="Seleccionar el color 6 como primario">6</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6187A5;cursor:pointer;" onClick="javascript:PonerColor('1','7','#6187A5')" title="Seleccionar el color 7 como primario">7</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#DACDB0;cursor:pointer;" onClick="javascript:PonerColor('1','8','#DACDB0')" title="Seleccionar el color 8 como primario">8</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#738471;cursor:pointer;" onClick="javascript:PonerColor('1','9','#738471')" title="Seleccionar el color 9 como primario">9</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5E6D75;cursor:pointer;" onClick="javascript:PonerColor('1','10','#5E6D75')" title="Seleccionar el color 10 como primario">10</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7E7E75;cursor:pointer;" onClick="javascript:PonerColor('1','11','#7E7E75')" title="Seleccionar el color 11 como primario">11</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#728F83;cursor:pointer;" onClick="javascript:PonerColor('1','12','#728F83')" title="Seleccionar el color 12 como primario">12</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6F6D5C;cursor:pointer;" onClick="javascript:PonerColor('1','13','#6F6D5C')" title="Seleccionar el color 13 como primario">13</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#EEE4BD;cursor:pointer;" onClick="javascript:PonerColor('1','14','#EEE4BD')" title="Seleccionar el color 14 como primario">14</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BAB197;cursor:pointer;" onClick="javascript:PonerColor('1','15','#BAB197')" title="Seleccionar el color 15 como primario">15</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#457545;cursor:pointer;" onClick="javascript:PonerColor('1','16','#457545')" title="Seleccionar el color 16 como primario">16</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8C262A;cursor:pointer;" onClick="javascript:PonerColor('1','17','#8C262A')" title="Seleccionar el color 17 como primario">17</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#902438;cursor:pointer;" onClick="javascript:PonerColor('1','18','#902438')" title="Seleccionar el color 18 como primario">18</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BBAB8A;cursor:pointer;" onClick="javascript:PonerColor('1','19','#BBAB8A')" title="Seleccionar el color 19 como primario">19</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#516273;cursor:pointer;" onClick="javascript:PonerColor('1','20','#516273')" title="Seleccionar el color 20 como primario">20</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8C4445;cursor:pointer;" onClick="javascript:PonerColor('1','21','#8C4445')" title="Seleccionar el color 21 como primario">21</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#803543;cursor:pointer;" onClick="javascript:PonerColor('1','22','#803543')" title="Seleccionar el color 22 como primario">22</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AEA283;cursor:pointer;" onClick="javascript:PonerColor('1','23','#AEA283')" title="Seleccionar el color 23 como primario">23</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6C685C;cursor:pointer;" onClick="javascript:PonerColor('1','24','#6C685C')" title="Seleccionar el color 24 como primario">24</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#53534D;cursor:pointer;" onClick="javascript:PonerColor('1','25','#53534D')" title="Seleccionar el color 25 como primario">25</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BDB798;cursor:pointer;" onClick="javascript:PonerColor('1','26','#BDB798')" title="Seleccionar el color 26 como primario">26</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7C6E5C;cursor:pointer;" onClick="javascript:PonerColor('1','27','#7C6E5C')" title="Seleccionar el color 27 como primario">27</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#525F66;cursor:pointer;" onClick="javascript:PonerColor('1','28','#525F66')" title="Seleccionar el color 28 como primario">28</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AEA489;cursor:pointer;" onClick="javascript:PonerColor('1','29','#AEA489')" title="Seleccionar el color 29 como primario">29</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5C3533;cursor:pointer;" onClick="javascript:PonerColor('1','30','#5C3533')" title="Seleccionar el color 30 como primario">30</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#733D38;cursor:pointer;" onClick="javascript:PonerColor('1','31','#733D38')" title="Seleccionar el color 31 como primario">31</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9DA39B;cursor:pointer;" onClick="javascript:PonerColor('1','32','#9DA39B')" title="Seleccionar el color 32 como primario">32</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8D8E76;cursor:pointer;" onClick="javascript:PonerColor('1','33','#8D8E76')" title="Seleccionar el color 33 como primario">33</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7D7765;cursor:pointer;" onClick="javascript:PonerColor('1','34','#7D7765')" title="Seleccionar el color 34 como primario">34</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#706958;cursor:pointer;" onClick="javascript:PonerColor('1','35','#706958')" title="Seleccionar el color 35 como primario">35</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3E3C36;cursor:pointer;" onClick="javascript:PonerColor('1','36','#3E3C36')" title="Seleccionar el color 36 como primario">36</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#42503F;cursor:pointer;" onClick="javascript:PonerColor('1','37','#42503F')" title="Seleccionar el color 37 como primario">37</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#ACB28B;cursor:pointer;" onClick="javascript:PonerColor('1','38','#ACB28B')" title="Seleccionar el color 38 como primario">38</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#828E81;cursor:pointer;" onClick="javascript:PonerColor('1','39','#828E81')" title="Seleccionar el color 39 como primario">39</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#343329;cursor:pointer;" onClick="javascript:PonerColor('1','40','#343329')" title="Seleccionar el color 40 como primario">40</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8A7D5E;cursor:pointer;" onClick="javascript:PonerColor('1','41','#8A7D5E')" title="Seleccionar el color 41 como primario">41</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9A3438;cursor:pointer;" onClick="javascript:PonerColor('1','42','#9A3438')" title="Seleccionar el color 42 como primario">42</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#732427;cursor:pointer;" onClick="javascript:PonerColor('1','43','#732427')" title="Seleccionar el color 43 como primario">43</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#305036;cursor:pointer;" onClick="javascript:PonerColor('1','44','#305036')" title="Seleccionar el color 44 como primario">44</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#72342C;cursor:pointer;" onClick="javascript:PonerColor('1','45','#72342C')" title="Seleccionar el color 45 como primario">45</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B9A86B;cursor:pointer;" onClick="javascript:PonerColor('1','46','#B9A86B')" title="Seleccionar el color 46 como primario">46</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#90865F;cursor:pointer;" onClick="javascript:PonerColor('1','47','#90865F')" title="Seleccionar el color 47 como primario">47</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AEA37F;cursor:pointer;" onClick="javascript:PonerColor('1','48','#AEA37F')" title="Seleccionar el color 48 como primario">48</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C9BE9C;cursor:pointer;" onClick="javascript:PonerColor('1','49','#C9BE9C')" title="Seleccionar el color 49 como primario">49</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9D9A81;cursor:pointer;" onClick="javascript:PonerColor('1','50','#9D9A81')" title="Seleccionar el color 50 como primario">50</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#44664D;cursor:pointer;" onClick="javascript:PonerColor('1','51','#44664D')" title="Seleccionar el color 51 como primario">51</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#617566;cursor:pointer;" onClick="javascript:PonerColor('1','52','#617566')" title="Seleccionar el color 52 como primario">52</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2E3A4D;cursor:pointer;" onClick="javascript:PonerColor('1','53','#2E3A4D')" title="Seleccionar el color 53 como primario">53</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3F4450;cursor:pointer;" onClick="javascript:PonerColor('1','54','#3F4450')" title="Seleccionar el color 54 como primario">54</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9A765B;cursor:pointer;" onClick="javascript:PonerColor('1','55','#9A765B')" title="Seleccionar el color 55 como primario">55</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BAB19B;cursor:pointer;" onClick="javascript:PonerColor('1','56','#BAB19B')" title="Seleccionar el color 56 como primario">56</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B99C6B;cursor:pointer;" onClick="javascript:PonerColor('1','57','#B99C6B')" title="Seleccionar el color 57 como primario">57</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#812E33;cursor:pointer;" onClick="javascript:PonerColor('1','58','#812E33')" title="Seleccionar el color 58 como primario">58</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#627D78;cursor:pointer;" onClick="javascript:PonerColor('1','59','#627D78')" title="Seleccionar el color 59 como primario">59</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B9AA8B;cursor:pointer;" onClick="javascript:PonerColor('1','60','#B9AA8B')" title="Seleccionar el color 60 como primario">60</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AB864D;cursor:pointer;" onClick="javascript:PonerColor('1','61','#AB864D')" title="Seleccionar el color 61 como primario">61</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7E3435;cursor:pointer;" onClick="javascript:PonerColor('1','62','#7E3435')" title="Seleccionar el color 62 como primario">62</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#ACAA8E;cursor:pointer;" onClick="javascript:PonerColor('1','63','#ACAA8E')" title="Seleccionar el color 63 como primario">63</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BDB298;cursor:pointer;" onClick="javascript:PonerColor('1','64','#BDB298')" title="Seleccionar el color 64 como primario">64</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AA9C4D;cursor:pointer;" onClick="javascript:PonerColor('1','65','#AA9C4D')" title="Seleccionar el color 65 como primario">65</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4D342B;cursor:pointer;" onClick="javascript:PonerColor('1','66','#4D342B')" title="Seleccionar el color 66 como primario">66</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#808D82;cursor:pointer;" onClick="javascript:PonerColor('1','67','#808D82')" title="Seleccionar el color 67 como primario">67</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C0BA83;cursor:pointer;" onClick="javascript:PonerColor('1','68','#C0BA83')" title="Seleccionar el color 68 como primario">68</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C8A884;cursor:pointer;" onClick="javascript:PonerColor('1','69','#C8A884')" title="Seleccionar el color 69 como primario">69</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9E353A;cursor:pointer;" onClick="javascript:PonerColor('1','70','#9E353A')" title="Seleccionar el color 70 como primario">70</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#83938B;cursor:pointer;" onClick="javascript:PonerColor('1','71','#83938B')" title="Seleccionar el color 71 como primario">71</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6F6D59;cursor:pointer;" onClick="javascript:PonerColor('1','72','#6F6D59')" title="Seleccionar el color 72 como primario">72</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B0B284;cursor:pointer;" onClick="javascript:PonerColor('1','73','#B0B284')" title="Seleccionar el color 73 como primario">73</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7B3434;cursor:pointer;" onClick="javascript:PonerColor('1','74','#7B3434')" title="Seleccionar el color 74 como primario">74</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#333639;cursor:pointer;" onClick="javascript:PonerColor('1','75','#333639')" title="Seleccionar el color 75 como primario">75</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BDB08B;cursor:pointer;" onClick="javascript:PonerColor('1','76','#BDB08B')" title="Seleccionar el color 76 como primario">76</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C0AB7E;cursor:pointer;" onClick="javascript:PonerColor('1','77','#C0AB7E')" title="Seleccionar el color 77 como primario">77</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8F3A38;cursor:pointer;" onClick="javascript:PonerColor('1','78','#8F3A38')" title="Seleccionar el color 78 como primario">78</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#21496A;cursor:pointer;" onClick="javascript:PonerColor('1','79','#21496A')" title="Seleccionar el color 79 como primario">79</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8B4145;cursor:pointer;" onClick="javascript:PonerColor('1','80','#8B4145')" title="Seleccionar el color 80 como primario">80</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#90845D;cursor:pointer;" onClick="javascript:PonerColor('1','81','#90845D')" title="Seleccionar el color 81 como primario">81</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8C3436;cursor:pointer;" onClick="javascript:PonerColor('1','82','#8C3436')" title="Seleccionar el color 82 como primario">82</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#33443E;cursor:pointer;" onClick="javascript:PonerColor('1','83','#33443E')" title="Seleccionar el color 83 como primario">83</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#61493A;cursor:pointer;" onClick="javascript:PonerColor('1','84','#61493A')" title="Seleccionar el color 84 como primario">84</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9A344D;cursor:pointer;" onClick="javascript:PonerColor('1','85','#9A344D')" title="Seleccionar el color 85 como primario">85</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#436E2C;cursor:pointer;" onClick="javascript:PonerColor('1','86','#436E2C')" title="Seleccionar el color 86 como primario">86</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#506E7E;cursor:pointer;" onClick="javascript:PonerColor('1','87','#506E7E')" title="Seleccionar el color 87 como primario">87</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#824141;cursor:pointer;" onClick="javascript:PonerColor('1','88','#824141')" title="Seleccionar el color 88 como primario">88</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BEB184;cursor:pointer;" onClick="javascript:PonerColor('1','89','#BEB184')" title="Seleccionar el color 89 como primario">89</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C9BE9C;cursor:pointer;" onClick="javascript:PonerColor('1','90','#C9BE9C')" title="Seleccionar el color 90 como primario">90</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4E595A;cursor:pointer;" onClick="javascript:PonerColor('1','91','#4E595A')" title="Seleccionar el color 91 como primario">91</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#817E6A;cursor:pointer;" onClick="javascript:PonerColor('1','92','#817E6A')" title="Seleccionar el color 92 como primario">92</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#227E81;cursor:pointer;" onClick="javascript:PonerColor('1','93','#227E81')" title="Seleccionar el color 93 como primario">93</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#336069;cursor:pointer;" onClick="javascript:PonerColor('1','94','#336069')" title="Seleccionar el color 94 como primario">94</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#41525A;cursor:pointer;" onClick="javascript:PonerColor('1','95','#41525A')" title="Seleccionar el color 95 como primario">95</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B0AF8D;cursor:pointer;" onClick="javascript:PonerColor('1','96','#B0AF8D')" title="Seleccionar el color 96 como primario">96</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#80938A;cursor:pointer;" onClick="javascript:PonerColor('1','97','#80938A')" title="Seleccionar el color 97 como primario">97</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#619389;cursor:pointer;" onClick="javascript:PonerColor('1','98','#619389')" title="Seleccionar el color 98 como primario">98</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C8A876;cursor:pointer;" onClick="javascript:PonerColor('1','99','#C8A876')" title="Seleccionar el color 99 como primario">99</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#547F84;cursor:pointer;" onClick="javascript:PonerColor('1','100','#547F84')" title="Seleccionar el color 100 como primario">100</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#333C42;cursor:pointer;" onClick="javascript:PonerColor('1','101','#333C42')" title="Seleccionar el color 101 como primario">101</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C0A272;cursor:pointer;" onClick="javascript:PonerColor('1','102','#C0A272')" title="Seleccionar el color 102 como primario">102</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#24596B;cursor:pointer;" onClick="javascript:PonerColor('1','103','#24596B')" title="Seleccionar el color 103 como primario">103</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AD9269;cursor:pointer;" onClick="javascript:PonerColor('1','104','#AD9269')" title="Seleccionar el color 104 como primario">104</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7D7D68;cursor:pointer;" onClick="javascript:PonerColor('1','105','#7D7D68')" title="Seleccionar el color 105 como primario">105</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#226278;cursor:pointer;" onClick="javascript:PonerColor('1','106','#226278')" title="Seleccionar el color 106 como primario">106</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BCA97E;cursor:pointer;" onClick="javascript:PonerColor('1','107','#BCA97E')" title="Seleccionar el color 107 como primario">107</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4F6989;cursor:pointer;" onClick="javascript:PonerColor('1','108','#4F6989')" title="Seleccionar el color 108 como primario">108</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6C695F;cursor:pointer;" onClick="javascript:PonerColor('1','109','#6C695F')" title="Seleccionar el color 109 como primario">109</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9A7E5B;cursor:pointer;" onClick="javascript:PonerColor('1','110','#9A7E5B')" title="Seleccionar el color 110 como primario">110</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#A1A28B;cursor:pointer;" onClick="javascript:PonerColor('1','111','#A1A28B')" title="Seleccionar el color 111 como primario">111</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6F7F7F;cursor:pointer;" onClick="javascript:PonerColor('1','112','#6F7F7F')" title="Seleccionar el color 112 como primario">112</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5E4A3E;cursor:pointer;" onClick="javascript:PonerColor('1','113','#5E4A3E')" title="Seleccionar el color 113 como primario">113</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5D7551;cursor:pointer;" onClick="javascript:PonerColor('1','114','#5D7551')" title="Seleccionar el color 114 como primario">114</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8C2436;cursor:pointer;" onClick="javascript:PonerColor('1','115','#8C2436')" title="Seleccionar el color 115 como primario">115</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#344A5A;cursor:pointer;" onClick="javascript:PonerColor('1','116','#344A5A')" title="Seleccionar el color 116 como primario">116</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7C252B;cursor:pointer;" onClick="javascript:PonerColor('1','117','#7C252B')" title="Seleccionar el color 117 como primario">117</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BCB9AF;cursor:pointer;" onClick="javascript:PonerColor('1','118','#BCB9AF')" title="Seleccionar el color 118 como primario">118</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7F6958;cursor:pointer;" onClick="javascript:PonerColor('1','119','#7F6958')" title="Seleccionar el color 119 como primario">119</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B09A77;cursor:pointer;" onClick="javascript:PonerColor('1','120','#B09A77')" title="Seleccionar el color 120 como primario">120</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7B242B;cursor:pointer;" onClick="javascript:PonerColor('1','121','#7B242B')" title="Seleccionar el color 121 como primario">121</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#706F5D;cursor:pointer;" onClick="javascript:PonerColor('1','122','#706F5D')" title="Seleccionar el color 122 como primario">122</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7B5936;cursor:pointer;" onClick="javascript:PonerColor('1','123','#7B5936')" title="Seleccionar el color 123 como primario">123</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8B2E36;cursor:pointer;" onClick="javascript:PonerColor('1','124','#8B2E36')" title="Seleccionar el color 124 como primario">124</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#304864;cursor:pointer;" onClick="javascript:PonerColor('1','125','#304864')" title="Seleccionar el color 125 como primario">125</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#f27491;cursor:pointer;" onClick="javascript:PonerColor('1','126','#f27491')" title="Seleccionar el color 126 como primario">126</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#171a18;cursor:pointer;" onClick="javascript:PonerColor('1','127','#171a18')" title="Seleccionar el color 127 como primario">127</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2c7c28;cursor:pointer;" onClick="javascript:PonerColor('1','128','#2c7c28')" title="Seleccionar el color 128 como primario">128</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#361f1c;cursor:pointer;" onClick="javascript:PonerColor('1','129','#361f1c')" title="Seleccionar el color 129 como primario">129</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#27616b;cursor:pointer;" onClick="javascript:PonerColor('1','130','#27616b')" title="Seleccionar el color 130 como primario">130</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#573e22;cursor:pointer;" onClick="javascript:PonerColor('1','131','#573e22')" title="Seleccionar el color 131 como primario">131</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#67342d;cursor:pointer;" onClick="javascript:PonerColor('1','132','#67342d')" title="Seleccionar el color 132 como primario">132</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#172019;cursor:pointer;" onClick="javascript:PonerColor('1','133','#172019')" title="Seleccionar el color 133 como primario">133</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#393757;cursor:pointer;" onClick="javascript:PonerColor('1','134','#393757')" title="Seleccionar el color 134 como primario">134</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3f8e8e;cursor:pointer;" onClick="javascript:PonerColor('1','135','#3f8e8e')" title="Seleccionar el color 135 como primario">135</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#975b9b;cursor:pointer;" onClick="javascript:PonerColor('1','136','#975b9b')" title="Seleccionar el color 136 como primario">136</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#489841;cursor:pointer;" onClick="javascript:PonerColor('1','137','#489841')" title="Seleccionar el color 137 como primario">137</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#c1b497;cursor:pointer;" onClick="javascript:PonerColor('1','138','#c1b497')" title="Seleccionar el color 138 como primario">138</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#585a7a;cursor:pointer;" onClick="javascript:PonerColor('1','139','#585a7a')" title="Seleccionar el color 139 como primario">139</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#918c79;cursor:pointer;" onClick="javascript:PonerColor('1','140','#918c79')" title="Seleccionar el color 140 como primario">140</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8f7f60;cursor:pointer;" onClick="javascript:PonerColor('1','141','#8f7f60')" title="Seleccionar el color 141 como primario">141</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8f8133;cursor:pointer;" onClick="javascript:PonerColor('1','142','#8f8133')" title="Seleccionar el color 142 como primario">142</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#795d65;cursor:pointer;" onClick="javascript:PonerColor('1','143','#795d65')" title="Seleccionar el color 143 como primario">143</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#694f65;cursor:pointer;" onClick="javascript:PonerColor('1','144','#694f65')" title="Seleccionar el color 144 como primario">144</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#98b668;cursor:pointer;" onClick="javascript:PonerColor('1','145','#98b668')" title="Seleccionar el color 145 como primario">145</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#905d6b;cursor:pointer;" onClick="javascript:PonerColor('1','146','#905d6b')" title="Seleccionar el color 146 como primario">146</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7c3b62;cursor:pointer;" onClick="javascript:PonerColor('1','147','#7c3b62')" title="Seleccionar el color 147 como primario">147</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#333325;cursor:pointer;" onClick="javascript:PonerColor('1','148','#333325')" title="Seleccionar el color 148 como primario">148</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#332b1c;cursor:pointer;" onClick="javascript:PonerColor('1','149','#332b1c')" title="Seleccionar el color 149 como primario">149</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#343929;cursor:pointer;" onClick="javascript:PonerColor('1','150','#343929')" title="Seleccionar el color 150 como primario">150</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#40553a;cursor:pointer;" onClick="javascript:PonerColor('1','151','#40553a')" title="Seleccionar el color 151 como primario">151</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#335a82;cursor:pointer;" onClick="javascript:PonerColor('1','152','#335a82')" title="Seleccionar el color 152 como primario">152</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#416a47;cursor:pointer;" onClick="javascript:PonerColor('1','153','#416a47')" title="Seleccionar el color 153 como primario">153</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#339b4a;cursor:pointer;" onClick="javascript:PonerColor('1','154','#339b4a')" title="Seleccionar el color 154 como primario">154</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#339b83;cursor:pointer;" onClick="javascript:PonerColor('1','155','#339b83')" title="Seleccionar el color 155 como primario">155</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a59b6a;cursor:pointer;" onClick="javascript:PonerColor('1','156','#a59b6a')" title="Seleccionar el color 156 como primario">156</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8a8a83;cursor:pointer;" onClick="javascript:PonerColor('1','157','#8a8a83')" title="Seleccionar el color 157 como primario">157</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5412d;cursor:pointer;" onClick="javascript:PonerColor('1','158','#a5412d')" title="Seleccionar el color 158 como primario">158</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#40341e;cursor:pointer;" onClick="javascript:PonerColor('1','159','#40341e')" title="Seleccionar el color 159 como primario">159</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#29391d;cursor:pointer;" onClick="javascript:PonerColor('1','160','#29391d')" title="Seleccionar el color 160 como primario">160</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a54f4e;cursor:pointer;" onClick="javascript:PonerColor('1','161','#a54f4e')" title="Seleccionar el color 161 como primario">161</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#335a83;cursor:pointer;" onClick="javascript:PonerColor('1','162','#335a83')" title="Seleccionar el color 162 como primario">162</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2d8772;cursor:pointer;" onClick="javascript:PonerColor('1','163','#2d8772')" title="Seleccionar el color 163 como primario">163</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2f3d35;cursor:pointer;" onClick="javascript:PonerColor('1','164','#2f3d35')" title="Seleccionar el color 164 como primario">164</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2b6c65;cursor:pointer;" onClick="javascript:PonerColor('1','165','#2b6c65')" title="Seleccionar el color 165 como primario">165</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#307076;cursor:pointer;" onClick="javascript:PonerColor('1','166','#307076')" title="Seleccionar el color 166 como primario">166</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7b4f83;cursor:pointer;" onClick="javascript:PonerColor('1','167','#7b4f83')" title="Seleccionar el color 167 como primario">167</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5a3022;cursor:pointer;" onClick="javascript:PonerColor('1','168','#5a3022')" title="Seleccionar el color 168 como primario">168</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#887b83;cursor:pointer;" onClick="javascript:PonerColor('1','169','#887b83')" title="Seleccionar el color 169 como primario">169</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#827783;cursor:pointer;" onClick="javascript:PonerColor('1','170','#827783')" title="Seleccionar el color 170 como primario">170</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#644a70;cursor:pointer;" onClick="javascript:PonerColor('1','171','#644a70')" title="Seleccionar el color 171 como primario">171</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#36391d;cursor:pointer;" onClick="javascript:PonerColor('1','172','#36391d')" title="Seleccionar el color 172 como primario">172</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#513021;cursor:pointer;" onClick="javascript:PonerColor('1','173','#513021')" title="Seleccionar el color 173 como primario">173</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#583722;cursor:pointer;" onClick="javascript:PonerColor('1','174','#583722')" title="Seleccionar el color 174 como primario">174</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5342d;cursor:pointer;" onClick="javascript:PonerColor('1','175','#a5342d')" title="Seleccionar el color 175 como primario">175</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9a5a7a;cursor:pointer;" onClick="javascript:PonerColor('1','176','#9a5a7a')" title="Seleccionar el color 176 como primario">176</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8d6771;cursor:pointer;" onClick="javascript:PonerColor('1','177','#8d6771')" title="Seleccionar el color 177 como primario">177</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#894f70;cursor:pointer;" onClick="javascript:PonerColor('1','178','#894f70')" title="Seleccionar el color 178 como primario">178</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4e2e3e;cursor:pointer;" onClick="javascript:PonerColor('1','179','#4e2e3e')" title="Seleccionar el color 179 como primario">179</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#824728;cursor:pointer;" onClick="javascript:PonerColor('1','180','#824728')" title="Seleccionar el color 180 como primario">180</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#862f29;cursor:pointer;" onClick="javascript:PonerColor('1','181','#862f29')" title="Seleccionar el color 181 como primario">181</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#91462b;cursor:pointer;" onClick="javascript:PonerColor('1','182','#91462b')" title="Seleccionar el color 182 como primario">182</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9a422c;cursor:pointer;" onClick="javascript:PonerColor('1','183','#9a422c')" title="Seleccionar el color 183 como primario">183</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8b4f52;cursor:pointer;" onClick="javascript:PonerColor('1','184','#8b4f52')" title="Seleccionar el color 184 como primario">184</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8a766e;cursor:pointer;" onClick="javascript:PonerColor('1','185','#8a766e')" title="Seleccionar el color 185 como primario">185</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#192419;cursor:pointer;" onClick="javascript:PonerColor('1','186','#192419')" title="Seleccionar el color 186 como primario">186</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1d391d;cursor:pointer;" onClick="javascript:PonerColor('1','187','#1d391d')" title="Seleccionar el color 187 como primario">187</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2b4325;cursor:pointer;" onClick="javascript:PonerColor('1','188','#2b4325')" title="Seleccionar el color 188 como primario">188</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2b432b;cursor:pointer;" onClick="javascript:PonerColor('1','189','#2b432b')" title="Seleccionar el color 189 como primario">189</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#743e4f;cursor:pointer;" onClick="javascript:PonerColor('1','190','#743e4f')" title="Seleccionar el color 190 como primario">190</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#498a51;cursor:pointer;" onClick="javascript:PonerColor('1','191','#498a51')" title="Seleccionar el color 191 como primario">191</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5977c;cursor:pointer;" onClick="javascript:PonerColor('1','192','#a5977c')" title="Seleccionar el color 192 como primario">192</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8f9181;cursor:pointer;" onClick="javascript:PonerColor('1','193','#8f9181')" title="Seleccionar el color 193 como primario">193</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a59b2d;cursor:pointer;" onClick="javascript:PonerColor('1','194','#a59b2d')" title="Seleccionar el color 194 como primario">194</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8d9b4d;cursor:pointer;" onClick="javascript:PonerColor('1','195','#8d9b4d')" title="Seleccionar el color 195 como primario">195</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#90957d;cursor:pointer;" onClick="javascript:PonerColor('1','196','#90957d')" title="Seleccionar el color 196 como primario">196</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#868830;cursor:pointer;" onClick="javascript:PonerColor('1','197','#868830')" title="Seleccionar el color 197 como primario">197</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3f4d83;cursor:pointer;" onClick="javascript:PonerColor('1','198','#3f4d83')" title="Seleccionar el color 198 como primario">198</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4c4b20;cursor:pointer;" onClick="javascript:PonerColor('1','199','#4c4b20')" title="Seleccionar el color 199 como primario">199</div>

<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#967f4e;cursor:pointer;" onClick="javascript:PonerColor('1','200','#967f4e')" title="Seleccionar el color 200 como primario">200</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#24354b;cursor:pointer;" onClick="javascript:PonerColor('1','201','#24354b')" title="Seleccionar el color 201 como primario">201</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2a482c;cursor:pointer;" onClick="javascript:PonerColor('1','202','#2a482c')" title="Seleccionar el color 202 como primario">202</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2a3b40;cursor:pointer;" onClick="javascript:PonerColor('1','203','#2a3b40')" title="Seleccionar el color 203 como primario">203</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4a646a;cursor:pointer;" onClick="javascript:PonerColor('1','204','#4a646a')" title="Seleccionar el color 204 como primario">204</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1c212e;cursor:pointer;" onClick="javascript:PonerColor('1','205','#1c212e')" title="Seleccionar el color 205 como primario">205</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1d2b33;cursor:pointer;" onClick="javascript:PonerColor('1','206','#1d2b33')" title="Seleccionar el color 206 como primario">206</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#344a4c;cursor:pointer;" onClick="javascript:PonerColor('1','207','#344a4c')" title="Seleccionar el color 207 como primario">207</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3f5d77;cursor:pointer;" onClick="javascript:PonerColor('1','208','#3f5d77')" title="Seleccionar el color 208 como primario">208</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2a5264;cursor:pointer;" onClick="javascript:PonerColor('1','209','#2a5264')" title="Seleccionar el color 209 como primario">209</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#264550;cursor:pointer;" onClick="javascript:PonerColor('1','210','#264550')" title="Seleccionar el color 210 como primario">210</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#382d5d;cursor:pointer;" onClick="javascript:PonerColor('1','211','#382d5d')" title="Seleccionar el color 211 como primario">211</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#793527;cursor:pointer;" onClick="javascript:PonerColor('1','212','#793527')" title="Seleccionar el color 212 como primario">212</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9a917f;cursor:pointer;" onClick="javascript:PonerColor('1','213','#9a917f')" title="Seleccionar el color 213 como primario">213</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#626b25;cursor:pointer;" onClick="javascript:PonerColor('1','214','#626b25')" title="Seleccionar el color 214 como primario">214</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1f2719;cursor:pointer;" onClick="javascript:PonerColor('1','215','#1f2719')" title="Seleccionar el color 215 como primario">215</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#986441;cursor:pointer;" onClick="javascript:PonerColor('1','216','#986441')" title="Seleccionar el color 216 como primario">216</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#638d7b;cursor:pointer;" onClick="javascript:PonerColor('1','217','#638d7b')" title="Seleccionar el color 217 como primario">217</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a56851;cursor:pointer;" onClick="javascript:PonerColor('1','218','#a56851')" title="Seleccionar el color 218 como primario">218</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5642d;cursor:pointer;" onClick="javascript:PonerColor('1','219','#a5642d')" title="Seleccionar el color 219 como primario">219</div>



<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a54c5d;cursor:pointer;" onClick="javascript:PonerColor('1','220','#a54c5d')" title="Seleccionar el color 220 como primario">220</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5934f;cursor:pointer;" onClick="javascript:PonerColor('1','221','#a5934f')" title="Seleccionar el color 221 como primario">221</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5432d;cursor:pointer;" onClick="javascript:PonerColor('1','222','#a5432d')" title="Seleccionar el color 222 como primario">222</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#232f46;cursor:pointer;" onClick="javascript:PonerColor('1','223','#232f46')" title="Seleccionar el color 223 como primario">223</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#63342d;cursor:pointer;" onClick="javascript:PonerColor('1','224','#63342d')" title="Seleccionar el color 224 como primario">224</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#545222;cursor:pointer;" onClick="javascript:PonerColor('1','225','#545222')" title="Seleccionar el color 225 como primario">225</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5e9b2d;cursor:pointer;" onClick="javascript:PonerColor('1','226','#5e9b2d')" title="Seleccionar el color 226 como primario">226</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1e3e2d;cursor:pointer;" onClick="javascript:PonerColor('1','227','#1e3e2d')" title="Seleccionar el color 227 como primario">227</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a1872c;cursor:pointer;" onClick="javascript:PonerColor('1','228','#a1872c')" title="Seleccionar el color 228 como primario">228</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2e852a;cursor:pointer;" onClick="javascript:PonerColor('1','229','#2e852a')" title="Seleccionar el color 229 como primario">229</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4e2b2e;cursor:pointer;" onClick="javascript:PonerColor('1','230','#4e2b2e')" title="Seleccionar el color 230 como primario">230</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#825f28;cursor:pointer;" onClick="javascript:PonerColor('1','231','#825f28')" title="Seleccionar el color 231 como primario">231</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#954f79;cursor:pointer;" onClick="javascript:PonerColor('1','232','#954f79')" title="Seleccionar el color 232 como primario">232</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8d3064;cursor:pointer;" onClick="javascript:PonerColor('1','233','#8d3064')" title="Seleccionar el color 233 como primario">233</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#214820;cursor:pointer;" onClick="javascript:PonerColor('1','234','#214820')" title="Seleccionar el color 234 como primario">234</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3b5522;cursor:pointer;" onClick="javascript:PonerColor('1','235','#3b5522')" title="Seleccionar el color 235 como primario">235</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1d3531;cursor:pointer;" onClick="javascript:PonerColor('1','236','#1d3531')" title="Seleccionar el color 236 como primario">236</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#865568;cursor:pointer;" onClick="javascript:PonerColor('1','237','#865568')" title="Seleccionar el color 237 como primario">237</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#987041;cursor:pointer;" onClick="javascript:PonerColor('1','238','#987041')" title="Seleccionar el color 238 como primario">238</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#823a28;cursor:pointer;" onClick="javascript:PonerColor('1','239','#823a28')" title="Seleccionar el color 239 como primario">239</div>



<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#44977c;cursor:pointer;" onClick="javascript:PonerColor('1','240','#44977c')" title="Seleccionar el color 240 como primario">240</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#67972d;cursor:pointer;" onClick="javascript:PonerColor('1','241','#67972d')" title="Seleccionar el color 241 como primario">241</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#682d42;cursor:pointer;" onClick="javascript:PonerColor('1','242','#682d42')" title="Seleccionar el color 242 como primario">242</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2f8e39;cursor:pointer;" onClick="javascript:PonerColor('1','243','#2f8e39')" title="Seleccionar el color 243 como primario">243</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4a2d20;cursor:pointer;" onClick="javascript:PonerColor('1','244','#4a2d20')" title="Seleccionar el color 244 como primario">244</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1a2f1b;cursor:pointer;" onClick="javascript:PonerColor('1','245','#1a2f1b')" title="Seleccionar el color 245 como primario">245</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#48697a;cursor:pointer;" onClick="javascript:PonerColor('1','246','#48697a')" title="Seleccionar el color 246 como primario">246</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#414f57;cursor:pointer;" onClick="javascript:PonerColor('1','247','#414f57')" title="Seleccionar el color 247 como primario">247</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#673034;cursor:pointer;" onClick="javascript:PonerColor('1','248','#673034')" title="Seleccionar el color 248 como primario">248</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5f2633;cursor:pointer;" onClick="javascript:PonerColor('1','249','#5f2633')" title="Seleccionar el color 249 como primario">249</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7e745f;cursor:pointer;" onClick="javascript:PonerColor('1','250','#7e745f')" title="Seleccionar el color 250 como primario">250</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4e4f46;cursor:pointer;" onClick="javascript:PonerColor('1','251','#4e4f46')" title="Seleccionar el color 251 como primario">251</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#41403b;cursor:pointer;" onClick="javascript:PonerColor('1','252','#41403b')" title="Seleccionar el color 252 como primario">252</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#89846f;cursor:pointer;" onClick="javascript:PonerColor('1','253','#89846f')" title="Seleccionar el color 253 como primario">253</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5c5446;cursor:pointer;" onClick="javascript:PonerColor('1','254','#5c5446')" title="Seleccionar el color 254 como primario">254</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3c464e;cursor:pointer;" onClick="javascript:PonerColor('1','255','#3c464e')" title="Seleccionar el color 255 como primario">255</div>
</div>
</td>
</tr>
<tr>
<td height="44" valign="middle" bgcolor="#FFFFFF">&nbsp;<font size="2px"><?php echo $Texto_Index_145;?>: </td>
<td align="center" valign="middle" bgcolor="#FFFFFF">
<div style="background-color:#F5F5F5;margin-left:10px;float:left; width:26px; height:22px;border-top:1px solid #999999;border-left:1px solid #999999;border-bottom:1px solid #999999;margin-top:2px; padding-left:2px;padding:5px"><input name="color2" id="color2" type="text" value="<?php echo $autocochec2?>" style="width:24px" readonly="1"/>
</div>

<div id="boxcolor2" style="border:1px solid #999999; background-color:#<?php echo $coloresveh[''.$autocochec2.'']?>;float:left; width:74px; height:22px;margin-top:2px;padding:5px"></div>
<div style="float:left; width:40px; height:40px; margin-left:5px;"><img src="imagenes/baldes.gif" align="absmiddle" style="cursor:pointer" alt="<?php echo $Texto_Index_148;?>" title="<?php echo $Texto_Index_148;?>" id="cambiar-color2"/></div>
<div id="slickbox2" style="display:none; float:left; font-size:11px;border-top:solid 1px #D6D6D6;border-left:solid 1px #D6D6D6; width:560px; margin-left: -220px; margin-top: 36px;position: absolute;">
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#000000;cursor:pointer;" onClick="javascript:PonerColor('2','0','#000000')" title="Seleccionar el color 0 como secundario">0</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#FFFFFF;cursor:pointer;" onClick="javascript:PonerColor('2','1','#FFFFFF')" title="Seleccionar el color 1 como secundario">1</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#40868D;cursor:pointer;" onClick="javascript:PonerColor('2','2','#40868D')" title="Seleccionar el color 2 como secundario">2</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9E1F25;cursor:pointer;" onClick="javascript:PonerColor('2','3','#9E1F25')" title="Seleccionar el color 3 como secundario">3</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3E4C42;cursor:pointer;" onClick="javascript:PonerColor('2','4','#3E4C42')" title="Seleccionar el color 4 como secundario">4</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9E596A;cursor:pointer;" onClick="javascript:PonerColor('2','5','#9E596A')" title="Seleccionar el color 5 como secundario">5</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#F7A125;cursor:pointer;" onClick="javascript:PonerColor('2','6','#F7A125')" title="Seleccionar el color 6 como secundario">6</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6187A5;cursor:pointer;" onClick="javascript:PonerColor('2','7','#6187A5')" title="Seleccionar el color 7 como secundario">7</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#DACDB0;cursor:pointer;" onClick="javascript:PonerColor('2','8','#DACDB0')" title="Seleccionar el color 8 como secundario">8</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#738471;cursor:pointer;" onClick="javascript:PonerColor('2','9','#738471')" title="Seleccionar el color 9 como secundario">9</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5E6D75;cursor:pointer;" onClick="javascript:PonerColor('2','10','#5E6D75')" title="Seleccionar el color 10 como secundario">10</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7E7E75;cursor:pointer;" onClick="javascript:PonerColor('2','11','#7E7E75')" title="Seleccionar el color 11 como secundario">11</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#728F83;cursor:pointer;" onClick="javascript:PonerColor('2','12','#728F83')" title="Seleccionar el color 12 como secundario">12</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6F6D5C;cursor:pointer;" onClick="javascript:PonerColor('2','13','#6F6D5C')" title="Seleccionar el color 13 como secundario">13</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#EEE4BD;cursor:pointer;" onClick="javascript:PonerColor('2','14','#EEE4BD')" title="Seleccionar el color 14 como secundario">14</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BAB197;cursor:pointer;" onClick="javascript:PonerColor('2','15','#BAB197')" title="Seleccionar el color 15 como secundario">15</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#457545;cursor:pointer;" onClick="javascript:PonerColor('2','16','#457545')" title="Seleccionar el color 16 como secundario">16</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8C262A;cursor:pointer;" onClick="javascript:PonerColor('2','17','#8C262A')" title="Seleccionar el color 17 como secundario">17</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#902438;cursor:pointer;" onClick="javascript:PonerColor('2','18','#902438')" title="Seleccionar el color 18 como secundario">18</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BBAB8A;cursor:pointer;" onClick="javascript:PonerColor('2','19','#BBAB8A')" title="Seleccionar el color 19 como secundario">19</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#516273;cursor:pointer;" onClick="javascript:PonerColor('2','20','#516273')" title="Seleccionar el color 20 como secundario">20</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8C4445;cursor:pointer;" onClick="javascript:PonerColor('2','21','#8C4445')" title="Seleccionar el color 21 como secundario">21</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#803543;cursor:pointer;" onClick="javascript:PonerColor('2','22','#803543')" title="Seleccionar el color 22 como secundario">22</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AEA283;cursor:pointer;" onClick="javascript:PonerColor('2','23','#AEA283')" title="Seleccionar el color 23 como secundario">23</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6C685C;cursor:pointer;" onClick="javascript:PonerColor('2','24','#6C685C')" title="Seleccionar el color 24 como secundario">24</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#53534D;cursor:pointer;" onClick="javascript:PonerColor('2','25','#53534D')" title="Seleccionar el color 25 como secundario">25</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BDB798;cursor:pointer;" onClick="javascript:PonerColor('2','26','#BDB798')" title="Seleccionar el color 26 como secundario">26</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7C6E5C;cursor:pointer;" onClick="javascript:PonerColor('2','27','#7C6E5C')" title="Seleccionar el color 27 como secundario">27</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#525F66;cursor:pointer;" onClick="javascript:PonerColor('2','28','#525F66')" title="Seleccionar el color 28 como secundario">28</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AEA489;cursor:pointer;" onClick="javascript:PonerColor('2','29','#AEA489')" title="Seleccionar el color 29 como secundario">29</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5C3533;cursor:pointer;" onClick="javascript:PonerColor('2','30','#5C3533')" title="Seleccionar el color 30 como secundario">30</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#733D38;cursor:pointer;" onClick="javascript:PonerColor('2','31','#733D38')" title="Seleccionar el color 31 como secundario">31</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9DA39B;cursor:pointer;" onClick="javascript:PonerColor('2','32','#9DA39B')" title="Seleccionar el color 32 como secundario">32</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8D8E76;cursor:pointer;" onClick="javascript:PonerColor('2','33','#8D8E76')" title="Seleccionar el color 33 como secundario">33</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7D7765;cursor:pointer;" onClick="javascript:PonerColor('2','34','#7D7765')" title="Seleccionar el color 34 como secundario">34</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#706958;cursor:pointer;" onClick="javascript:PonerColor('2','35','#706958')" title="Seleccionar el color 35 como secundario">35</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3E3C36;cursor:pointer;" onClick="javascript:PonerColor('2','36','#3E3C36')" title="Seleccionar el color 36 como secundario">36</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#42503F;cursor:pointer;" onClick="javascript:PonerColor('2','37','#42503F')" title="Seleccionar el color 37 como secundario">37</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#ACB28B;cursor:pointer;" onClick="javascript:PonerColor('2','38','#ACB28B')" title="Seleccionar el color 38 como secundario">38</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#828E81;cursor:pointer;" onClick="javascript:PonerColor('2','39','#828E81')" title="Seleccionar el color 39 como secundario">39</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#343329;cursor:pointer;" onClick="javascript:PonerColor('2','40','#343329')" title="Seleccionar el color 40 como secundario">40</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8A7D5E;cursor:pointer;" onClick="javascript:PonerColor('2','41','#8A7D5E')" title="Seleccionar el color 41 como secundario">41</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9A3438;cursor:pointer;" onClick="javascript:PonerColor('2','42','#9A3438')" title="Seleccionar el color 42 como secundario">42</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#732427;cursor:pointer;" onClick="javascript:PonerColor('2','43','#732427')" title="Seleccionar el color 43 como secundario">43</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#305036;cursor:pointer;" onClick="javascript:PonerColor('2','44','#305036')" title="Seleccionar el color 44 como secundario">44</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#72342C;cursor:pointer;" onClick="javascript:PonerColor('2','45','#72342C')" title="Seleccionar el color 45 como secundario">45</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B9A86B;cursor:pointer;" onClick="javascript:PonerColor('2','46','#B9A86B')" title="Seleccionar el color 46 como secundario">46</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#90865F;cursor:pointer;" onClick="javascript:PonerColor('2','47','#90865F')" title="Seleccionar el color 47 como secundario">47</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AEA37F;cursor:pointer;" onClick="javascript:PonerColor('2','48','#AEA37F')" title="Seleccionar el color 48 como secundario">48</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C9BE9C;cursor:pointer;" onClick="javascript:PonerColor('2','49','#C9BE9C')" title="Seleccionar el color 49 como secundario">49</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9D9A81;cursor:pointer;" onClick="javascript:PonerColor('2','50','#9D9A81')" title="Seleccionar el color 50 como secundario">50</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#44664D;cursor:pointer;" onClick="javascript:PonerColor('2','51','#44664D')" title="Seleccionar el color 51 como secundario">51</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#617566;cursor:pointer;" onClick="javascript:PonerColor('2','52','#617566')" title="Seleccionar el color 52 como secundario">52</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2E3A4D;cursor:pointer;" onClick="javascript:PonerColor('2','53','#2E3A4D')" title="Seleccionar el color 53 como secundario">53</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3F4450;cursor:pointer;" onClick="javascript:PonerColor('2','54','#3F4450')" title="Seleccionar el color 54 como secundario">54</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9A765B;cursor:pointer;" onClick="javascript:PonerColor('2','55','#9A765B')" title="Seleccionar el color 55 como secundario">55</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BAB19B;cursor:pointer;" onClick="javascript:PonerColor('2','56','#BAB19B')" title="Seleccionar el color 56 como secundario">56</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B99C6B;cursor:pointer;" onClick="javascript:PonerColor('2','57','#B99C6B')" title="Seleccionar el color 57 como secundario">57</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#812E33;cursor:pointer;" onClick="javascript:PonerColor('2','58','#812E33')" title="Seleccionar el color 58 como secundario">58</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#627D78;cursor:pointer;" onClick="javascript:PonerColor('2','59','#627D78')" title="Seleccionar el color 59 como secundario">59</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B9AA8B;cursor:pointer;" onClick="javascript:PonerColor('2','60','#B9AA8B')" title="Seleccionar el color 60 como secundario">60</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AB864D;cursor:pointer;" onClick="javascript:PonerColor('2','61','#AB864D')" title="Seleccionar el color 61 como secundario">61</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7E3435;cursor:pointer;" onClick="javascript:PonerColor('2','62','#7E3435')" title="Seleccionar el color 62 como secundario">62</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#ACAA8E;cursor:pointer;" onClick="javascript:PonerColor('2','63','#ACAA8E')" title="Seleccionar el color 63 como secundario">63</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BDB298;cursor:pointer;" onClick="javascript:PonerColor('2','64','#BDB298')" title="Seleccionar el color 64 como secundario">64</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AA9C4D;cursor:pointer;" onClick="javascript:PonerColor('2','65','#AA9C4D')" title="Seleccionar el color 65 como secundario">65</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4D342B;cursor:pointer;" onClick="javascript:PonerColor('2','66','#4D342B')" title="Seleccionar el color 66 como secundario">66</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#808D82;cursor:pointer;" onClick="javascript:PonerColor('2','67','#808D82')" title="Seleccionar el color 67 como secundario">67</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C0BA83;cursor:pointer;" onClick="javascript:PonerColor('2','68','#C0BA83')" title="Seleccionar el color 68 como secundario">68</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C8A884;cursor:pointer;" onClick="javascript:PonerColor('2','69','#C8A884')" title="Seleccionar el color 69 como secundario">69</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9E353A;cursor:pointer;" onClick="javascript:PonerColor('2','70','#9E353A')" title="Seleccionar el color 70 como secundario">70</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#83938B;cursor:pointer;" onClick="javascript:PonerColor('2','71','#83938B')" title="Seleccionar el color 71 como secundario">71</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6F6D59;cursor:pointer;" onClick="javascript:PonerColor('2','72','#6F6D59')" title="Seleccionar el color 72 como secundario">72</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B0B284;cursor:pointer;" onClick="javascript:PonerColor('2','73','#B0B284')" title="Seleccionar el color 73 como secundario">73</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7B3434;cursor:pointer;" onClick="javascript:PonerColor('2','74','#7B3434')" title="Seleccionar el color 74 como secundario">74</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#333639;cursor:pointer;" onClick="javascript:PonerColor('2','75','#333639')" title="Seleccionar el color 75 como secundario">75</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BDB08B;cursor:pointer;" onClick="javascript:PonerColor('2','76','#BDB08B')" title="Seleccionar el color 76 como secundario">76</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C0AB7E;cursor:pointer;" onClick="javascript:PonerColor('2','77','#C0AB7E')" title="Seleccionar el color 77 como secundario">77</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8F3A38;cursor:pointer;" onClick="javascript:PonerColor('2','78','#8F3A38')" title="Seleccionar el color 78 como secundario">78</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#21496A;cursor:pointer;" onClick="javascript:PonerColor('2','79','#21496A')" title="Seleccionar el color 79 como secundario">79</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8B4145;cursor:pointer;" onClick="javascript:PonerColor('2','80','#8B4145')" title="Seleccionar el color 80 como secundario">80</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#90845D;cursor:pointer;" onClick="javascript:PonerColor('2','81','#90845D')" title="Seleccionar el color 81 como secundario">81</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8C3436;cursor:pointer;" onClick="javascript:PonerColor('2','82','#8C3436')" title="Seleccionar el color 82 como secundario">82</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#33443E;cursor:pointer;" onClick="javascript:PonerColor('2','83','#33443E')" title="Seleccionar el color 83 como secundario">83</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#61493A;cursor:pointer;" onClick="javascript:PonerColor('2','84','#61493A')" title="Seleccionar el color 84 como secundario">84</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9A344D;cursor:pointer;" onClick="javascript:PonerColor('2','85','#9A344D')" title="Seleccionar el color 85 como secundario">85</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#436E2C;cursor:pointer;" onClick="javascript:PonerColor('2','86','#436E2C')" title="Seleccionar el color 86 como secundario">86</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#506E7E;cursor:pointer;" onClick="javascript:PonerColor('2','87','#506E7E')" title="Seleccionar el color 87 como secundario">87</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#824141;cursor:pointer;" onClick="javascript:PonerColor('2','88','#824141')" title="Seleccionar el color 88 como secundario">88</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BEB184;cursor:pointer;" onClick="javascript:PonerColor('2','89','#BEB184')" title="Seleccionar el color 89 como secundario">89</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C9BE9C;cursor:pointer;" onClick="javascript:PonerColor('2','90','#C9BE9C')" title="Seleccionar el color 90 como secundario">90</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4E595A;cursor:pointer;" onClick="javascript:PonerColor('2','91','#4E595A')" title="Seleccionar el color 91 como secundario">91</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#817E6A;cursor:pointer;" onClick="javascript:PonerColor('2','92','#817E6A')" title="Seleccionar el color 92 como secundario">92</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#227E81;cursor:pointer;" onClick="javascript:PonerColor('2','93','#227E81')" title="Seleccionar el color 93 como secundario">93</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#336069;cursor:pointer;" onClick="javascript:PonerColor('2','94','#336069')" title="Seleccionar el color 94 como secundario">94</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#41525A;cursor:pointer;" onClick="javascript:PonerColor('2','95','#41525A')" title="Seleccionar el color 95 como secundario">95</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B0AF8D;cursor:pointer;" onClick="javascript:PonerColor('2','96','#B0AF8D')" title="Seleccionar el color 96 como secundario">96</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#80938A;cursor:pointer;" onClick="javascript:PonerColor('2','97','#80938A')" title="Seleccionar el color 97 como secundario">97</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#619389;cursor:pointer;" onClick="javascript:PonerColor('2','98','#619389')" title="Seleccionar el color 98 como secundario">98</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C8A876;cursor:pointer;" onClick="javascript:PonerColor('2','99','#C8A876')" title="Seleccionar el color 99 como secundario">99</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#547F84;cursor:pointer;" onClick="javascript:PonerColor('2','100','#547F84')" title="Seleccionar el color 100 como secundario">100</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#333C42;cursor:pointer;" onClick="javascript:PonerColor('2','101','#333C42')" title="Seleccionar el color 101 como secundario">101</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#C0A272;cursor:pointer;" onClick="javascript:PonerColor('2','102','#C0A272')" title="Seleccionar el color 102 como secundario">102</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#24596B;cursor:pointer;" onClick="javascript:PonerColor('2','103','#24596B')" title="Seleccionar el color 103 como secundario">103</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#AD9269;cursor:pointer;" onClick="javascript:PonerColor('2','104','#AD9269')" title="Seleccionar el color 104 como secundario">104</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7D7D68;cursor:pointer;" onClick="javascript:PonerColor('2','105','#7D7D68')" title="Seleccionar el color 105 como secundario">105</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#226278;cursor:pointer;" onClick="javascript:PonerColor('2','106','#226278')" title="Seleccionar el color 106 como secundario">106</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BCA97E;cursor:pointer;" onClick="javascript:PonerColor('2','107','#BCA97E')" title="Seleccionar el color 107 como secundario">107</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4F6989;cursor:pointer;" onClick="javascript:PonerColor('2','108','#4F6989')" title="Seleccionar el color 108 como secundario">108</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6C695F;cursor:pointer;" onClick="javascript:PonerColor('2','109','#6C695F')" title="Seleccionar el color 109 como secundario">109</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9A7E5B;cursor:pointer;" onClick="javascript:PonerColor('2','110','#9A7E5B')" title="Seleccionar el color 110 como secundario">110</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#A1A28B;cursor:pointer;" onClick="javascript:PonerColor('2','111','#A1A28B')" title="Seleccionar el color 111 como secundario">111</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#6F7F7F;cursor:pointer;" onClick="javascript:PonerColor('2','112','#6F7F7F')" title="Seleccionar el color 112 como secundario">112</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5E4A3E;cursor:pointer;" onClick="javascript:PonerColor('2','113','#5E4A3E')" title="Seleccionar el color 113 como secundario">113</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5D7551;cursor:pointer;" onClick="javascript:PonerColor('2','114','#5D7551')" title="Seleccionar el color 114 como secundario">114</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8C2436;cursor:pointer;" onClick="javascript:PonerColor('2','115','#8C2436')" title="Seleccionar el color 115 como secundario">115</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#344A5A;cursor:pointer;" onClick="javascript:PonerColor('2','116','#344A5A')" title="Seleccionar el color 116 como secundario">116</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7C252B;cursor:pointer;" onClick="javascript:PonerColor('2','117','#7C252B')" title="Seleccionar el color 117 como secundario">117</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#BCB9AF;cursor:pointer;" onClick="javascript:PonerColor('2','118','#BCB9AF')" title="Seleccionar el color 118 como secundario">118</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7F6958;cursor:pointer;" onClick="javascript:PonerColor('2','119','#7F6958')" title="Seleccionar el color 119 como secundario">119</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#B09A77;cursor:pointer;" onClick="javascript:PonerColor('2','120','#B09A77')" title="Seleccionar el color 120 como secundario">120</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7B242B;cursor:pointer;" onClick="javascript:PonerColor('2','121','#7B242B')" title="Seleccionar el color 121 como secundario">121</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#706F5D;cursor:pointer;" onClick="javascript:PonerColor('2','122','#706F5D')" title="Seleccionar el color 122 como secundario">122</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7B5936;cursor:pointer;" onClick="javascript:PonerColor('2','123','#7B5936')" title="Seleccionar el color 123 como secundario">123</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8B2E36;cursor:pointer;" onClick="javascript:PonerColor('2','124','#8B2E36')" title="Seleccionar el color 124 como secundario">124</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#304864;cursor:pointer;" onClick="javascript:PonerColor('2','125','#304864')" title="Seleccionar el color 125 como secundario">125</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#f27491;cursor:pointer;" onClick="javascript:PonerColor('2','126','#f27491')" title="Seleccionar el color 126 como secundario">126</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#171a18;cursor:pointer;" onClick="javascript:PonerColor('2','127','#171a18')" title="Seleccionar el color 127 como secundario">127</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2c7c28;cursor:pointer;" onClick="javascript:PonerColor('2','128','#2c7c28')" title="Seleccionar el color 128 como secundario">128</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#361f1c;cursor:pointer;" onClick="javascript:PonerColor('2','129','#361f1c')" title="Seleccionar el color 129 como secundario">129</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#27616b;cursor:pointer;" onClick="javascript:PonerColor('2','130','#27616b')" title="Seleccionar el color 130 como secundario">130</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#573e22;cursor:pointer;" onClick="javascript:PonerColor('2','131','#573e22')" title="Seleccionar el color 131 como secundario">131</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#67342d;cursor:pointer;" onClick="javascript:PonerColor('2','132','#67342d')" title="Seleccionar el color 132 como secundario">132</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#172019;cursor:pointer;" onClick="javascript:PonerColor('2','133','#172019')" title="Seleccionar el color 133 como secundario">133</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#393757;cursor:pointer;" onClick="javascript:PonerColor('2','134','#393757')" title="Seleccionar el color 134 como secundario">134</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3f8e8e;cursor:pointer;" onClick="javascript:PonerColor('2','135','#3f8e8e')" title="Seleccionar el color 135 como secundario">135</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#975b9b;cursor:pointer;" onClick="javascript:PonerColor('2','136','#975b9b')" title="Seleccionar el color 136 como secundario">136</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#489841;cursor:pointer;" onClick="javascript:PonerColor('2','137','#489841')" title="Seleccionar el color 137 como secundario">137</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#c1b497;cursor:pointer;" onClick="javascript:PonerColor('2','138','#c1b497')" title="Seleccionar el color 138 como secundario">138</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#585a7a;cursor:pointer;" onClick="javascript:PonerColor('2','139','#585a7a')" title="Seleccionar el color 139 como secundario">139</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#918c79;cursor:pointer;" onClick="javascript:PonerColor('2','140','#918c79')" title="Seleccionar el color 140 como secundario">140</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8f7f60;cursor:pointer;" onClick="javascript:PonerColor('2','141','#8f7f60')" title="Seleccionar el color 141 como secundario">141</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8f8133;cursor:pointer;" onClick="javascript:PonerColor('2','142','#8f8133')" title="Seleccionar el color 142 como secundario">142</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#795d65;cursor:pointer;" onClick="javascript:PonerColor('2','143','#795d65')" title="Seleccionar el color 143 como secundario">143</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#694f65;cursor:pointer;" onClick="javascript:PonerColor('2','144','#694f65')" title="Seleccionar el color 144 como secundario">144</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#98b668;cursor:pointer;" onClick="javascript:PonerColor('2','145','#98b668')" title="Seleccionar el color 145 como secundario">145</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#905d6b;cursor:pointer;" onClick="javascript:PonerColor('2','146','#905d6b')" title="Seleccionar el color 146 como secundario">146</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7c3b62;cursor:pointer;" onClick="javascript:PonerColor('2','147','#7c3b62')" title="Seleccionar el color 147 como secundario">147</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#333325;cursor:pointer;" onClick="javascript:PonerColor('2','148','#333325')" title="Seleccionar el color 148 como secundario">148</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#332b1c;cursor:pointer;" onClick="javascript:PonerColor('2','149','#332b1c')" title="Seleccionar el color 149 como secundario">149</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#343929;cursor:pointer;" onClick="javascript:PonerColor('2','150','#343929')" title="Seleccionar el color 150 como secundario">150</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#40553a;cursor:pointer;" onClick="javascript:PonerColor('2','151','#40553a')" title="Seleccionar el color 151 como secundario">151</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#335a82;cursor:pointer;" onClick="javascript:PonerColor('2','152','#335a82')" title="Seleccionar el color 152 como secundario">152</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#416a47;cursor:pointer;" onClick="javascript:PonerColor('2','153','#416a47')" title="Seleccionar el color 153 como secundario">153</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#339b4a;cursor:pointer;" onClick="javascript:PonerColor('2','154','#339b4a')" title="Seleccionar el color 154 como secundario">154</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#339b83;cursor:pointer;" onClick="javascript:PonerColor('2','155','#339b83')" title="Seleccionar el color 155 como secundario">155</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a59b6a;cursor:pointer;" onClick="javascript:PonerColor('2','156','#a59b6a')" title="Seleccionar el color 156 como secundario">156</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8a8a83;cursor:pointer;" onClick="javascript:PonerColor('2','157','#8a8a83')" title="Seleccionar el color 157 como secundario">157</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5412d;cursor:pointer;" onClick="javascript:PonerColor('2','158','#a5412d')" title="Seleccionar el color 158 como secundario">158</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#40341e;cursor:pointer;" onClick="javascript:PonerColor('2','159','#40341e')" title="Seleccionar el color 159 como secundario">159</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#29391d;cursor:pointer;" onClick="javascript:PonerColor('2','160','#29391d')" title="Seleccionar el color 160 como secundario">160</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a54f4e;cursor:pointer;" onClick="javascript:PonerColor('2','161','#a54f4e')" title="Seleccionar el color 161 como secundario">161</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#335a83;cursor:pointer;" onClick="javascript:PonerColor('2','162','#335a83')" title="Seleccionar el color 162 como secundario">162</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2d8772;cursor:pointer;" onClick="javascript:PonerColor('2','163','#2d8772')" title="Seleccionar el color 163 como secundario">163</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2f3d35;cursor:pointer;" onClick="javascript:PonerColor('2','164','#2f3d35')" title="Seleccionar el color 164 como secundario">164</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2b6c65;cursor:pointer;" onClick="javascript:PonerColor('2','165','#2b6c65')" title="Seleccionar el color 165 como secundario">165</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#307076;cursor:pointer;" onClick="javascript:PonerColor('2','166','#307076')" title="Seleccionar el color 166 como secundario">166</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7b4f83;cursor:pointer;" onClick="javascript:PonerColor('2','167','#7b4f83')" title="Seleccionar el color 167 como secundario">167</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5a3022;cursor:pointer;" onClick="javascript:PonerColor('2','168','#5a3022')" title="Seleccionar el color 168 como secundario">168</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#887b83;cursor:pointer;" onClick="javascript:PonerColor('2','169','#887b83')" title="Seleccionar el color 169 como secundario">169</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#827783;cursor:pointer;" onClick="javascript:PonerColor('2','170','#827783')" title="Seleccionar el color 170 como secundario">170</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#644a70;cursor:pointer;" onClick="javascript:PonerColor('2','171','#644a70')" title="Seleccionar el color 171 como secundario">171</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#36391d;cursor:pointer;" onClick="javascript:PonerColor('2','172','#36391d')" title="Seleccionar el color 172 como secundario">172</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#513021;cursor:pointer;" onClick="javascript:PonerColor('2','173','#513021')" title="Seleccionar el color 173 como secundario">173</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#583722;cursor:pointer;" onClick="javascript:PonerColor('2','174','#583722')" title="Seleccionar el color 174 como secundario">174</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5342d;cursor:pointer;" onClick="javascript:PonerColor('2','175','#a5342d')" title="Seleccionar el color 175 como secundario">175</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9a5a7a;cursor:pointer;" onClick="javascript:PonerColor('2','176','#9a5a7a')" title="Seleccionar el color 176 como secundario">176</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8d6771;cursor:pointer;" onClick="javascript:PonerColor('2','177','#8d6771')" title="Seleccionar el color 177 como secundario">177</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#894f70;cursor:pointer;" onClick="javascript:PonerColor('2','178','#894f70')" title="Seleccionar el color 178 como secundario">178</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4e2e3e;cursor:pointer;" onClick="javascript:PonerColor('2','179','#4e2e3e')" title="Seleccionar el color 179 como secundario">179</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#824728;cursor:pointer;" onClick="javascript:PonerColor('2','180','#824728')" title="Seleccionar el color 180 como secundario">180</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#862f29;cursor:pointer;" onClick="javascript:PonerColor('2','181','#862f29')" title="Seleccionar el color 181 como secundario">181</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#91462b;cursor:pointer;" onClick="javascript:PonerColor('2','182','#91462b')" title="Seleccionar el color 182 como secundario">182</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9a422c;cursor:pointer;" onClick="javascript:PonerColor('2','183','#9a422c')" title="Seleccionar el color 183 como secundario">183</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8b4f52;cursor:pointer;" onClick="javascript:PonerColor('2','184','#8b4f52')" title="Seleccionar el color 184 como secundario">184</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8a766e;cursor:pointer;" onClick="javascript:PonerColor('2','185','#8a766e')" title="Seleccionar el color 185 como secundario">185</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#192419;cursor:pointer;" onClick="javascript:PonerColor('2','186','#192419')" title="Seleccionar el color 186 como secundario">186</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1d391d;cursor:pointer;" onClick="javascript:PonerColor('2','187','#1d391d')" title="Seleccionar el color 187 como secundario">187</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2b4325;cursor:pointer;" onClick="javascript:PonerColor('2','188','#2b4325')" title="Seleccionar el color 188 como secundario">188</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2b432b;cursor:pointer;" onClick="javascript:PonerColor('2','189','#2b432b')" title="Seleccionar el color 189 como secundario">189</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#743e4f;cursor:pointer;" onClick="javascript:PonerColor('2','190','#743e4f')" title="Seleccionar el color 190 como secundario">190</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#498a51;cursor:pointer;" onClick="javascript:PonerColor('2','191','#498a51')" title="Seleccionar el color 191 como secundario">191</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5977c;cursor:pointer;" onClick="javascript:PonerColor('2','192','#a5977c')" title="Seleccionar el color 192 como secundario">192</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8f9181;cursor:pointer;" onClick="javascript:PonerColor('2','193','#8f9181')" title="Seleccionar el color 193 como secundario">193</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a59b2d;cursor:pointer;" onClick="javascript:PonerColor('2','194','#a59b2d')" title="Seleccionar el color 194 como secundario">194</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8d9b4d;cursor:pointer;" onClick="javascript:PonerColor('2','195','#8d9b4d')" title="Seleccionar el color 195 como secundario">195</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#90957d;cursor:pointer;" onClick="javascript:PonerColor('2','196','#90957d')" title="Seleccionar el color 196 como secundario">196</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#868830;cursor:pointer;" onClick="javascript:PonerColor('2','197','#868830')" title="Seleccionar el color 197 como secundario">197</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3f4d83;cursor:pointer;" onClick="javascript:PonerColor('2','198','#3f4d83')" title="Seleccionar el color 198 como secundario">198</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4c4b20;cursor:pointer;" onClick="javascript:PonerColor('2','199','#4c4b20')" title="Seleccionar el color 199 como secundario">199</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#967f4e;cursor:pointer;" onClick="javascript:PonerColor('2','200','#967f4e')" title="Seleccionar el color 200 como secundario">200</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#24354b;cursor:pointer;" onClick="javascript:PonerColor('2','201','#24354b')" title="Seleccionar el color 201 como secundario">201</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2a482c;cursor:pointer;" onClick="javascript:PonerColor('2','202','#2a482c')" title="Seleccionar el color 202 como secundario">202</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2a3b40;cursor:pointer;" onClick="javascript:PonerColor('2','203','#2a3b40')" title="Seleccionar el color 203 como secundario">203</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4a646a;cursor:pointer;" onClick="javascript:PonerColor('2','204','#4a646a')" title="Seleccionar el color 204 como secundario">204</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1c212e;cursor:pointer;" onClick="javascript:PonerColor('2','205','#1c212e')" title="Seleccionar el color 205 como secundario">205</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1d2b33;cursor:pointer;" onClick="javascript:PonerColor('2','206','#1d2b33')" title="Seleccionar el color 206 como secundario">206</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#344a4c;cursor:pointer;" onClick="javascript:PonerColor('2','207','#344a4c')" title="Seleccionar el color 207 como secundario">207</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3f5d77;cursor:pointer;" onClick="javascript:PonerColor('2','208','#3f5d77')" title="Seleccionar el color 208 como secundario">208</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2a5264;cursor:pointer;" onClick="javascript:PonerColor('2','209','#2a5264')" title="Seleccionar el color 209 como secundario">209</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#264550;cursor:pointer;" onClick="javascript:PonerColor('2','210','#264550')" title="Seleccionar el color 210 como secundario">210</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#382d5d;cursor:pointer;" onClick="javascript:PonerColor('2','211','#382d5d')" title="Seleccionar el color 211 como secundario">211</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#793527;cursor:pointer;" onClick="javascript:PonerColor('2','212','#793527')" title="Seleccionar el color 212 como secundario">212</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#9a917f;cursor:pointer;" onClick="javascript:PonerColor('2','213','#9a917f')" title="Seleccionar el color 213 como secundario">213</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#626b25;cursor:pointer;" onClick="javascript:PonerColor('2','214','#626b25')" title="Seleccionar el color 214 como secundario">214</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1f2719;cursor:pointer;" onClick="javascript:PonerColor('2','215','#1f2719')" title="Seleccionar el color 215 como secundario">215</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#986441;cursor:pointer;" onClick="javascript:PonerColor('2','216','#986441')" title="Seleccionar el color 216 como secundario">216</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#638d7b;cursor:pointer;" onClick="javascript:PonerColor('2','217','#638d7b')" title="Seleccionar el color 217 como secundario">217</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a56851;cursor:pointer;" onClick="javascript:PonerColor('2','218','#a56851')" title="Seleccionar el color 218 como secundario">218</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5642d;cursor:pointer;" onClick="javascript:PonerColor('2','219','#a5642d')" title="Seleccionar el color 219 como secundario">219</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a54c5d;cursor:pointer;" onClick="javascript:PonerColor('2','220','#a54c5d')" title="Seleccionar el color 220 como secundario">220</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5934f;cursor:pointer;" onClick="javascript:PonerColor('2','221','#a5934f')" title="Seleccionar el color 221 como secundario">221</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a5432d;cursor:pointer;" onClick="javascript:PonerColor('2','222','#a5432d')" title="Seleccionar el color 222 como secundario">222</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#232f46;cursor:pointer;" onClick="javascript:PonerColor('2','223','#232f46')" title="Seleccionar el color 223 como secundario">223</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#63342d;cursor:pointer;" onClick="javascript:PonerColor('2','224','#63342d')" title="Seleccionar el color 224 como secundario">224</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#545222;cursor:pointer;" onClick="javascript:PonerColor('2','225','#545222')" title="Seleccionar el color 225 como secundario">225</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5e9b2d;cursor:pointer;" onClick="javascript:PonerColor('2','226','#5e9b2d')" title="Seleccionar el color 226 como secundario">226</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1e3e2d;cursor:pointer;" onClick="javascript:PonerColor('2','227','#1e3e2d')" title="Seleccionar el color 227 como secundario">227</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#a1872c;cursor:pointer;" onClick="javascript:PonerColor('2','228','#a1872c')" title="Seleccionar el color 228 como secundario">228</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2e852a;cursor:pointer;" onClick="javascript:PonerColor('2','229','#2e852a')" title="Seleccionar el color 229 como secundario">229</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4e2b2e;cursor:pointer;" onClick="javascript:PonerColor('2','230','#4e2b2e')" title="Seleccionar el color 230 como secundario">230</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#825f28;cursor:pointer;" onClick="javascript:PonerColor('2','231','#825f28')" title="Seleccionar el color 231 como secundario">231</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#954f79;cursor:pointer;" onClick="javascript:PonerColor('2','232','#954f79')" title="Seleccionar el color 232 como secundario">232</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#8d3064;cursor:pointer;" onClick="javascript:PonerColor('2','233','#8d3064')" title="Seleccionar el color 233 como secundario">233</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#214820;cursor:pointer;" onClick="javascript:PonerColor('2','234','#214820')" title="Seleccionar el color 234 como secundario">234</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3b5522;cursor:pointer;" onClick="javascript:PonerColor('2','235','#3b5522')" title="Seleccionar el color 235 como secundario">235</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1d3531;cursor:pointer;" onClick="javascript:PonerColor('2','236','#1d3531')" title="Seleccionar el color 236 como secundario">236</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#865568;cursor:pointer;" onClick="javascript:PonerColor('2','237','#865568')" title="Seleccionar el color 237 como secundario">237</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#987041;cursor:pointer;" onClick="javascript:PonerColor('2','238','#987041')" title="Seleccionar el color 238 como secundario">238</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#823a28;cursor:pointer;" onClick="javascript:PonerColor('2','239','#823a28')" title="Seleccionar el color 239 como secundario">239</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#44977c;cursor:pointer;" onClick="javascript:PonerColor('2','240','#44977c')" title="Seleccionar el color 240 como secundario">240</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#67972d;cursor:pointer;" onClick="javascript:PonerColor('2','241','#67972d')" title="Seleccionar el color 241 como secundario">241</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#682d42;cursor:pointer;" onClick="javascript:PonerColor('2','242','#682d42')" title="Seleccionar el color 242 como secundario">242</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#2f8e39;cursor:pointer;" onClick="javascript:PonerColor('2','243','#2f8e39')" title="Seleccionar el color 243 como secundario">243</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4a2d20;cursor:pointer;" onClick="javascript:PonerColor('2','244','#4a2d20')" title="Seleccionar el color 244 como secundario">244</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#1a2f1b;cursor:pointer;" onClick="javascript:PonerColor('2','245','#1a2f1b')" title="Seleccionar el color 245 como secundario">245</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#48697a;cursor:pointer;" onClick="javascript:PonerColor('2','246','#48697a')" title="Seleccionar el color 246 como secundario">246</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#414f57;cursor:pointer;" onClick="javascript:PonerColor('2','247','#414f57')" title="Seleccionar el color 247 como secundario">247</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#673034;cursor:pointer;" onClick="javascript:PonerColor('2','248','#673034')" title="Seleccionar el color 248 como secundario">248</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5f2633;cursor:pointer;" onClick="javascript:PonerColor('2','249','#5f2633')" title="Seleccionar el color 249 como secundario">249</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#7e745f;cursor:pointer;" onClick="javascript:PonerColor('2','250','#7e745f')" title="Seleccionar el color 250 como secundario">250</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#4e4f46;cursor:pointer;" onClick="javascript:PonerColor('2','251','#4e4f46')" title="Seleccionar el color 251 como secundario">251</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#41403b;cursor:pointer;" onClick="javascript:PonerColor('2','252','#41403b')" title="Seleccionar el color 252 como secundario">252</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#89846f;cursor:pointer;" onClick="javascript:PonerColor('2','253','#89846f')" title="Seleccionar el color 253 como secundario">253</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#5c5446;cursor:pointer;" onClick="javascript:PonerColor('2','254','#5c5446')" title="Seleccionar el color 254 como secundario">254</div>
<div style="width:26px;border-right:solid 1px #D6D6D6;border-bottom:solid 1px #D6D6D6; float:left; padding:4px; background-color:#3c464e;cursor:pointer;" onClick="javascript:PonerColor('2','255','#3c464e')" title="Seleccionar el color 255 como secundario">255</div>
</div>
</td>
</tr>
<tr>
<td height="44" valign="middle" bgcolor="#FFFFFF">&nbsp;<font size="2px"><?php echo $Texto_Index_146;?>: </td>
<td valign="middle" bgcolor="#FFFFFF" style="font-size:18px; color:#FF6600; padding-left:60px">3<?php echo $Diminutivo?></td>
</tr>
<tr>
<td height="44" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF">
<hr/>
<input name="enviar" type="submit" value="<?php echo $Texto_Index_147;?>"/><hr/>
<hr/>
</td>
</tr>
</table>
</div>
</div>
</div>



</div>

<div id="menu-derecho">
<style>.rounded-img{display:inline-block;overflow:hidden;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.9);-moz-box-shadow:0 1px 3px rgba(0,0,0,.9);box-shadow:0 1px 3px rgba(0,0,0,.9);}</style>
<?php include "menu.php" ?>
</div>

<div id="pie"><hr><?php echo $NombreServidor?> Roleplay &copy; 2016</div> </td>
</tr>
</table>
</body>
<div id="lean_overlay"></div>
</html>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-104151474-1', 'auto');
  ga('send', 'pageview');

</script>
