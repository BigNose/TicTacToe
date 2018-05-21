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
	* Starts a new game and checks input validity, then selects $player1 as the current player.
	*/
	public function __construct(Board $board, Player $player1, Player $player2)
	{
		$this->board = $board;
		$this->player1 = $player1;
		$this->player2 = $player2;
		if($this->player1->getSymbol() == $this->player2->getSymbol())
		{
			echo("Both Players selected the same symbol!");
			die;
		}
		//Player 1 is the first to move
		$this->currentPlayer = $player1;
	}
	
	/**
	* Handles an entire move; calls win condition check and player switch
	**/
	public function move()
	{
		$this->board->placeSymbol();
		$winner = $this->currentStatus();
		
		if($winner === 1) //one player wins
		{
			echo('<b>'.$this->currentPlayer->getName().' wins!</b>');
			echo('<br/>(New Game starts in 5 seconds...)');
			session_destroy();
			header("Refresh:5;url=index.php");
			$this->board->stopInput();
		}
		elseif($winner === 2) //game is a draw
		{
			echo('<b>DRAW</b>');
			echo('<br/>(New Game starts in 5 seconds...)');
			session_destroy();
			header('Refresh:5;url=index.php');
			$this->board->stopInput();
		}
		else //none of the above
		{
			$this->switchPlayer();
		}
	}
	
	/**
	* @return integer
	* Checks the current Board for game state: ongoing, win (1) or draw (2)
	*/
	public function currentStatus()
	{
		$symbol = $this->getCurrentSymbol(); //symbol to check for
		$board = $this->board->getBoard();
		
		//check for column
		$counter = 0;
		for($col = 0; $col < count($board); $col++)
		{
			$counter = 0;
			for($row = 0; $row < count($board[count($board) - 1]); $row++)
			{
				if($board[$row][$col] == $symbol)
				{
					$counter += 1;
					if($counter === 3)
					{
						return (1);
					}
				}	
			}	
		}
		
		//check for row
		$counter = 0;
		for($row = 0; $row < count($board[count($board) - 1]); $row++)
		{
			$counter = 0;
			for($col = 0; $col < count($board); $col++)
			{
				if($board[$row][$col] == $symbol)
				{
					$counter += 1;
					if($counter === 3)
					{
						return (1);
					}
				}	
			}
		}
		
		//check for diagonal left
		$counter = 0;
		$col = 0;
		for($row = 0; $row < count($board[count($board) - 1]); $row++)
		{
			if($board[$row][$col] == $symbol)
			{
				$counter += 1;
				if($counter === 3)
				{
					return (1);
				}
			}
			$col++;
		}
		
		//check for diagonal right
		$counter = 0;
		$col = count($board[count($board) - 1]) - 1;
		for($row = 0; $row < count($board[count($board) - 1]); $row++)
		{
			if($board[$row][$col] == $symbol)
			{
				$counter += 1;
				if($counter === 3)
				{
					return (1);
				}
			}
			$col--;
		}
		
		//check for full board
		$counter = 0;
		for($row = 0; $row < count($board[count($board) - 1]); $row++)
		{
			for($col = 0; $col < count($board); $col++)
			{
				if($board[$row][$col] != "")
				{
					$counter += 1;
					if($counter === count($board) * count($board[count($board) - 1]))
					{
						return (2);
					}
				}	
			}
		}
	}
	
	/**
	* Checks which player is $currentPlayer and selects the other one.
	*/
	private function switchPlayer()
	{
		$board = $this->board->getBoard();
		for($row = 0; $row < count($board); $row++)
		{
			for($col = 0; $col < count($board[count($board) - 1]); $col++)
			{
				if(isset($_GET["cell-".$row."-".$col]))
				{
					if($this->player1->getSymbol() == $_GET["cell-".$row."-".$col])
					{
						$this->currentPlayer = $this->player2;
					}
					elseif($this->player2->getSymbol() == $_GET["cell-".$row."-".$col])
					{
						$this->currentPlayer = $this->player1;
					}
				}
			}
		}
	}
	
	/**
	* @return array string
	* Returns current board
	*/
	public function getBoard()
	{
		return $this->board;
	}
	
	/**
	* @return string
	* Returns the symbol of the currently selected player.
	*/
	public function getCurrentSymbol()
	{
		return($this->currentPlayer->getSymbol());
	}
}

?>