<?php namespace Algorit\Router\Tests;

use Mockery;
use Algorit\Router\Router;

class RouterTest extends TestCase {

	public function __construct()
	{
		parent::__construct();

		$this->request = Mockery::mock('Illuminate\Http\Request');
	}

	public function testLists()
	{
		$this->request->shouldReceive('getClientIp')
				->once()
				->andReturn('127.0.0.1');

		$router = new Router($this->request, Mockery::mock('Algorit\Router\Contracts\ListInterface'));

		$this->assertInstanceof('Algorit\Router\Contracts\ListInterface', $router->getList());
	}

	public function testDomain()
	{
		$this->request->shouldReceive('getClientIp')
				->once()
				->andReturn('127.0.0.1');

		$router = new Router($this->request, Mockery::mock('Algorit\Router\Contracts\ListInterface'));

		$domain = $router->domain(function($domain)
		{
			return $domain;
		});	

		$this->assertInstanceOf('Algorit\Router\Domain', $domain);
	}

	public function testNotInList()
	{
		$this->request->shouldReceive('getClientIp')
				->once()
				->andReturn('127.0.0.1');

		$list = Mockery::mock('Algorit\Router\Contracts\ListInterface');
		$list->shouldReceive('get')
			 ->with('whitelist')
			 ->once()
			 ->andReturn(array());

		$list->shouldReceive('get')
			 ->with('blacklist')
			 ->once()
			 ->andReturn(array());

		$router = new Router($this->request, $list);

		$whitelist = $router->whitelist(function()
		{
			return 'this will never be returned';
		});

		$this->assertNotEquals('this will never be returned', $whitelist);
		$this->assertInstanceOf('Algorit\Router\Router', $whitelist);

		$blacklist = $router->blacklist(function()
		{
			return 'this will never be returned';
		});

		$this->assertNotEquals('this will never be returned', $blacklist);
		$this->assertInstanceOf('Algorit\Router\Router', $blacklist);
	}

	public function testInList()
	{
		$this->request->shouldReceive('getClientIp')
				->once()
				->andReturn('127.0.0.1');

		$list = Mockery::mock('Algorit\Router\Contracts\ListInterface');
		$list->shouldReceive('get')
			 ->with('whitelist')
			 ->once()
			 ->andReturn(array('127.0.0.1'));

		$list->shouldReceive('get')
			 ->with('blacklist')
			 ->once()
			 ->andReturn(array('127.0.0.1'));

		$router = new Router($this->request, $list);

		$whitelist = $router->whitelist(function()
		{
			return 'this will be returned';
		});

		$this->assertEquals('this will be returned', $whitelist);

		$blacklist = $router->blacklist(function()
		{
			return 'this will be returned';
		});

		$this->assertEquals('this will be returned', $blacklist);
	}
}