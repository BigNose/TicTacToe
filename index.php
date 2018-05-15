<?php

session_start();
//session_destroy();

require_once("TicTacToe.php");
require_once("Template.php");
require_once("Board.php");
require_once("Player.php");

$player1 = new Player("Spieler 1", "X");
$player2 = new Player("Spieler 2", "O");

echo $player1->getName()." ".$player1->getSymbol()."</br>";
echo $player2->getName()." ".$player2->getSymbol()."</br>";

if (isset($_SESSION['TicTacToe']))
{
	$game = unserialize($_SESSION['TicTacToe']);
	$row = null;
	$col = null;

	for ($i = 0; $i < count($game->getBoard()->getBoard()); $i++)
	{	
		for ($j = 0; $j < count($game->getBoard()->getBoard()); $j++)
		{
			if(isset($_GET['cell-'.$i.'-'.$j]))
			{
				$output = $_GET['cell-'.$i.'-'.$j];
				var_dump($output);
				$row = $i;
				$col = $j;
				break;
			}
		}
	}
	$game->move($row,$col);
} 
else 
{
	$board = new Board();
	$game = new TicTacToe($board, $player1, $player2);
}

$_SESSION['TicTacToe'] = serialize($game);

?>