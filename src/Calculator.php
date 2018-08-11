<?php

namespace cliCalc;

class Calculator {

  private $op_namespace = '\\Operations\\';

  public function get($input) {

    $operators_passed = total_operators_passed($input);
    $fragments = fragmentify($input);

    for ($i = 0; $i < $operators_passed; $i++) {
      $alpha = array_slice($fragments, 0, 3);
      $omega = array_slice($fragments, 3);

      $class = __NAMESPACE__.$this->op_namespace.array_search($alpha[1], available_operations());

      if (!class_exists($class))
        return 'operation '.$alpha[1].' not allowed';

      $operator = new $class;

      unset($alpha[1]);

      $alpha = $operator
        ->digits(...$alpha)
        ->get();

      $fragments = array_merge([$alpha], $omega);
    }

    return $alpha;
  }
}

