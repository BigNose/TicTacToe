<?php

class TicTacToe
{
	/**
	* @var array $board
	* Contains the current Board for this game.
	**/
	private $board;

	/**
	* @var Player $player1, $player2
	* Each contains one of the two players playing the game.
	*/
	private $player1;
	private $player2;
	
	/**
	* @var Player $currentPlayer
	* Contains the currently selected player.
	*/
	private $currentPlayer;
	
	/**
	* @param Board $board
	* @param Player $player1, $player2
	* Starts a new game and selects $player1 as the current player.
	*/
	public function __construct(Board $board, Player $player1, Player $player2)
	{
		$this->board = $board;
		$this->player1 = $player1;
		$this->player2 = $player2;
		$this->currentPlayer = $player1;
	}
	
	/**
	* @param int $row, $col
	* ToDo: Implement $currentPlayer and use getSymbol()
	* Sets an "X" in $row/$col
	**/
	public function move($row, $col)
	{
		$this->currentStatus();
		$this->board->placeSymbol('X', $row, $col);
	}
	
	/**
	* @param array $check
	* @return bool true
	* Returns true if $check is not empty and has 1 array element
	**/
	public function checkUnique($check)
	{
		if (count($check) === 1 && !empty($check[0]))
		{
			return true;
		}
	}
	
	/**
	* @return bool true
	* Checks the current Board for game state: ongoing, win or draw
	*/
	public function currentStatus()
	{
		//iterate through rows
		for ($iRow = 0; $iRow < count($this->board->getBoard()); $iRow++)
		{
			$checkRow = array_unique($this->board->getBoard()[$iRow]);

			//iterate through columns
			for ($iCol = 0; $iCol < count($this->board->getBoard()); $iCol++)
			{
				$checkCol[] = $this->board->getBoard()[$iCol][$iRow];
			}
			
			$currDiaCol = count($this->board->getBoard()) - 1 - ($iRow);
			$checkDiaLeft[] = $this->board->getBoard()[$iRow][$currDiaCol];
			$checkDiaRight[] = $this->board->getBoard()[$iRow][$iRow];
			
			//checking through the different victory conditions
			if ($this->checkUnique($checkDiaLeft) 
			 || $this->checkUnique($checkDiaRight) 
			 || $this->checkUnique($checkRow) 
			 || $this->checkUnique($checkCol))
			{
				return true;
			}
		}
	}
	
	/**
	* Checks which player is active and selects the other one.
	*/
	private function switchPlayer()
	{
		## ToDo, check active player and switch
	}
	
	//for testing; should only be in Board.php
	public function getBoard()
	{
		return $this->board;
	}
}

?>