<?php namespace Algorit\Router\Contracts;

Interface ListInterface {

	public function add($group, $data);

	public function remove($group, $data);

	public function get($group);

}