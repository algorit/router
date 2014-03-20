<?php namespace Algorit\Router\Tests;

use Algorit\Router\Lists;

class ListsTest extends TestCase {

	public function __construct()
	{
		parent::__construct();

		$this->list = new Lists;

		$this->data = '192.168.7.1';
	}

	public function testAddToList()
	{
		$this->list = new Lists;
		$this->list->add('blacklist', $this->data);

		$this->assertTrue(is_array($this->list->get('blacklist')));
		$this->assertEquals(array($this->data), $this->list->get('blacklist'));
	}

	public function testRemoveFromList()
	{
		$this->list = new Lists;
		$this->list->add('whitelist', $this->data);
		$this->assertEquals(array($this->data), $this->list->get('whitelist'));

		$this->list->remove('whitelist', '192.168.7.1');

		$this->assertTrue(is_array($this->list->get('whitelist')));
		$this->assertEquals(array(), $this->list->get('whitelist'));
	}

}