# memcached-tools
Class based on memcached with more tools to manipulates keys and data in PHP projects

[Memcached Tools](https://github.com/Meloman-zz/memcached-tools) - to manipulates Memcached data in PHP projects

================================

This class provides some tools to manage Memcached data in PHP project.

## Functions and use

### del(string $mask, int $time = 0); (delete multiple keys)

function to delete many Memcached keys at once based on mask with wildcard.

```php
  $mem = new MemcachedTools('my_context');
  $mem->del('some.keys.*');
```

### getNestedKeys(string $delimiter = '.', array $nested = array()); (get nested array of keys)

function to get a nested array of all keys. The $delimiter makes the hierarchy.
If $nested is filled, the array will be merged with result 

```php
  $mem = new MemcachedTools('my_context');
  $mem->getNestedKeys();
```
