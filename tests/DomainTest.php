<?php namespace Algorit\Router\Tests;

use Mockery;
use Algorit\Router\Domain;

class DomainTest extends TestCase {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function testGetRoot()
	{
		$request = Mockery::mock('Illuminate\Http\Request');
		$request->shouldReceive('root')
				->once()
				->andReturn('http://example.com');

		$domain = new Domain($request);

		$this->assertEquals('http://example.com', $domain->getRoot());
	}

	public function testIsDomain()
	{
		$request = Mockery::mock('Illuminate\Http\Request');
		$request->shouldReceive('root')
				->once()
				->andReturn('http://example.com');

		$domain = new Domain($request);

		$make = $domain->is('http://example.com', function()
		{
			return 'tested!';
		});

		$this->assertEquals($make, 'tested!');
	}

	public function testIsNotDomain()
	{
		$request = Mockery::mock('Illuminate\Http\Request');
		$request->shouldReceive('root')
				->once()
				->andReturn('http://example.com');

		$domain = new Domain($request);

		$make = $domain->is('http://notexample.com', function()
		{
			return 'tested!';
		});

		$this->assertNotEquals($make, 'tested!');
		$this->assertInstanceOf('Algorit\Router\Domain', $make);
	}
}