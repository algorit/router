<?php namespace Algorit\Router;

use Illuminate\Http\Request;
use Algorit\Router\Contracts\ListInterface;

class Router {

	/**
	 * User ip.
	 *
	 * @return void
	 */
	private $ip;

	public function __construct(Request $request, ListInterface $list)
	{
		$this->list = $list;
		$this->request = $request;
	}

	public function getList()
	{
		return $this->list;
	}

	protected function is_artisan()
	{
		return in_array($this->ip, array('127.0.0.1', '10.0.0.1'));
	}

	public function filter($filter, Closure $callback)
	{
		if($filter)
		{
			$callback();
		}

		return $this;
	}

	public function whitelist(Closure $callback)
	{
		if(in_array($this->ip, $this->list->get('whitelist')))
		{
			$callback();
		}

		return $this;
	}

	public function blacklist(Closure $callback)
	{
		if(in_array($this->ip, $this->list->get('blacklist')))
		{
			$callback();
		}

		return $this;
	}

}