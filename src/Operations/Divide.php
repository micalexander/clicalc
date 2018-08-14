<?php

namespace cliCalc\Operations;

use cliCalc\OperationBase;

class Divide extends OperationBase {

  static public $operator = '/';
  static public $priority = 1;

  public function digits( $left_side, $right_side ) {
    $this->result = $left_side / $right_side;

    return $this;
  }
}


