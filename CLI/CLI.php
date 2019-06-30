<?php 

define(__ORIGIN_REPO__, 'https://raw.githubusercontent.com/jmjauregui/bubapp_microPHP/master/RequestFiles/');

$prompt = '';
echo "\n\nBUBAPP V0.1";
Start();


while ($prompt != "EXIT") {

	 $prompt = strtoupper(readline("\n-> "));
	 switch ($prompt) {
	 	case 'INFO':
	 			echo "\n\nBUBAPP V0.1 \n\n";
	 		break;
	 	case 'EXIT':
	 			echo "\n\n\n ADIOS.....\n";
	 		break;
	 	case 'FILE':
	 			MakeFile();
	 		break;
	 	case 'CREATE':
	 			$prompt = strtoupper(readline("\n>PAGE \n>COMPONENT \n>SERVICE \n>PROYECT \n>CONTROLLER \n\n[CREATE]: "));
	 			Create($prompt);
	 		break;
	 	case 'CLEAR':
	 			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	 				system('cls');
				} else {
	 				system('clear');

				}
	 		break;
	 	case 'HELP':
	 			Start();
	 		break;
	 	
	 	default:
	 		if ($prompt != '') {
	 			echo "\n [404][Comando '".$prompt."' no reconocido] \n";
	 		}
	 		break;
	 }

}

function Start()
{
	echo "\n| CREATE | HELP | INFO |\n";
}


function Create($prompt)
{
	 switch ($prompt) {
	 	case 'PAGE':
	 		Create_Page();
	 		break;
	 	
	 	case 'COMPONENT':
	 		# code...
	 		break;

	 	case 'CONTROLLER':
	 		Create_Controloller();
	 		break;
	 	
	 	case 'SERVICE':
	 		Create_Service();
	 		break;
	 	
	 	case 'PROYECT':
	 		Create_Proyect();
	 		break;
	 	
	 	default:
	 		echo "\n [CREATE][Comando de creacion no reconocido] \n";
	 		break;
	 }
}



function Create_Proyect()
{
	if (CreateDIR('Core')) {
			MakeFile('Core/bubaphp.php', file_get_contents(__ORIGIN_REPO__.'Core_Bubaphp.txt'));
			MakeFile('Core/bubaphpModels.php', file_get_contents(__ORIGIN_REPO__.'Core_BubaphpModels.txt'));
			MakeFile('Core/Configurations.php', file_get_contents(__ORIGIN_REPO__.'Core_Configuration.txt'));
	}	
	if (CreateDIR('Controller')) {
			MakeFile('Controller/Home.php', file_get_contents(__ORIGIN_REPO__.'starterPack/Controller_Home.txt'));
	}	
	if (CreateDIR('View')) {
		if (CreateDIR('View/MyFirstView')) {
			MakeFile('View/MyFirstView/index.php', file_get_contents(__ORIGIN_REPO__.'starterPack/View_index.txt'));
		}
	}	
	if (CreateDIR('Model')) {
			MakeFile('Model/ModelHome.php', file_get_contents(__ORIGIN_REPO__.'starterPack/Model_Home.txt'));
	}

	MakeFile('index.php', file_get_contents(__ORIGIN_REPO__.'index.txt'));
	MakeFile('.htaccess', file_get_contents(__ORIGIN_REPO__.'htaccess.txt'));
	echo "\n";
}



function Create_Page()
{
	$prompt = readline("-> Name Page: ");
	if($prompt){
		if (is_dir('Controller')) {
			
			$base64CodeController = "<?php\n\n/**\n * \n */\n\n\nclass ".ucfirst($prompt)." extends bubaphp\n{\n	\n\n	function __construct()\n	{\n		\n	}\n	public function index()\n	{\n		".base64_decode('JA==')."data = [\n			'SayHey' => '".ucfirst($prompt)."',\n		];\n		".base64_decode('JA==')."this->loadView('".ucfirst($prompt)."/index', ".base64_decode('JA==')."data);\n	}\n}\n\n?>";

			MakeFile('Controller/'.ucfirst($prompt).'.php', base64_encode($base64CodeController));


		}else{
			echo "\n [CRITICAL ERROR]: Folder 'Controller' No Exist\n";
			return 0;
		}

		if (is_dir('Model')) {
			$base64CodeModel = "<?php\n\n/**\n * \n */\n\n\nclass Model".ucfirst($prompt)." extends bubaphpModel\n{\n	\n\n	function __construct()\n	{\n		\n	}\n	public function demo(".base64_decode('JA==')."data)\n	{\n 		return  ".base64_decode('JA==')."data; \n	}\n}\n\n?>";

			MakeFile('Model/Model'.ucfirst($prompt).'.php', base64_encode($base64CodeModel));
		}else{
			echo "\n [CRITICAL ERROR]: Folder 'Model' No Exist\n";
			return 0;
		}


		if (is_dir('View')) {
			
			if (CreateDIR('View/'.ucfirst($prompt))) {
				$base64CodeController = "PCFET0NUWVBFIGh0bWw+CjxodG1sIGxhbmc9ImVuIj4KPGhlYWQ+Cgk8bWV0YSBjaGFyc2V0PSJVVEYtOCI+Cgk8dGl0bGU+QlVCQVBQIE1pY3JvUEhQPC90aXRsZT4KPC9oZWFkPgo8Ym9keT4KCgk8YnI+Cgk8YnI+Cgk8YnI+Cgk8YnI+Cgk8YnI+Cgk8Y2VudGVyPgoJCTxoMT48P3BocCBlY2hvICRwYXJhbXMtPlNheUhleSA/PiwgV2VsbGNvbWUgdG8gQnViYXBwPC9oMT4KCTwvY2VudGVyPgoJCjwvYm9keT4KPC9odG1sPgo=";
				MakeFile('View/'.ucfirst($prompt).'/index.php', $base64CodeController);
			}

		}else{
			echo "\n [CRITICAL ERROR]: Folder 'Model' No Exist\n";
			return 0;
		}


	}
}
 


function Create_Controloller()
{
	$prompt = readline("-> Controller Name: ");
	if($prompt){
		if (is_dir('Controller')) {
			
			$base64CodeController = "<?php\n\n/**\n * \n */\n\n\nclass ".ucfirst($prompt)." extends bubaphp\n{\n	\n\n	function __construct()\n	{\n		\n	}\n	public function index()\n	{\n		".base64_decode('JA==')."data = [\n			'SayHey' => 'HEY',\n		];\n		".base64_decode('JA==')."this->loadView('".ucfirst($prompt)."/index', ".base64_decode('JA==')."data);\n	}\n}\n\n?>";

			MakeFile('Controller/'.ucfirst($prompt).'.php', base64_encode($base64CodeController));
		}else{
			echo "\n [CRITICAL ERROR]: Folder 'Controller' No Exist";
			return 0;
		}
		if (is_dir('Model')) {
			$base64CodeModel = "<?php\n\n/**\n * \n */\n\n\nclass Model".ucfirst($prompt)." extends bubaphpModel\n{\n	\n\n	function __construct()\n	{\n		\n	}\n	public function demo(".base64_decode('JA==')."data)\n	{\n 		return  ".base64_decode('JA==')."data; \n	}\n}\n\n?>";

			MakeFile('Model/Model'.ucfirst($prompt).'.php', base64_encode($base64CodeModel));
		}else{
			echo "\n [CRITICAL ERROR]: Folder 'Model' No Exist";
			return 0;
		}
	}
}


function Create_Service()
{
	$prompt = ucfirst(readline("-> Service Name: "));
	if ($prompt != '') {
		$nombre_fichero = 'Controller/Services.php';
		if (file_exists($nombre_fichero)) {
			$data = (array)json_decode(file_get_contents("Controller/Services/ServiceConfig.json"));
		    array_push($data['ServicesNames'], $prompt);
		    MakeFile('Controller/Services/ServiceConfig.json', base64_encode(json_encode($data)));

		    $dataService = "<?php  \n/** \n* Service: ".$prompt." \n*/ \nclass ".$prompt." extends Bubaphp \n{ \n \n	function __construct() \n	{ \n		# code... \n	} \n	public function get() \n	{ \n		header('HTTP/1.0 200 GET operation completed'); \n	} \n	public function create() \n	{ \n		header('HTTP/1.0 201 SUCCESSFULLY CREATED'); \n	} \n	public function update() \n	{ \n		header('HTTP/1.0 202 ACCEPTED'); \n	} \n} \n?>";

   			MakeFile('Controller/Services/'.$prompt.'.php', base64_encode($dataService));

   			$Controllername = "ModelService".$prompt;
   			$dataModelService = "<?php \n/**\n * \n */\nclass ".$Controllername." extends bubaphpModel\n{\n	\n	function __construct()\n	{\n		\n	}\n	public function Demo(".base64_decode('JA==')."algo)\n	{\n		return ".base64_decode('JA==')."algo;\n	}\n}\n?>";
   			MakeFile('Model/'.$Controllername.'.php', base64_encode($dataModelService));
   			echo "\nServicio creado con exito\n";

		} else {
		   	MakeFile('Controller/Services.php', file_get_contents(__ORIGIN_REPO__.'service/Controller_service.txt'));
		    if (CreateDIR('Controller/Services')) {
		    	$data = [
				    "ServicesNames" => [
				        $prompt,
				    ],
				];
		    	MakeFile('Controller/Services/ServiceConfig.json', base64_encode(json_encode($data)));
		    	if (file_exists('Controller/Services/ServiceConfig.json')) {

		    		$dataService = "<?php  \n/** \n* Service: ".$prompt." \n*/ \nclass ".$prompt." extends Bubaphp \n{ \n \n	function __construct() \n	{ \n		# code... \n	} \n	public function get() \n	{ \n		header('HTTP/1.0 200 GET operation completed'); \n	} \n	public function create() \n	{ \n		header('HTTP/1.0 201 SUCCESSFULLY CREATED'); \n	} \n	public function update() \n	{ \n		header('HTTP/1.0 202 ACCEPTED'); \n	} \n} \n?>";

		   			MakeFile('Controller/Services/'.$prompt.'.php', base64_encode($dataService));

		   			$Controllername = "ModelService".$prompt;
		   			$dataModelService = "<?php \n/**\n * \n */\nclass ".$Controllername." extends bubaphpModel\n{\n	\n	function __construct()\n	{\n		\n	}\n	public function Demo(".base64_decode('JA==')."algo)\n	{\n		return ".base64_decode('JA==')."algo;\n	}\n}\n?>";
		   			MakeFile('Model/'.$Controllername.'.php', base64_encode($dataModelService));
   					echo "\nServicio creado con exito\n";
		    	}else{
		    		echo "\n [CRITICAL][Error desconocido] \n";
		    		return 0;
		    	}
		    }else{
		    	echo "\n [CRITICAL][No se puede crear la carpeta Services] \n";
		    	return 0;
		    }
		}
	}
}


// MISELANIUS AND UTILS
 
function CreateDIR($Ruta)
{
	if (!is_dir($Ruta)) {
		mkdir($Ruta, 0775);
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

function NOW()
{
    $ee = getdate();
    return $ee['year']."-".$ee['mon']."-".$ee['mday']." ".$ee['hours'].":".$ee['minutes'].":".$ee['seconds'];
}




?>