<?php

use tests\TestCase;
use cache\Cache;

class CacheTest extends TestCase
{
    function testStartsEmpty() {
        $cache = new Cache();
        $this->assertNull($cache->get(1));
    }

    function testGet() {
        $cache = new Cache();
        $key = 'key1';
        $data = 'content for key1';
        $cache->put($key, $data);
        $this->assertEquals($cache->get($key), $data);
    }

    function testMultipleGet() {
        $cache = new Cache();
        $key = 'key1';
        $data = 'content for key1';
        $key2 = 'key2';
        $data2 = 'content for key2';
        $cache->put($key, $data);
        $cache->put($key2, $data2);
        $this->assertEquals($cache->get($key), $data);
        $this->assertEquals($cache->get($key2), $data2);
    }

    function testRemove() {
        $cache = new Cache(1000);
        $cache->put('key1', 'value1');
        $cache->put('key2', 'value2');
        $cache->put('key3', 'value3');
        $ret = $cache->remove('key2');
        $this->assertTrue($ret);
        $this->assertNull($cache->get('key2'));
        // test remove of already removed key
        $ret = $cache->remove('key2');
        $this->assertFalse($ret);
        // make sure no side effects took place
        $this->assertEquals($cache->get('key1'), 'value1');
        $this->assertEquals($cache->get('key3'), 'value3');
    }

    function testPutOverride() {
        $cache = new Cache();
        $key1 = 'key1';
        $value1 = 'value1forkey1';
        $key2 = 'key2';
        $value2 = 'value2forkey2';
        $key3 = 'key3';
        $value3 = 'value3forkey3';
        // fill the cache
        $cache->put($key1, $value1);
        $cache->put($key2, $value2);
        $cache->put($key3, $value3);
        // access some elements more often
        $this->assertEquals($value1, $cache->get($key1));
        $this->assertEquals($value2, $cache->get($key2));
        $this->assertEquals($value3, $cache->get($key3));
        $value4 = 'value4forkey4';
        $cache->put($key3, $value4);
        $this->assertEquals($value4, $cache->get($key3));
    }

}
