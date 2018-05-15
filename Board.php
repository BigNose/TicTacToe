<?php

Class Board
{
	/**
	* @var array string $board
	* Contains the array used to represent the playing field.
	*/
	private $board;

	/**
	* Fills a new board object with an emtpy 3x3 field (array)
	*/
	public function __construct()
	{
		$this->board = [
			['','',''],
			['','',''],
			['','',''],
		];
	}
	
	/**
	* @param string $symbol
	* @param int $row
	* @param int $col
	* modifies $board by adding $symbol into the array at $row/$col
	*/
	public function placeSymbol($symbol, $row, $col)
	{
		$this->board[$row][$col] = $symbol;
	}
	
	/**
	* @param int $row
	* @param int $col
	* @return string
	* Returns value of $board array in position $row/$col
	*/
	public function returnSymbol($row, $col)
	{
		return($this->board[$row][$col]);
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