<?php

Class Player
{
	/**
	* @var string $name
	* Name of the player
	*/
	private $name;
	
	/**
	* @var string $symbol
	* The player objects representative symbol ingame
	*/
	private $symbol;
	
	/**
	* @param string $name
	* Name of the new player object
	* @param string $symbol
	* Character that represents the new player object in the game ("X" or "O")
	*/
	public function __construct($name, $symbol)
	{
		$this->setName($name);
		$this->setSymbol($symbol);
	}
	
	/**
	* @param string $name
	* Checks if the selected name is empty and sets the name of the player
	*/
	private function setName($name)
	{
		if(empty($name))
		{
			die('Alle Spieler müssen einen Namen wählen!');
		}
		else
		{
			$this->name = $name;
		}
	}
	
	/**
	* @param string $symbol
	* Makes sure the players can only select "X" or "O"
	*/
	private function setSymbol($symbol)
	{
		if($symbol === 'X' || $symbol === 'O')
		{
			$this->symbol = $symbol;
		}
		else
		{
			die($this->name.' darf nur "X" oder "O" wählen!');
		}
	}
	
	/**
	* @return string
	* Returns the name of the player object
	*/
	public function getName()
	{
		return($this->name);
	}
	
	/**
	* @return string
	* Returns the symbol used to represent the player object ingame
	*/
	public function getSymbol()
	{
		return($this->symbol);
	}
}
	
?>