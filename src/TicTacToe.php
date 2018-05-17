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
		//symbol
		if($this->currentPlayer === $this->player1)
		{
			$symbol = $this->player2->getSymbol();
		} 
		else
		{
			$symbol = $this->player1->getSymbol();
		}
		$board = $this->board->getBoard();
		
		//col
		$counter = 0;
		for($col = 0; $col <= 2; $col++)
		{
			$counter = 0;
			for($row = 0; $row <= 2; $row++)
			{
				if($board[$col][$row] == $symbol)
				{
					$counter += 1;
					if($counter === 3)
					{
						return (1);
					}
				}	
			}
		}
		
		//row
		$counter = 0;
		for($row = 0; $row <= 2; $row++)
		{
			$counter = 0;
			for($col = 0; $col <= 2; $col++)
			{
				if($board[$col][$row] == $symbol)
				{
					$counter += 1;
					if($counter === 3)
					{
						return (1);
					}
				}	
			}
		}
		
		//diagonal (\)
		$counter = 0;
		$row = 0;
		for($col = 0; $col <= 2; $col++)
		{
			if($board[$col][$row] == $symbol)
			{
				$counter += 1;
				if($counter === 3)
				{
					return (1);
				}
			}
			$row++;
		}
		
		//diagonal (/)
		$counter = 0;
		$row = 2;
		for($col = 0; $col <= 2; $col++)
		{
			if($board[$col][$row] == $symbol)
			{
				$counter += 1;
				if($counter === 3)
				{
					return (1);
				}
			}
			$row--;
		}
		
		//fullboard (3x3)
		$counter = 0;
		for($col = 0; $col <= 2; $col++)
		{
			for($row = 0; $row <= 2; $row++)
			{
				if($board[$col][$row] != "")
				{
					$counter += 1;
					if($counter === 9)
					{
						return (2);
					}
				}	
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