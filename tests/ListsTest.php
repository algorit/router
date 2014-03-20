<?php namespace Algorit\Router\Tests;

use Algorit\Router\Lists;

class ListsTest extends TestCase {

	public function __construct()
	{
		parent::__construct();

		$this->blacklist = new Lists;

		$this->data = '192.168.7.1';
	}

	public function testAddToList()
	{
		$this->blacklist = new Lists;
		$this->blacklist->add('blacklist', $this->data);

		$this->assertTrue(is_array($this->blacklist->get('blacklist')));
		$this->assertEquals(array($this->data), $this->blacklist->get('blacklist'));
	}

	public function testRemoveFromList()
	{
		$this->blacklist = new Lists;
		$this->blacklist->add('whitelist', $this->data);
		$this->assertEquals(array($this->data), $this->blacklist->get('whitelist'));

		$this->blacklist->remove('whitelist', '192.168.7.1');

		$this->assertTrue(is_array($this->blacklist->get('whitelist')));
		$this->assertEquals(array(), $this->blacklist->get('whitelist'));
	}

}