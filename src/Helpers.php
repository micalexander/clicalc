<?php
namespace cliCalc;

function available_operations() {
  $files = glob(__DIR__.'/Operations/*.php');

  if (empty($files)) {
    death_note("no operations available");
  }

  $operations = [];

  foreach($files as $file) {
    $pathinfo = pathinfo($file);
    $filename = $pathinfo['filename'];
    $reflector = new \ReflectionClass(__NAMESPACE__.'\\Operations\\'.$filename);
    $operations[$filename] = $reflector->getStaticPropertyValue('operator');
  }
  return $operations;
}

function fragmentify($input) {
 return preg_split('/(\\'.implode('|\\', available_operations()).')/', $input, 0, PREG_SPLIT_DELIM_CAPTURE);
}

function total_operators_passed($input) {
  return intval(count(fragmentify($input))/2);
}

function priority_operators() {
  $priority_map = [];

  foreach (available_operations() as $name => $operator) {
    $reflector = new \ReflectionClass(__NAMESPACE__.'\\Operations\\'.$name);
    if (property_exists(__NAMESPACE__.'\\Operations\\'.$name, 'priority')) {

      $priority_map[$reflector->getStaticPropertyValue('priority')] = $reflector->getStaticPropertyValue('operator');
    }
  }

  return array_values($priority_map);

}
function death_note($note) {
  echo "\n".$note."\n\n";
  die;
}
