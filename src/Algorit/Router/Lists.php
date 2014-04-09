<?php namespace Algorit\Router;

use Algorit\Router\Contracts\ListInterface;

class Lists implements ListInterface {

	/**
	 * Lists.
	 *
	 * @var array
	 */
	protected $list = array(
		'whitelist' => array(),
		'blacklist' => array()
	);

	/**
	 * Add to a given list.
	 *
	 * @return \Algorit\Router\Lists
	 */
	public function add($list, $data)
	{	
		$this->list[$list] = array_merge($this->list[$list], is_array($data) ?: array($data));

		return $this;
	}

	/**
	 * Remove from a list.
	 *
	 * @return \Algorit\Router\Lists
	 */
	public function remove($list, $data)
	{
		$this->list[$list] = array_diff($this->list[$list], is_array($data) ?: array($data));

		return $this;
	}

	/**
	 * Get all from list
	 *
	 * @return array
	 */
	public function get($list)
	{
		return $this->list[$list];
	}

}