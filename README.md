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

This transforms :

```php
Array
(
    [0] => memc.sess.key.1s5sgs25du7b3bc94snlkl1e7b
    [1] => memc.sess.key.lf3bh3i6du8vjgai3573ijg9so
    [2] => memc.sess.key.b33dpm6jh2uktva9t3l47aev43
    [3] => memc.sess.key.r5kmgegka7pb4tet76d7ms837t
	  ...
)
Array
(
    [memc] => Array
        (
            [sess] => Array
                (
                    [key] => Array
                        (
                            [1s5sgs25du7b3bc94snlkl1e7b] => Array
                                (
                                    [key] => memc.sess.key.1s5sgs25du7b3bc94snlkl1e7b
                                )
                            [lf3bh3i6du8vjgai3573ijg9so] => Array
                                (
                                    [key] => memc.sess.key.lf3bh3i6du8vjgai3573ijg9so
                                )
                            [b33dpm6jh2uktva9t3l47aev43] => Array
                                (
                                    [key] => memc.sess.key.b33dpm6jh2uktva9t3l47aev43
                                )
                            [r5kmgegka7pb4tet76d7ms837t] => Array
                                (
                                    [key] => memc.sess.key.r5kmgegka7pb4tet76d7ms837t
                                )
                            ...
                        )
                )
        )
)

