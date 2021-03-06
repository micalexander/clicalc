<?php

namespace cliCalc;

class Calculator {

  private $op_namespace = '\\Operations\\';

  private function prioritize($fragments) {
    foreach (priority_operators() as $operator) {
      $priority = array_search($operator, $fragments);
      if ($priority)
        return $priority;
    }
    return false;
  }

  public function get($input) {
    $operators_passed = total_operators_passed($input);
    $fragments = fragmentify($input);

    for ($i = 0; $i < $operators_passed; $i++) {
      $priority = $this->prioritize($fragments);

      if ($priority) {
        $alpha = array_slice($fragments, $priority-1, 3);
      }
      else {
        $alpha = array_slice($fragments, 0, 3);
        $omega = array_slice($fragments, 3);
      }

      $class = __NAMESPACE__.$this->op_namespace.array_search($alpha[1], available_operations());

      if (!class_exists($class))
        return 'operation '.$alpha[1].' not allowed';

      $operator = new $class;

      unset($alpha[1]);

      $alpha = $operator
        ->digits(...$alpha)
        ->get();

      if (!$priority) {
        $fragments = array_merge([$alpha], $omega);
      } else {
        array_splice($fragments, $priority-1, 3, $alpha);
      }
    }

    return $alpha;
  }
}

