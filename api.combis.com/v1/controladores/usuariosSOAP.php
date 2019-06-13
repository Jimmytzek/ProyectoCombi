<?php
  $soap = new SoapServer(null, array('uri' =>
    'http://php.hoshmand.org/'));
  $soap->addFunction('add');
  $soap->handle();
  function add($a, $b) {
    return $a + $b;
  }
?>