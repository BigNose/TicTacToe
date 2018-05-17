<?php
session_start();
//session_destroy();

define ('BASEPATH', realpath(dirname(__FILE__)));
require_once (BASEPATH.DIRECTORY_SEPARATOR.'vendor' .DIRECTORY_SEPARATOR.'autoload.php');

//Is there already a session ongoing?
if (isset($_SESSION['TicTacToe']) && !empty($_SESSION['TicTacToe']))
{
	$TicTacToe = unserialize($_SESSION['TicTacToe']);
}
else //No session found, create new one
{
	$Player1 = new Player("Spieler 1", "X");
	$Player2 = new Player("Spieler 2", "O");
	$Board = new Board();
	$TicTacToe = new TicTacToe($Board, $Player1, $Player2);
}

//for testing
//$row == 0;
//$col == 0;

//$TicTacToe->move($row,$col);
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Tic-Tac-Toe. This is the title. It is displayed in the titlebar of the window in most browsers.</title>
    <meta name="description" content="Tic-Tac-Toe-Game. Here is a short description for the page. This text is displayed e. g. in search engine result listings.">
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
            <p>Type your game instructions here...</p>
            <form method="get" action="index.php">
			
				<?php
					print_r($TicTacToe->getBoard()->getBoard());
					echo($TicTacToe->getBoard()->getBoardHtml());
				?>
				
			</form>
        </article>
    </section>
</body>
</html>

<?php
	$_SESSION['TicTacToe'] = serialize($TicTacToe);
?>