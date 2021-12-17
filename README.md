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

Example deleting all moves for '7days' in the cache :

```php
Array
(
    [0] => myapp.customers.status.acquired
    [1] => myapp.customers.status.prospect
    [2] => myapp.moves.7days.2021-12-03
    [3] => myapp.moves.7days.2021-12-09
    [4] => myapp.moves.7days.2021-12-06
    [5] => myapp.moves.7days.2021-12-02
    [6] => myapp.moves.W.2021-12-01
    [7] => myapp.moves.W.2021-11-30
)

$mem->del('myapp.moves.7days.*');

Array
(
    [0] => myapp.customers.status.acquired
    [1] => myapp.customers.status.prospect
    [2] => myapp.moves.W.2021-12-01
    [3] => myapp.moves.W.2021-11-30
)
```

### getNestedKeys(string $delimiter = '.', array $nested = array()); (get nested array of keys)

function to get a nested array of all keys. The $delimiter makes the hierarchy.
If $nested is filled, the array will be merged with result 

```php
  $mem = new MemcachedTools('my_context');
  $mem->getNestedKeys();
```

First result on memcached PHP sessions :

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
```

Second result with my app cached data :

```php
Array
(
    [0] => myapp.customers.status.acquired
    [1] => myapp.customers.status.prospect
    [2] => myapp.moves.7days.2021-12-03
    [3] => myapp.moves.7days.2021-12-09
    [4] => myapp.moves.7days.2021-12-06
    [5] => myapp.moves.7days.2021-12-02
    [6] => myapp.moves.W.2021-12-01
    [7] => myapp.moves.W.2021-11-30
)
Array
(
    [myapp] => Array
        (
            [customers] => Array
                (
                    [status] => Array
                        (
			    [acquired] => Array
                                (
                                    [key] => mgc.customers.status.acquired
                                )
                            [prospect] => Array
                                (
                                    [key] => mgc.customers.status.prospect
                                )
                        )
                )
	    [moves] => Array
                (
                    [7days] => Array
                        (
                            [2021-12-03] => Array
                                (
                                    [key] => mgc.moves.7days.2021-12-03
                                )
                            [2021-12-09] => Array
                                (
                                    [key] => mgc.moves.7days.2021-12-09
                                )
                            [2021-12-06] => Array
                                (
                                    [key] => mgc.moves.7days.2021-12-06
                                )
                            [2021-12-02] => Array
                                (
                                    [key] => mgc.moves.7days.2021-12-02
                                )
                        )
                    [W] => Array
                        (
                            [2021-12-01] => Array
                                (
                                    [key] => mgc.moves.W.2021-12-01
                                )

                            [2021-11-30] => Array
                                (
                                    [key] => mgc.moves.W.2021-11-30
                                )
                        )

                )
	)
)
```
