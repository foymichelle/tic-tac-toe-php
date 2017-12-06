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

    public function start() {
        $finished = false;

        while (!$finished) {
            $this->x_plays();
            $this->display_board();
            // TODO check_board
            $finished = true;
        }
    }

    public function get_position() {
        $valid = false;

        while (!$valid) {
            $input = readline("Enter position [1-9]: ");
            $value = intval($input);

            if (!is_int($value) or $value < 1 or $value > 9) {
                echo "Invalid input!\n";
            }
            else {
                $valid = true;
            }
        }

        return $input;
    }

    public function x_plays(){
        $position = $this->get_position();

        $this->board[$position] = "X";
    }

    public function o_plays() {
        // TODO
    }

    public function check_for_winner() {
        // TODO
    }

    public function check_board() {
        // TODO
    }

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