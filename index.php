<?php

session_start();

//load all sourcefiles with autoload
define ('BASEPATH', realpath(dirname(__FILE__)));
require_once (BASEPATH.DIRECTORY_SEPARATOR.'vendor' .DIRECTORY_SEPARATOR.'autoload.php');

//Is there already a session ongoing?
if (isset($_SESSION['TicTacToe']) && !empty($_SESSION['TicTacToe']))
{
	$TicTacToe = unserialize($_SESSION['TicTacToe']);
}
else //No session found, create new one
{
	$Player1 = new Player("Xena", "X");
	$Player2 = new Player("Olaf", "O");
	$Board = new Board();
	$TicTacToe = new TicTacToe($Board, $Player1, $Player2);
}
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Tic-Tac-Toe Browsergame</title>
    <meta name="description" content="Tic-Tac-Toe-Browsergame to play with your friends, enjoy and have fun!">
    <style>
        table.tic td {
            border: 1px solid #333; /* grey cell borders */
            width: 8rem;
            height: 8rem;
            vertical-align: middle;
            text-align: center;
            font-size: 4rem;
            font-family: Arial;
        }
        table { margin-bottom: 2rem; }
        input.field {
            border: 0;
            background-color: white;
            color: white; /* make the value invisible (white) */
            height: 8rem;
            width: 8rem;
            font-family: Arial;
            font-size: 4rem;
            font-weight: normal;
            cursor: pointer;
        }
        input.field:hover {
            color: #c81657; /* red on hover */
        }
        .colorX { color: #e77; } /* X is light red */
        .colorO { color: #77e; } /* O is light blue */
        table.tic { border-collapse: collapse; }
    </style>
</head>
<body>
   <section>
        <h1>Tic-Tac-Toe</h1>
        <article id="mainContent">
            <h2>Your free browsergame!</h2>
            <p>Play against your friends!</p>
            <form method="get" action="index.php">
			
				<?php				
					$TicTacToe->move();
					
					//output completed board
					echo($TicTacToe->getBoard()->getBoardHtml($TicTacToe->getCurrentSymbol()));
				?>
				
			</form>
        </article>
    </section>
</body>
</html>

<?php
	$_SESSION['TicTacToe'] = serialize($TicTacToe);
?>