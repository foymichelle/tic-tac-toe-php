<?php
/**
 * Created by PhpStorm.
 * User: michelle.foy
 * Date: 2017-12-05
 * Time: 8:04 PM
 */

class Game {

    public $board = array();
    public $size = 9;

    public function __construct() {
        // Initialize board
        $this->board = array(
            1 => "-",
            2 => "-",
            3 => "-",
            4 => "-",
            5 => "-",
            6 => "-",
            7 => "-",
            8 => "-",
            9 => "-"
        );
    }

    /*
     * Game starts.
     */
    public function start() {
        while (true) {
            $this->x_plays();
            $this->display_board();
            if ($this->check_if_over('X')) {
                break;
            }
            $this->o_plays();
            $this->display_board();
            if ($this->check_if_over('O')) {
                break;
            }
        }
    }

    /*
     * Get position from user.
     */
    public function get_position() {
        $valid = false;

        while (!$valid) {
            $input = readline("Enter position [1-9]: ");
            $value = intval($input);

            if (!is_int($value) or $value < 1 or $value > 9) {
                echo "Invalid input!\n";
            } else if ($this->board[$value] != '-') {
                echo "Please choose empty cell!";
            }
            else {
                $valid = true;
            }
        }

        return $input;
    }

    /*
     * X (user) makes move.
     */
    public function x_plays(){
        echo "X's turn!\n";
        $position = $this->get_position();

        $this->board[$position] = "X";
    }

    /*
     * O (computer) makes move.
     */
    public function o_plays() {
        echo "O's turn!\n";
        while (true) {
            $position = rand(1, 9);
            if ($this->board[$position] == '-') {
                break;
            }
        }

        $priority_cell_x = $this->will_win('X');
        $priority_cell_o = $this->will_win('O');

        // If 'X' is about to win, override position with priority_cell_x
        if ($priority_cell_x > 0) {
            $position = $priority_cell_x;
        }

        // If 'O' is about to win, override position with priority_cell_o
        if ($priority_cell_o > 0) {
            $position = $priority_cell_o;
        }

        $this->board[$position] = 'O';
    }

    /*
     * Find empty cell that will produce a win for $token. Return 0 if there is no such cell.
     */
    public function will_win($token) {
        $position = 0;
        for ($cell = 1; $cell < 10; $cell++) {
            if ($this->board[$cell] == '-') { // make sure cell is empty
                $this->board[$cell] = $token;
                if ($this->check_for_winner($token)) {
                    $position = $cell;
                    $this->board[$cell] = '-'; // reset cell
                    break;
                }
                $this->board[$cell] = '-'; // reset cell
            }
        }
        return $position;
    }

    /*
     * Return true $token is winner on board. Return false otherwise.
     */
    public function check_for_winner($token) {
        if ($this->board[1] == $token and $this->board[2] == $token and $this->board[3] == $token) { // horizontal 1
            return true;
        } else if ($this->board[4] == $token and $this->board[5] == $token and $this->board[6] == $token) { // horizontal 2
            return true;
        } else if ($this->board[7] == $token and $this->board[8] == $token and $this->board[9] == $token) { // horizontal 3
            return true;
        } else if ($this->board[1] == $token and $this->board[4] == $token and $this->board[7] == $token) { // vertical 1
            return true;
        } else if ($this->board[2] == $token and $this->board[5] == $token and $this->board[8] == $token) { // vertical 2
            return true;
        } else if ($this->board[3] == $token and $this->board[6] == $token and $this->board[9] == $token) { // vertical 3
            return true;
        } else if ($this->board[1] == $token and $this->board[5] == $token and $this->board[9] == $token) { // diagonal 1
            return true;
        } else if ($this->board[3] == $token and $this->board[5] == $token and $this->board[7] == $token) { // diagonal 2
            return true;
        } else {
            return false;
        }
    }

    /*
     * Return true if the board is full. Return false otherwise.
     */
    public function check_for_draw() {
        for ($cell = 1; $cell < 10; $cell++) {
            if ($this->board[$cell] == '-') {
                return false;
            }
        }
        return true;
    }

    /*
     * Return true if either a winner is found or game resulted in draw, thus signifying end of game. Return false otherwise.
     */
    public function check_if_over($token) {
        if ($this->check_for_winner($token)) {
            echo $token . " wins!\n";
            return true;
        } else if ($this->check_for_draw()) {
            echo "It's a draw!\n";
            return true;
        } else {
            return false;
        }
    }

    /*
     * Display tic tac toe board.
     */
    public function display_board() {
        print "\n";
        print "| " . $this->board[1] . " | " . $this->board[2] . " | ". $this->board[3] ." | \n";
        print "-------------\n";
        print "| " . $this->board[4] . " | " . $this->board[5] . " | ". $this->board[6] ." | \n";
        print "-------------\n";
        print "| " . $this->board[7] . " | " . $this->board[8] . " | ". $this->board[9] ." | \n";
        print "\n";
    }
}

$inst_G = new Game();
$inst_G->start();