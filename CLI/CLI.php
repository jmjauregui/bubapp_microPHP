<?php 

define(__ORIGIN_REPO__, 'https://raw.githubusercontent.com/jmjauregui/bubapp_microPHP/master/RequestFiles/');

$prompt = '';



while ($prompt != "EXIT") {
	
	 $prompt = readline("-> ");
	 switch ($prompt) {
	 	case 'EXIT':
	 			echo "\n\n\n ADIOS.....\n";
	 		break;
	 	case 'FILE':
	 			MakeFile();
	 		break;
	 	case 'CREATE':
	 			$prompt = readline("Help to Create | \n---------------| PAGE | COMPONENT | SERVICE |PROYECT | \n ->");
	 			Create($prompt);
	 		break;
	 	
	 	default:
	 		# code...
	 		break;
	 }

}

function Create($prompt)
{
	 switch ($prompt) {
	 	case 'PAGE':
	 		# code...
	 		break;
	 	
	 	case 'COMPONENT':
	 		# code...
	 		break;
	 	
	 	case 'SERVICE':
	 		# code...
	 		break;
	 	
	 	case 'PROYECT':
	 		Create_Proyect();
	 		break;
	 	
	 	default:
	 		# code...
	 		break;
	 }
}

function Create_Proyect()
{
	if (CreateDIR('Core')) {
			MakeFile('Core/bubaphp.php', file_get_contents(__ORIGIN_REPO__.'Core_Bubaphp.txt'));
			MakeFile('Core/bubaphpModel.php', file_get_contents(__ORIGIN_REPO__.'Core_BubaphpModels.txt'));
			MakeFile('Core/Configurations.php', file_get_contents(__ORIGIN_REPO__.'Core_Configuration.txt'));
	}	
	if (CreateDIR('Controller')) {

	}	
	if (CreateDIR('View')) {
	}	
	if (CreateDIR('Model')) {
	}

	MakeFile('index.php', file_get_contents(__ORIGIN_REPO__.'index.txt'));
	MakeFile('.htaccess', file_get_contents(__ORIGIN_REPO__.'htaccess.txt'));

	

	echo "\n";

}



 







// MISELANIUS AND UTILS
 
function CreateDIR($Ruta)
{
	if (!is_dir($Ruta)) {
		mkdir($Ruta, 0700);
		echo "\n | -> [DIR][OK] ".$Ruta;
		return true;
	}else{
		echo "\e[0;42;10mCritical Error the folder ".$Ruta." already exist!\e[0m\n";
		return false;
	}
}

function MakeFile($nameFile, $Content)
{
	$myfile = fopen($nameFile, "w") or die("Unable to open file!");
	$txt = base64_decode($Content);
	fwrite($myfile, $txt);
	fclose($myfile);
	echo "\n | ---> [FILE][CREATED] ".$nameFile;	

}




?>


