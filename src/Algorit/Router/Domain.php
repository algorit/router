<?php namespace Algorit\Router;

use Closure;
use Illuminate\Http\Request;

class Domain {

	/**
	 * The request instance.
	 *
	 * @var \Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * Class constructor.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Algorit\Router\Domain
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Get the request.
	 *
	 * @return \Illuminate\Http\Request 
	 */
	public function getRequest()
	{
		return $this->request;
	}

	/**
	 * Get the root path.
	 *
	 * @return string
	 */
	public function getRoot()
	{
		return $this->request->root();
	}

	/**
	 * Check if current domain is the given domain.
	 *
	 * @return \Algorit\Router\Domain
	 */
	public function is($domain, Closure $callback)
	{
		if($domain == $this->getRoot())
		{
			return $callback();
		}

		return $this;
	}
}