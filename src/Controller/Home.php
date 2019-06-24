<?php 

/**
 * 
 */


class Home extends bubaphp
{
	

	function __construct()
	{
		
	}
	public function index()
	{
		$data = [
			'SayHey' => 'HEY',
		];
		$this->loadView('MyFirstView/index', $data);
	}
}

 ?>