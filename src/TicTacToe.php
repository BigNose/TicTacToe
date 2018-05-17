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
	//	$this->currentStatus();
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
		for ($row = 0; $row < count($this->board->getBoard()); $row++)
		{
			$checkRow = array_unique($this->board->getBoard()[$row]);

			//iterate through columns
			for ($col = 0; $col < count($this->board->getBoard()); $col++)
			{
				$checkCol[] = $this->board->getBoard()[$col][$row];
			}
			
			$currDiaCol = count($this->board->getBoard()) - 1 - ($row);
			$checkDiaLeft[] = $this->board->getBoard()[$row][$currDiaCol];
			$checkDiaRight[] = $this->board->getBoard()[$row][$row];
			
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