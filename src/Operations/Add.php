<?php

namespace cliCalc\Operations;

use cliCalc\OperationBase;

class Add extends OperationBase {

  static public $operator = '+';

  public function digits( $left_side, $right_side ) {
    $this->result = $left_side + $right_side;

    return $this;
  }
}
