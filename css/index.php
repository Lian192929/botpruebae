<?php

$NombreServidor	= "OmegaZone";							// Nombre del servidor
$Diminutivo		= "Oz";									// Iniciales del nombre del servidor

$activar_es		= 1;									// Mostrar modulo "Estado de los servidores"	[0 = Desactivado / 1 = Activado]
$activar_jc		= 1;									// Mostrar modulo "Jugadores Conectados"	    [0 = Desactivado / 1 = Activado]
$activar_fb		= 1;									// Mostrar modulo "Facebook"			        [0 = Desactivado / 1 = Activado]
$activar_tw		= 0;									// Mostrar modulo "Twitter"			            [0 = Desactivado / 1 = Activado]
$activar_pt		= 0;									// Mostrar puerto del servidor			        [0 = Desactivado / 1 = Activado]
$activar_pr		= 1;									// Mostrar Recuadro para comprar Prendas	    [0 = Desactivado / 1 = Activado]
$activar_apsa	= 0;									// Mostrar Recuadro de ultimas noticias	    	[0 = Desactivado / 1 = Activado]

$max_user		= 350;									// Maxima cantidad de slots activados

$color_cuadro	= "8A084B";								// Color de texto del cuadro

$FacebookURL	= "omegazonerp";						// URL de fanpage de Facebook
$YoutubeURL		= "user/linkinparktv";					// URL de Youtube
$TwitterID		= "";									// ID de Twitter

$serverIP		= "s1.omegazone.net";					// IP del Servidor
$serverIP2		= "127.0.0.1";							// IP del Servidor 2
$serverPort		= 7777;									// Puerto del Servidor

$ip_mysql    = "127.0.0.1";								// IP Base de datos GM
$nombre_db   = "gm_omegazone";							// Nombre base de datos GM
$user_sa     = "root";									// Usuario base de datos GM
$password_sa = "clave";									// Clave Base de datos GM

$ip_mysqlf    = "127.0.0.1";							// IP Base de datos Foro
$nombre_dbf   = "foro_omegazone";						// Nombre Base de datos Foro
$user_saf     = "root";									// Usuario Base de datos Foro
$password_saf = "clave";								// Clave Base de datos Foro

$youtube 		= "P-bTKNsKyyY";						// ID de video de Youtube para la pagina nuevo.php

$NombreCarpeta	= "";									// Nombre de la carpeta donde este instalado la web, ejemplo: /rol

/* Conexion a la base de datos GM */

try
{
  $con = new PDO("mysql:host=$ip_mysql;dbname=$nombre_db", $user_sa, $password_sa);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
  //echo 'Error conectando con la base de datos: ' . $e->getMessage();
  echo 'Error GM';
}

/* Conexion a la base de datos Foro */

try
{
  $con2 = new PDO("mysql:host=$ip_mysqlf;dbname=$nombre_dbf", $user_saf, $password_saf);
  $con2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
  //echo 'Error conectando con la base de datos: ' . $e->getMessage();
  echo 'Error Foro';
}

// Funciones

function ObtenerVelocidad($i)
{
	switch($i)
	{
		case 400: return 150;
		case 401: return 139;
		case 402: return 176;
		case 403: return 104;
		case 404: return 125;
		case 405: return 155;
		case 406: return 104;
		case 407: return 140;
		case 408: return 194;
		case 409: return 149;
		case 410: return 122;
		case 411: return 142;
		case 412: return 159;
		case 413: return 104;
		case 414: return 100;
		case 415: return 182;
		case 416: return 145;
		case 417: return 180;
		case 418: return 109;
		case 419: return 141;
		case 420: return 137;
		case 421: return 145;
		case 422: return 132;
		case 423: return 93;
		case 424: return 128;
		case 425: return 180;
		case 426: return 164;
		case 427: return 156;
		case 428: return 148;
		case 429: return 191;
		case 430: return 120;
		case 431: return 123;
		case 432: return 89;
		case 433: return 158;
		case 434: return 0;
		case 436: return 141;
		case 437: return 149;
		case 438: return 135;
		case 439: return 159;
		case 440: return 129;
		case 441: return 71;
		case 442: return 132;
		case 443: return 119;
		case 444: return 104;
		case 445: return 155;
		case 446: return 206;
		case 447: return 120;
		case 448: return 104;
		case 449: return 0;
		case 450: return 0;
		case 451: return 183;
		case 452: return 141;
		case 453: return 54;
		case 454: return 125;
		case 455: return 149;
		case 456: return 100;
		case 457: return 90;
		case 458: return 149;
		case 459: return 128;
		case 460: return 114;
		case 461: return 155;
		case 462: return 108;
		case 463: return 139;
		case 464: return 40;
		case 465: return 40;
		case 466: return 139;
		case 467: return 139;
		case 468: return 138;
		case 469: return 120;
		case 470: return 148;
		case 471: return 106;
		case 472: return 95;
		case 473: return 102;
		case 474: return 141;
		case 475: return 163;
		case 476: return 0;
		case 477: return 176;
		case 478: return 111;
		case 479: return 132;
		case 480: return 174;
		//
		//case 481: return 45;
		case 481: return 0;
		//
		case 482: return 148;
		case 483: return 116;
		case 484: return 57;
		case 485: return 94;
		case 486: return 61;
		case 487: return 181;
		case 488: return 181;
		case 489: return 132;
		case 490: return 148;
		case 491: return 141;
		case 492: return 133;
		case 493: return 150;
		case 494: return 203;
		case 495: return 167;
		case 496: return 154;
		case 497: return 181;
		case 498: return 102;
		case 499: return 116;
		case 500: return 133;
		case 501: return 0;
		case 502: return 203;
		case 503: return 203;
		case 504: return 163;
		case 505: return 132;
		case 506: return 169;
		case 507: return 157;
		case 508: return 102;
		//
		//case 509: return 45;
		//case 510: return 80;
		case 509: return 0;
		case 510: return 0;
		//
		case 511: return 0;
		case 512: return 0;
		case 513: return 0;
		case 514: return 114;
		case 515: return 134;
		case 516: return 149;
		case 517: return 149;
		case 518: return 155;
		case 519: return 0;
		case 520: return 255;
		case 521: return 155;
		case 522: return 160;
		case 523: return 144;
		case 524: return 123;
		case 525: return 152;
		case 526: return 149;
		case 527: return 141;
		case 528: return 167;
		case 529: return 141;
		case 530: return 57;
		case 531: return 66;
		case 532: return 104;
		case 533: return 158;
		case 534: return 159;
		case 535: return 149;
		case 536: return 163;
		case 537: return 0;
		case 538: return 0;
		case 539: return 94;
		case 540: return 141;
		case 541: return 195;
		case 542: return 155;
		case 543: return 142;
		case 544: return 140;
		case 545: return 139;
		case 546: return 141;
		case 547: return 135;
		case 548: return 140;
		case 549: return 145;
		case 550: return 137;
		case 551: return 149;
		case 552: return 114;
		case 553: return 130;
		case 554: return 136;
		case 555: return 150;
		case 556: return 104;
		case 557: return 104;
		case 558: return 147;
		case 559: return 168;
		case 560: return 160;
		case 561: return 145;
		case 562: return 168;
		case 563: return 0;
		case 564: return 0;
		case 565: return 156;
		case 566: return 151;
		case 567: return 164;
		case 568: return 138;
		case 569: return 0;
		case 570: return 0;
		case 571: return 88;
		case 572: return 57;
		case 573: return 104;
		case 574: return 57;
		case 575: return 149;
		case 576: return 149;
		case 577: return 0;
		case 578: return 123;
		case 579: return 149;
		case 580: return 145;
		case 581: return 146;
		case 582: return 129;
		case 583: return 81;
		case 584: return 0;
		case 585: return 145;
		case 586: return 138;
		case 587: return 156;
		case 588: return 102;
		case 589: return 154;
		case 590: return 0;
		case 591: return 0;
		case 592: return 0;
		case 593: return 0;
		case 594: return 0;
		case 595: return 95;
		case 596: return 166;
		case 597: return 166;
		case 598: return 166;
		case 599: return 149;
		case 600: return 142;
		case 601: return 104;
		case 602: return 160;
		case 603: return 162;
		case 604: return 139;
		case 605: return 143;
		case 606: return 94;
		case 607: return 0;
		case 608: return 0;
		case 609: return 102;
		case 610: return 0;
		case 611: return 0;
		default: return 0;
	}
}

function ObtenerMaltero($i)
{
    switch($i)
    {
        case 403: $maletero = 8; return $maletero;
		case 413: $maletero = 8; return $maletero;
		case 414: $maletero = 8; return $maletero;
		case 431: $maletero = 8; return $maletero;
		case 437: $maletero = 8; return $maletero;
		case 440: $maletero = 8; return $maletero;
		case 443: $maletero = 8; return $maletero;
		case 459: $maletero = 8; return $maletero;
		case 482: $maletero = 8; return $maletero;
		case 499: $maletero = 8; return $maletero;
		case 514: $maletero = 8; return $maletero;
		case 515: $maletero = 8; return $maletero;
		case 578: $maletero = 8; return $maletero;
		case 400: $maletero = 6; return $maletero;
		case 404: $maletero = 6; return $maletero;
		case 418: $maletero = 6; return $maletero;
		case 422: $maletero = 6; return $maletero;
		case 470: $maletero = 6; return $maletero;
		case 478: $maletero = 6; return $maletero;
		case 489: $maletero = 6; return $maletero;
		case 495: $maletero = 6; return $maletero;
		case 505: $maletero = 6; return $maletero;
		case 543: $maletero = 6; return $maletero;
		case 554: $maletero = 6; return $maletero;
		case 579: $maletero = 6; return $maletero;
		case 605: $maletero = 6; return $maletero;
		case 448: $maletero = 0; return $maletero;
		case 461: $maletero = 0; return $maletero;
		case 462: $maletero = 0; return $maletero;
		case 463: $maletero = 0; return $maletero;
		case 468: $maletero = 0; return $maletero;
		case 471: $maletero = 0; return $maletero;
		case 521: $maletero = 0; return $maletero;
		case 522: $maletero = 0; return $maletero;
		case 581: $maletero = 0; return $maletero;
		case 586: $maletero = 0; return $maletero;
		case 481: $maletero = 0; return $maletero;
		case 509: $maletero = 0; return $maletero;
		case 510: $maletero = 0; return $maletero;
		default:  $maletero = 4; return $maletero;
    }
}

function ObtenerCombustibleVeh($i)
{
	switch($i)
	{
		case 481: $comb = 0; return $comb;
		case 509: $comb = 0; return $comb;
		case 510: $comb = 0; return $comb;		
		case 571: $comb = 50; return $comb;
		case 457: $comb = 60; return $comb;
		case 461: $comb = 60; return $comb;
		case 462: $comb = 60; return $comb;
		case 468: $comb = 60; return $comb;
		case 471: $comb = 60; return $comb;
		case 521: $comb = 60; return $comb;
		case 522: $comb = 60; return $comb;
		case 581: $comb = 60; return $comb;
		case 586: $comb = 60; return $comb;
		case 424: $comb = 70; return $comb;
		case 463: $comb = 70; return $comb;
		case 568: $comb = 70; return $comb;
		case 411: $comb = 80; return $comb;
		case 434: $comb = 80; return $comb;
		case 439: $comb = 80; return $comb;
		case 442: $comb = 80; return $comb;
		case 415: $comb = 85; return $comb;
		case 429: $comb = 85; return $comb;
		case 436: $comb = 85; return $comb;
		case 477: $comb = 85; return $comb;
		case 492: $comb = 85; return $comb;
		case 529: $comb = 85; return $comb;
		case 545: $comb = 85; return $comb;
		case 401: $comb = 90; return $comb;
		case 402: $comb = 90; return $comb;
		case 405: $comb = 90; return $comb;
		case 410: $comb = 90; return $comb;
		case 419: $comb = 90; return $comb;
		case 420: $comb = 90; return $comb;
		case 421: $comb = 90; return $comb;
		case 445: $comb = 90; return $comb;
		case 451: $comb = 90; return $comb;
		case 480: $comb = 90; return $comb;
		case 491: $comb = 90; return $comb;
		case 494: $comb = 90; return $comb;
		case 496: $comb = 90; return $comb;
		case 500: $comb = 90; return $comb;
		case 502: $comb = 90; return $comb;
		case 503: $comb = 90; return $comb;
		case 504: $comb = 90; return $comb;
		case 506: $comb = 90; return $comb;
		case 507: $comb = 90; return $comb;
		case 516: $comb = 90; return $comb;
		case 517: $comb = 90; return $comb;
		case 526: $comb = 90; return $comb;
		case 527: $comb = 90; return $comb;
		case 533: $comb = 90; return $comb;
		case 540: $comb = 90; return $comb;
		case 541: $comb = 90; return $comb;
		case 542: $comb = 90; return $comb;
		case 546: $comb = 90; return $comb;
		case 547: $comb = 90; return $comb;
		case 550: $comb = 90; return $comb;
		case 555: $comb = 90; return $comb;
		case 558: $comb = 90; return $comb;
		case 559: $comb = 90; return $comb;
		case 562: $comb = 90; return $comb;
		case 565: $comb = 90; return $comb;
		case 566: $comb = 90; return $comb;
		case 585: $comb = 90; return $comb;
		case 589: $comb = 90; return $comb;
		case 600: $comb = 90; return $comb;
		case 603: $comb = 90; return $comb;
		case 426: $comb = 95; return $comb;
		case 518: $comb = 95; return $comb;
		case 549: $comb = 95; return $comb;
		case 580: $comb = 95; return $comb;
		case 587: $comb = 95; return $comb;
		case 409: $comb = 110; return $comb;
		case 418: $comb = 110; return $comb;
		case 535: $comb = 110; return $comb;
		case 543: $comb = 110; return $comb;
		case 605: $comb = 110; return $comb;
		case 422: $comb = 120; return $comb;
		case 423: $comb = 120; return $comb;
		case 478: $comb = 120; return $comb;
		case 483: $comb = 120; return $comb;
		case 489: $comb = 120; return $comb;
		case 495: $comb = 120; return $comb;
		case 554: $comb = 120; return $comb;
		case 579: $comb = 120; return $comb;
		case 588: $comb = 120; return $comb;
		case 593: $comb = 120; return $comb;
		case 400: $comb = 130; return $comb;
		case 440: $comb = 130; return $comb;
		case 413: $comb = 140; return $comb;
		case 459: $comb = 140; return $comb;
		case 482: $comb = 140; return $comb;
		case 498: $comb = 140; return $comb;
		case 499: $comb = 140; return $comb;
		case 609: $comb = 140; return $comb;
		case 414: $comb = 150; return $comb;
		case 508: $comb = 160; return $comb;
		case 470: $comb = 170; return $comb;
		case 578: $comb = 180; return $comb;
		case 456: $comb = 200; return $comb;
		case 487: $comb = 200; return $comb;
		case 524: $comb = 200; return $comb;
		case 408: $comb = 210; return $comb;
		case 443: $comb = 210; return $comb;
		case 431: $comb = 220; return $comb;
		case 437: $comb = 220; return $comb;
		case 515: $comb = 220; return $comb;
		case 514: $comb = 220; return $comb;
		case 455: $comb = 230; return $comb;
		case 403: $comb = 250; return $comb;
		default: $comb = 100; return $comb;
	}
}

function GetVehicleName($i)
{
	switch($i)
	{
		case 400: return "Landstalker";
		case 401: return "Bravura";
		case 402: return "Buffalo";
		case 403: return "Linerunner";
		case 404: return "Perenniel";
		case 405: return "Sentinel";
		case 406: return "Dumper";
		case 407: return "Firetruck";
		case 408: return "Trashmaster";
		case 409: return "Stretch";
		case 410: return "Manana";
		case 411: return "Infernus";
		case 412: return "Voodoo";
		case 413: return "Pony";
		case 414: return "Mule";
		case 415: return "Cheetah";
		case 416: return "Ambulancia";
		case 417: return "Leviathan";
		case 418: return "Moonbeam";
		case 419: return "Esperanto";
		case 420: return "Taxi";
		case 421: return "Washington";
		case 422: return "Bobcat";
		case 423: return "Mr. Whoopee";
		case 424: return "BF. Injection";
		case 425: return "Hunter";
		case 426: return "Premier";
		case 427: return "Enforcer";
		case 428: return "Securicar";
		case 429: return "Banshee";
		case 430: return "Predator";
		case 431: return "Bus";
		case 432: return "Rhino";
		case 433: return "Barracks";
		case 434: return "Hotknife";
		case 435: return "Article Trailer";
		case 436: return "Previon";
		case 437: return "Coach";
		case 438: return "Cabbie";
		case 439: return "Stallion";
		case 440: return "Rumpo";
		case 441: return "RC Bandit";
		case 442: return "Romero";
		case 443: return "Packer";
		case 444: return "Monster";
		case 445: return "Admiral";
		case 446: return "Squalo";
		case 447: return "Seasparrow";
		case 448: return "Pizzaboy";
		case 449: return "Tram";
		case 450: return "Article Trailer 2";
		case 451: return "Turismo";
		case 452: return "Speeder";
		case 453: return "Reefer";
		case 454: return "Tropic";
		case 455: return "Flatbed";
		case 456: return "Yankee";
		case 457: return "Caddy";
		case 458: return "Solair";
		case 459: return "Berkleys RC Van";
		case 460: return "Skimmer";
		case 461: return "PCJ-600";
		case 462: return "Faggio";
		case 463: return "Freeway";
		case 464: return "RCBaron";
		case 465: return "RCRaider";
		case 466: return "Glendale";
		case 467: return "Oceanic";
		case 468: return "Sanchez";
		case 469: return "Sparrow";
		case 470: return "Patriot";
		case 471: return "Quad";
		case 472: return "Coastguard";
		case 473: return "Dinghy";
		case 474: return "Hermes";
		case 475: return "Sabre";
		case 476: return "Rustler";
		case 477: return "ZR-350";
		case 478: return "Walton";
		case 479: return "Regina";
		case 480: return "Comet";
		case 481: return "BMX";
		case 482: return "Burrito";
		case 483: return "Camper";
		case 484: return "Marquis";
		case 485: return "Baggage";
		case 486: return "Dozer";
		case 487: return "Maverick";
		case 488: return "SAN News Maverick";
		case 489: return "Rancher";
		case 490: return "FBI Rancher";
		case 491: return "Virgo";
		case 492: return "Greenwood";
		case 493: return "Jetmax";
		case 494: return "Hotring";
		case 495: return "Sandking";
		case 496: return "Blista Compact";
		case 497: return "Police Maverick";
		case 498: return "Boxville";
		case 499: return "Benson";
		case 500: return "Mesa";
		case 501: return "RC Goblin";
		case 502: return "Hotring Racer A";
		case 503: return "Hotring Racer B";
		case 504: return "Bloodring Banger";
		case 505: return "Rancher";
		case 506: return "SuperGT";
		case 507: return "Elegant";
		case 508: return "Journey";
		case 509: return "Bike";
		case 510: return "Mountain Bike";
		case 511: return "Beagle";
		case 512: return "Cropduster";
		case 513: return "Stuntplane";
		case 514: return "Tanker";
		case 515: return "Roadtrain";
		case 516: return "Nebula";
		case 517: return "Majestic";
		case 518: return "Buccaneer";
		case 519: return "Shamal";
		case 520: return "Hydra";
		case 521: return "FCR-900";
		case 522: return "NRG-500";
		case 523: return "HPV1000";
		case 524: return "Cement Truck";
		case 525: return "Towtruck";
		case 526: return "Fortune";
		case 527: return "Cadrona";
		case 528: return "FBITruck";
		case 529: return "Willard";
		case 530: return "Forklift";
		case 531: return "Tractor";
		case 532: return "Combine Harvester";
		case 533: return "Feltzer";
		case 534: return "Remington";
		case 535: return "Slamvan";
		case 536: return "Blade";
		case 537: return "Freight";
		case 538: return "Brownstreak";
		case 539: return "Vortex";
		case 540: return "Vincent";
		case 541: return "Bullet";
		case 542: return "Clover";
		case 543: return "Sadler";
		case 544: return "Firetruck LA";
		case 545: return "Hustler";
		case 546: return "Intruder";
		case 547: return "Primo";
		case 548: return "Cargobob";
		case 549: return "Tampa";
		case 550: return "Sunrise";
		case 551: return "Merit";
		case 552: return "UtilityVan";
		case 553: return "Nevada";
		case 554: return "Yosemite";
		case 555: return "Windsor";
		case 556: return "Monster A";
		case 557: return "Monster B";
		case 558: return "Uranus";
		case 559: return "Jester";
		case 560: return "Sultan";
		case 561: return "Stratum";
		case 562: return "Elegy";
		case 563: return "Raindance";
		case 564: return "RC Tiger";
		case 565: return "Flash";
		case 566: return "Tahoma";
		case 567: return "Savanna";
		case 568: return "Bandito";
		case 569: return "Freight Flat Trailer (Train)";
		case 570: return "Streak Trailer (Train)";
		case 571: return "Kart";
		case 572: return "Mower";
		case 573: return "Dune";
		case 574: return "Sweepeer";
		case 575: return "Broadway";
		case 576: return "Tornado";
		case 577: return "AT400";
		case 578: return "DFT-30";
		case 579: return "Huntley";
		case 580: return "Stafford";
		case 581: return "BF-400";
		case 582: return "Newsvan";
		case 583: return "Tug";
		case 584: return "Petrol Trailer";
		case 585: return "Emperor";
		case 586: return "Wayfarer";
		case 587: return "Euros";
		case 588: return "Mobile Hotdog";
		case 589: return "Club";
		case 590: return "Freight Box Trailer (Train)";
		case 591: return "Article Trailer 3";
		case 592: return "Andromada";
		case 593: return "Dodo";
		case 594: return "RC Cam";
		case 595: return "Launch";
		case 596: return "LSPD";
		case 597: return "SFPD";
		case 598: return "LVPD";
		case 599: return "Ranger";
		case 600: return "Picador";
		case 601: return "S.W.A.T.";
		case 602: return "Alpha";
		case 603: return "Phoenix";
		case 604: return "Glendale";
		case 605: return "Sadler";
		case 606: return "Baggage Trailer A";
		case 607: return "Baggage Trailer B";
		case 608: return "Tug Stairs Trailer";
		case 609: return "Boxville";
		case 610: return "Farm Trailer";
		case 611: return "Utility Trailer";
		default: return "Error";
	}
}

function ObtenerPrecioAuto($i)
{
    switch($i)
    {
        case 492: $precioauto = 10; return $precioauto; case 515: $precioauto = 35; return $precioauto; 
		case 516: $precioauto = 10; return $precioauto; case 518: $precioauto = 10; return $precioauto;
        case 521: $precioauto = 35; return $precioauto; case 522: $precioauto = 35; return $precioauto; 
		case 524: $precioauto = 35; return $precioauto; case 526: $precioauto = 10; return $precioauto;
        case 527: $precioauto = 10; return $precioauto; case 514: $precioauto = 35; return $precioauto; 
		case 510: $precioauto = 35; return $precioauto; case 509: $precioauto = 10; return $precioauto;
        case 494: $precioauto = 35; return $precioauto; case 495: $precioauto = 35; return $precioauto; 
		case 499: $precioauto = 20; return $precioauto; case 502: $precioauto = 35; return $precioauto;
        case 503: $precioauto = 35; return $precioauto; case 504: $precioauto = 35; return $precioauto; 
		case 507: $precioauto = 10; return $precioauto; case 508: $precioauto = 35; return $precioauto;
        case 529: $precioauto = 10; return $precioauto; case 540: $precioauto = 10; return $precioauto; 
		case 571: $precioauto = 35; return $precioauto; case 575: $precioauto = 15; return $precioauto;
        case 576: $precioauto = 15; return $precioauto; case 581: $precioauto = 35; return $precioauto; 
		case 585: $precioauto = 10; return $precioauto; case 586: $precioauto = 25; return $precioauto;
        case 588: $precioauto = 35; return $precioauto; case 600: $precioauto = 15; return $precioauto; 
		case 568: $precioauto = 35; return $precioauto; case 562: $precioauto = 35; return $precioauto;
        case 559: $precioauto = 35; return $precioauto; case 541: $precioauto = 35; return $precioauto; 
		case 543: $precioauto = 10; return $precioauto; case 546: $precioauto = 10; return $precioauto;
        case 547: $precioauto = 10; return $precioauto; case 549: $precioauto = 15; return $precioauto; 
		case 550: $precioauto = 10; return $precioauto; case 555: $precioauto = 30; return $precioauto;
        case 558: $precioauto = 15; return $precioauto; case 605: $precioauto = 5;  return $precioauto; 
		case 401: $precioauto = 10; return $precioauto; case 423: $precioauto = 35; return $precioauto;
        case 424: $precioauto = 35; return $precioauto; case 426: $precioauto = 15; return $precioauto; 
		case 431: $precioauto = 35; return $precioauto; case 436: $precioauto = 10; return $precioauto;
        case 437: $precioauto = 35; return $precioauto; case 438: $precioauto = 10; return $precioauto; 
		case 439: $precioauto = 35; return $precioauto; case 440: $precioauto = 20; return $precioauto;
        case 422: $precioauto = 15; return $precioauto; case 421: $precioauto = 20; return $precioauto; 
		case 402: $precioauto = 35; return $precioauto; case 403: $precioauto = 35; return $precioauto;
        case 405: $precioauto = 20; return $precioauto; case 408: $precioauto = 35; return $precioauto; 
		case 410: $precioauto = 10; return $precioauto; case 413: $precioauto = 10; return $precioauto;
        case 418: $precioauto = 30; return $precioauto; case 419: $precioauto = 10; return $precioauto; 
		case 420: $precioauto = 15; return $precioauto; case 442: $precioauto = 35; return $precioauto;
        case 443: $precioauto = 35; return $precioauto; case 462: $precioauto = 25; return $precioauto; 
		case 467: $precioauto = 10; return $precioauto; case 468: $precioauto = 35; return $precioauto;
        case 470: $precioauto = 35; return $precioauto; case 471: $precioauto = 35; return $precioauto; 
		case 474: $precioauto = 15; return $precioauto; case 481: $precioauto = 20; return $precioauto;
        case 483: $precioauto = 20; return $precioauto; case 461: $precioauto = 35; return $precioauto; 
		case 459: $precioauto = 15; return $precioauto; case 434: $precioauto = 35; return $precioauto;
        case 455: $precioauto = 35; return $precioauto; case 457: $precioauto = 35; return $precioauto; 
		case 458: $precioauto = 10; return $precioauto; case 453: $precioauto = 35; return $precioauto;
        case 595: $precioauto = 35; return $precioauto; case 446: $precioauto = 35; return $precioauto; 
		case 493: $precioauto = 35; return $precioauto; case 452: $precioauto = 35; return $precioauto;
        case 473: $precioauto = 30; return $precioauto; case 454: $precioauto = 35; return $precioauto; 
		case 484: $precioauto = 35; return $precioauto; case 487: $precioauto = 110;return $precioauto;
    }
}

?>