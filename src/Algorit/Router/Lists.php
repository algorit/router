<?php namespace Algorit\Router;

use Algorit\Router\Contracts\ListInterface;

class Lists implements ListInterface {

	protected $list = array('whitelist' => array(), 'blacklist' => array());

	public function add($list, $data)
	{	
		if( ! is_array($data))
		{
			$data = array($data);
		}

		$this->list[$list] = array_merge($this->list[$list], $data);

		return $this;
	}

	public function remove($list, $data)
	{
		if( ! is_array($data))
		{
			$data = array($data);
		}

		$this->list[$list] = array_diff($this->list[$list], $data);

		return $this;
	}

	public function get($list)
	{
		return $this->list[$list];
	}

}