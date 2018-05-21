<?php

Class Board
{
	/**
	* @var array string $board
	* Contains the array used to represent the playing field.
	*/
	private $board;

	/**
	* Fills a new board object with an emtpy 2-dimensional 3x3 array
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
	* modifies $board array by adding symbol into position given by $_GET
	*/
	public function placeSymbol()
	{
		for($row = 0; $row < count($this->board); $row++)
		{
			for($col = 0; $col < count($this->board[count($this->board) - 1]); $col++)
			{
				if(isset($_GET["cell-".$row."-".$col]))
				{
					if(empty($this->board[$row][$col]))
					{
						$this->board[$row][$col] = $_GET["cell-".$row."-".$col];
					}
				}
			}
		}
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
	* Returns the current state of the board as a 2-dimensional array of strings
	*/
	public function getBoard()
	{
		return $this->board;
	}
	
	/**
	* @return string $output
	* Returns current state of the board as whole HTML table
	*/
	public function getBoardHtml()
	{
		$output = '<table class="tic">';
		//iterating through rows
		for($row = 0; $row < count($this->board); $row++)
		{
			$output .= '<tr>';
			//iterating through columns
			for($col = 0; $col < count($this->board[count($this->board) - 1]); $col++)
			{
				$output .= '<td>';
				//check if array position contains empty string
				if($this->board[$row][$col] == '')
				{
					//add still free and clickable part to table output
					$output .= '<input type="submit" class="reset field" name="cell-'.$row.'-'.$col.'" value="X" />';
				}
				else //array position is already taken
				{
					//add array content to table output
					$output .= '<span class="color'.$this->board[$row][$col].'">'.$this->board[$row][$col].'</span>';
				}	
				$output .= '</td>';
			}	
			$output .= '</tr>';
		}
		$output .= '</table>';
		//return completed HTML table of current board
		return($output);
	}
}

?>