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
	* Handles an entire move; calls player switch and win condition check
	**/
	public function move()
	{
		$this->switchPlayer();
		$this->board->placeSymbol();
		$winner = $this->currentStatus();
		// one of the players wins
		if($winner === 1)
		{
			if($this->currentPlayer === $this->player1)
			{
				$this->currentPlayer = $this->player2;
			}
			else
			{
				$this->currentPlayer = $this->player1;
			}
			echo($this->currentPlayer->getName().' wins!');
			echo("<br>New Game starts in 5 seconds");
			session_destroy();
			header("Refresh:5;url=index.php");
		}
		// game is a draw
		if($winner === 2)
		{
			echo("DRAW");
			echo("<br>New Game starts in 5 seconds");
			session_destroy();
			header("Refresh:5;url=index.php");	
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
		
		//row
		$counter = 0;
		for($row = 0; $row < count($this->board); $row++)
		{
			$counter = 0;
			for($col = 0; $col < count($this->board[count($this->board) - 1]); $col++)
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
		
		//col
		$counter = 0;
		for($col = 0; $col < count($this->board[count($this->board) - 1]); $col++)
		{
			$counter = 0;
			for($row = 0; $row < count($this->board); $row++)
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
		for($col = 0; $col < count($this->board[count($this->board) - 1]); $col++)
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
		for($col = 0; $col < count($this->board[count($this->board) - 1]); $col++)
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
		for($col = 0; $col < count($this->board[count($this->board) - 1]); $col++)
		{
			for($row = 0; $row < count($this->board); $row++)
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
		for($col = 0; $col < count($this->board[count($this->board) - 1]); $col++)
		{
			for($row = 0; $row < count($this->board); $row++)
			{
				if(isset($_GET["cell-".$col."-".$row]))
				{
					if($this->player1->getSymbol() == $_GET["cell-".$col."-".$row])
					{
						$this->currentPlayer = $this->player1;
					}
					if($this->player2->getSymbol() == $_GET["cell-".$col."-".$row])
					{
						$this->currentPlayer = $this->player2;
					}
				}
			}
		}
		if($this->currentPlayer === $this->player1)
		{
			$this->currentPlayer = $this->player2;
		}
		else
		{
			$this->currentPlayer = $this->player1;
		}
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