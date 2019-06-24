<?php 


/**
 * 
 */
class bubaphpModel extends Bubaphp
{
	
	function __construct()
	{

	}

	public function conexion()
	{
		$varXX = mysqli_connect(__IPDB__, __USERDB__, __PASSDB__, __NAMEDB__) or die ($this->ErrorPage('DBNoExistConnection'));
		return $varXX;
	}

	public function simpleQuery($tabla, $where, $return)
	{
		$a = "SELECT * FROM ".$tabla." WHERE ".$where;
		$q = mysqli_query($this->conexion(), $a);
		if (mysqli_num_rows($q) > 0) {
			$data = [];
			while ($filas = mysqli_fetch_object($q)) {
				if ($return == 'array') {
					array_push($data, (array)$filas);
				}
				if ($return == 'object') {
					array_push($data, $filas);
				}
				if ($return == 'json') {
					array_push($data, $filas);
				}
			}
			if ($return == 'json') {
				return json_encode($data);
			}else{
				return $data;
			}
		}else{
			return $a;
		}
	}

	public function Query($query, $Retorno = null)
	{
		$a = $query;
		$q = mysqli_query($this->conexion(), $a);
		if (!$q) {
			return "<center> <div style='padding:30px; border:1px solid salmon; border-radius:3px;'><h3>Error SQL Model</h3><p>La consulta (".$a."), a generado un error en tiempo de ejecución</p><br></div> </center>";
		}
		if ($Retorno != null && $Retorno != '') {
			switch ($Retorno) {
				case 'json':
					if (mysqli_num_rows($q) > 0) {
						$arrayRetorno = [];
						while ($filas = mysqli_fetch_object($q)) {
							array_push($arrayRetorno, $filas);
						}
						return json_encode($arrayRetorno);
					}
					break;
				case 'array':
					if (mysqli_num_rows($q) > 0) {
						$arrayRetorno = [];
						while ($filas = mysqli_fetch_array($q)) {
							array_push($arrayRetorno, $filas);
						}
						return $arrayRetorno;
					}
					break;
				case 'object':
					if (mysqli_num_rows($q) > 0) {
						$arrayRetorno = [];
						while ($filas = mysqli_fetch_object($q)) {
							array_push($arrayRetorno, $filas);
						}
						return $arrayRetorno;
					}
					break;
				
				default:
					return "Param No ";
					break;
			}
		}else{
			return $q; //true | false
		}
	}

	public function simpleInsert($tabla, $arreglo)
	{
		$conexion = $this->conexion();
		$arryDeCampos = $this->Query("SELECT * FROM Information_Schema.Columns WHERE TABLE_SCHEMA = '".__NAMEDB__."' and TABLE_NAME = '".$tabla."'", 'array');
		$string_insert = "INSERT INTO ".$tabla." ";
		$string_columnas = [];
		$string_values = [];
		for ($i=0; $i < count($arryDeCampos) ; $i++) {
			array_push($string_columnas, $arryDeCampos[$i]['COLUMN_NAME']);
		}
		for ($i=0; $i < count($arryDeCampos) ; $i++) {
			array_push($string_values, "'".$arreglo[$arryDeCampos[$i]['COLUMN_NAME']]."'");
		}
		$insertFinal = $string_insert." (".implode(',', $string_columnas).") values(".implode(',', $string_values).")";
		$comprueba = $this->Query($insertFinal);
		if ($comprueba) {
			return "OK";
		}else{
			return "FAIL";
		}
	}

	public function simpleDelete($tabla,$where)
	{
		$conexion = $this->conexion();
		
		$string_delete = "DELETE FROM ".$tabla." WHERE ".$where;
		var_dump($string_delete);
		$comprueba = $this->Query($string_delete);
		var_dump($comprueba);
		if ($comprueba) {
			return "OK";
		}else{
			return "FAIL";
		}
	}

	public function simpleUpdate($tabla, $array)
	{
		$arryDeCampos = $this->Query("SELECT * FROM Information_Schema.Columns WHERE TABLE_SCHEMA = '".__NAMEDB__."' and TABLE_NAME = '".$tabla."'", 'array');
		if (count($arryDeCampos) > 0) {
			$array_columnas = [];
			$array_where = [];
			for ($i=0; $i < count($arryDeCampos) ; $i++) { 
				if ($array['update'][$arryDeCampos[$i]['COLUMN_NAME']] != null) {
					array_push($array_columnas, $arryDeCampos[$i]['COLUMN_NAME']." = "."'".$array['update'][$arryDeCampos[$i]['COLUMN_NAME']]."'");
				}
			}
			for ($i=0; $i < count($arryDeCampos) ; $i++) { 
				if ($array['where'][$arryDeCampos[$i]['COLUMN_NAME']] != null) {
					array_push($array_where, $arryDeCampos[$i]['COLUMN_NAME']." = "."'".$array['where'][$arryDeCampos[$i]['COLUMN_NAME']]."'");
				}
			}
			$return = $this->Query("UPDATE ".$tabla." SET ".implode(',', $array_columnas)." WHERE ".implode(' and ', $array_where));
			if ($return) {
				return "OK";
			}else{
				return "FAIL";
			}

		}else{

		}
	}

}


 ?>







































