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
	* the player objects representative symbol ingame
	*/
	private $symbol;
	
	/**
	* @param string $name
	* Name of the new player object
	* @param string $symbol
	* Character that represents the new player object in the game
	*/
	public function __construct($name, $symbol)
	{
		$this->setName($name);
		$this->setSymbol($symbol);
	}
	
	/**
	* @param string $name
	* Checks if the selected name is empty and sets the name of the player.
	*/
	private function setName($name)
	{
		if(empty($name))
		{
			die("Alle Spieler müssen einen Namen wählen!");
		}
		else
		{
			$this->name = $name;
		}
	}
	
	/**
	* @param string $symbol
	* Checks if the selected symbol is empty or >1 and sets the character to represent the player ingame.
	*/
	private function setSymbol($symbol)
	{
		if(empty($symbol))
		{
			die($this->name." muss ein Zeichen wählen! (keine Ziffern)");
		}
		elseif(strlen($symbol)>=2)
		{
			die($this->name." darf nur einen Buchstaben (und keine Ziffern) wählen!");
		}
		{
			$this->symbol = $symbol;
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