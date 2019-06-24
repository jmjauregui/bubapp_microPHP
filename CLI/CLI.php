<?php 


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
		echo "\n | -> [OK] Core";
	}	
	if (CreateDIR('Controller')) {
		echo "\n | -> [OK] Controller";
	}	
	if (CreateDIR('View')) {
		echo "\n | -> [OK] View";
	}	
	if (CreateDIR('Model')) {
		echo "\n | -> [OK] Model";
	}	
	echo "\n";

}











// MISELANIUS AND UTILS
 
function CreateDIR($Ruta)
{
	if (!is_dir($Ruta)) {
		mkdir($Ruta, 0700);
		return true;
	}else{
		echo "\e[0;42;10mCritical Error the folder ".$Ruta." already exist!\e[0m\n";
		return false;
	}
}

function MakeFile($FIleType)
{
	$myfile = fopen("Core/Bubaphp.php", "w") or die("Unable to open file!");
	$txt = base64_decode($FIleType);
	fwrite($myfile, $txt);
	fclose($myfile);
}




?>


