<?php

namespace cliCalc;

class OperationBase implements OperationInterface {

  static public $result;

  public function get() {

    return $this->result;
  }
}
