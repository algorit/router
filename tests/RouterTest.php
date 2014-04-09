<?php namespace Algorit\Router\Tests;

use Mockery;
use Algorit\Router\Router;

class RouterTest extends TestCase {

	public function __construct()
	{
		parent::__construct();

		$this->request = Mockery::mock('Illuminate\Http\Request');
	}

	public function testInstance()
	{
		$this->request->shouldReceive('getClientIp')
					  ->once()
					  ->andReturn('127.0.0.1');

		$router = new Router($this->request, Mockery::mock('Algorit\Router\Contracts\ListInterface'));

		$this->assertInstanceof('Algorit\Router\Contracts\ListInterface', $router->getList());
	}

}