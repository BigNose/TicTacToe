<?php

Class Board
{
	/**
	* @var array string $board
	* Contains the array used to represent the playing field.
	*/
	private $board = array();

	/**
	* Fills a new board object with an emtpy 3x3 field (array)
	*/
	public function __construct()
	{
		$this->board = array(
			array("","",""),
			array("","",""),
			array("","",""),
			);
	}
	
	/**
	* modifies the board by adding $symbol into the array at $row/$col
	*/
	public function placeSymbol($symbol, $row, $col)
	{
		//var_dump($this->board);
		$this->board[$row][$col] = $symbol;
		var_dump($this->board);
	}
	
	/**
	* @return array string
	* Returns current state of the board
	*/
	public function getBoard()
	{
		return $this->board;
	}
}

?>