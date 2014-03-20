<?php namespace Algorit\Router\Tests;

use Mockery;
use Algorit\Router\Router;

class RouterTest extends TestCase {

	public function __construct()
	{
		parent::__construct();

		$request = Mockery::mock('Illuminate\Http\Request');
		$list = Mockery::mock('Algorit\Router\Contracts\ListInterface');

		$this->router = new Router($request, $list);
	}

	public function testInstance()
	{
		$this->assertInstanceof('Algorit\Router\Contracts\ListInterface', $this->router->getList());
	}
}