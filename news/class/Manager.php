<?php
require_once('DbConnect.php');

abstract class Manager extends DbConnect  {
  abstract protected function add($obj);
  abstract protected function edit($obj);
  abstract protected function delete($obj);
  abstract protected function selectAll();
}