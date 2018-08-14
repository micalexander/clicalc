<?php

namespace cliCalc\Operations;

use cliCalc\OperationBase;

class Multiply extends OperationBase {

  static public $operator = '*';
  static public $priority = 5;

  public function digits( $left_side, $right_side ) {
    $this->result = $left_side * $right_side;

    return $this;
  }
}


