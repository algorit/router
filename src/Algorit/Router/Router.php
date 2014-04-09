<?php namespace Algorit\Router;

use Closure;
use Illuminate\Foundation\Application;
use Algorit\Router\Contracts\ListInterface;

class Router {

	/**
	 * The app isntance.
	 *
	 * @var \Illuminate\Foundation\Application
	 */
	private $app;

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
	 * @param  \Illuminate\Foundation\Application  $app
	 * @return \Algorit\Router\Router
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
		$this->ip  = $app->request->getClientIp();
		$this->request = $app->request;
	}

	/**
	 * Set the list instance
	 *
	 * @param  \Algorit\Router\Contracts\ListInterface  $list
	 * @return \Algorit\Router\Router
	 */
	public function setList(ListInterface $list)
	{
		$this->list = $list;

		return $this;
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
		return $callback(new Domain($this->request));
	}

	/**
	 * Register a service provider
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function registerProvider($name)
	{
		return $this->app->register($name);
	}

	/**
	 * Check if ip is whitelisted
	 *
	 * @return \Algorit\Router\Router
	 */
	public function whitelist(Closure $callback)
	{
		if(in_array($this->ip, $this->list->get('whitelist')))
		{
			$callback();
		}

		return $this;
	}

	/**
	 * Check if ip is blacklisted
	 *
	 * @return \Algorit\Router\Router
	 */
	public function blacklist(Closure $callback)
	{
		if(in_array($this->ip, $this->list->get('blacklist')))
		{
			$callback();
		}

		return $this;
	}

}