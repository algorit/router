<?php namespace Algorit\Router;

use Closure;
use Illuminate\Http\Request;
use Algorit\Router\Contracts\ListInterface;

class Router {

	/**
	 * The request instance.
	 *
	 * @var \Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * The user ip.
	 *
	 * @var string
	 */
	private $ip;

	/**
	 * The list instance.
	 *
	 * @var \Algorit\Router\Contracts\ListInterface
	 */
	protected $list;

	/**
	 * Class constructor.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Algorit\Router\Contracts\ListInterface  $list
	 * @return \Algorit\Router\Router
	 */
	public function __construct(Request $request, ListInterface $list)
	{
		$this->ip = $request->getClientIp();
		$this->list = $list;
		$this->request = $request;
	}

	/**
	 * Get the list instance
	 *
	 * @return \Algorit\Router\Contracts\ListInterface 
	 */
	public function getList()
	{
		return $this->list;
	}

	/**
	 * Domain router.
	 *
	 * @return \Algorit\Router\Domain
	 */
	public function domain(Closure $callback)
	{
		if(php_sapi_name() == 'cli')
		{
			return false;
		}
        
		return $callback(new Domain($this->request));
	}

	/**
	 * Check if ip is whitelisted
	 *
	 * @return \Algorit\Router\Router
	 */
	public function whitelist(Closure $callback)
	{
		return $this->lists('whitelist', $callback);
	}

	/**
	 * Check if ip is blacklisted
	 *
	 * @return \Algorit\Router\Router
	 */
	public function blacklist(Closure $callback)
	{
		return $this->lists('blacklist', $callback);
	}

	/**
	 * Check if ip is in a given list
	 *
	 * @return \Algorit\Router\Router
	 */
	private function lists($list, Closure $callback)
	{
		if(in_array($this->ip, $this->list->get($list)))
		{
			return $callback($this);
		}

		return $this;
	}

}