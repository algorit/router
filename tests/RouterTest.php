<?php namespace Algorit\Router\Tests;

use Mockery;
use Algorit\Router\Router;

class RouterTest extends TestCase {

	public function __construct()
	{
		parent::__construct();

		$this->app = Mockery::mock('Illuminate\Foundation\Application');
		$this->app->request = Mockery::mock('Illuminate\Http\Request');
	}

	public function testInstance()
	{
		$this->app->request->shouldReceive('getClientIp')
						   ->once()
						   ->andReturn('127.0.0.1');

		$router = new Router($this->app);

		$router->setList(Mockery::mock('Algorit\Router\Contracts\ListInterface'));

		$this->assertInstanceof('Algorit\Router\Contracts\ListInterface', $router->getList());
	}

	public function testProvider()
	{
		$this->app->request->shouldReceive('getClientIp')
			 ->once()
			 ->andReturn('127.0.0.1');

		$provider = Mockery::mock('Algorit\Router\RouteServiceProvider');

		$this->app->shouldReceive('register')
				  ->once()
				  ->andReturn($provider);

		$router = new Router($this->app);

		$provider = $router->registerProvider('Provider');

		$this->assertInstanceOf('Algorit\Router\RouteServiceProvider', $provider);
	}
}