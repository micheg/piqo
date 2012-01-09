A URL shortening service written in php with slim microframework.
=================================================================

News:
-----

*2012 01 09*, *AUTH*: Basic functionality for managing authorized users. Still lack the opportunity to register.
Probably will be implemented after the custom URL module.

*2012 01 08*, *BASE62*: On request, using a hashing algorithm in base62.
So the service is no longer case insensitive.

*2012 01 08*, *IDIORM*: I switched from pure and simple "PDO" to "idiorm" a lightweight nearly-zero-configuration object-relational mapper and fluent query builder for PHP5.
Therefore, the project also requires idiorm. Download fromofficial site "idiorm.php" and copy to directory "vendor".
I need the sql max function, and since using a row query did not seem a big improvement over the "PDO" I used an approach like this:

    class ORM_EXT extends ORM
    {
        public static function for_table($table_name)
        {
            parent::_setup_db();
            return new self($table_name);
        }
        public function max($column)
        {
            if(method_exists('ORM', 'max')) return parent::max($column);
            $this->select_expr('MAX('.$column.')', 'maxvalue');
            $result = $this->find_one();
            return ($result !== false && isset($result->maxvalue)) ? (int) $result->maxvalue : 0;
        }
    }

I'm not sure the best way, I must investigate.

History:
--------

I wanted to learn *Slim* and *ender*, and I decided that the best way was a "tour de force" of twelve hours spent in documentation and some code.
From this was born the idea of a url shortening service, because it is easy to implement.
There is much work to do: it completely missing a part of administration, and I would like to use notorm instead of PDO.
I need to test on internet explorer, i have coded on a linux machine (chakra rulez!) and do not have an ie now.
This is only a small base.

Implementation choices:
-----------------------

I chose an algorithm for generating hashes very simple:
He recovers from the last DB Id (integer, autoincrement) then add 1 and converts everything into base 62.
The base 62 allows the use of letters and numbers. [0-9], [a-z] and [A-Z].
You can still get a good number of URLs "shortened" even with the base 62, for example by taking a hash of 5 characters we can index: 

62 * 62 * 62 * 62 * 62-1 => 916.132.831 urls!

Installation:
-------------

To install the application requires some frameworks:
Download *Slim PHP* from the official site and unpack into the directory "vendor."
Client side, I used *toast.css* and *ender.js*, for convenience the version used of these libraries is inside public_html.
I compiled ender as follows:
ender build domready qwery bean bonze reqwest

Todo:
-----

* Admin Interface
* bug fixing (???)
* Testing on internet explorer
* Add the possibility of using custom short url for hash bigger then 5 chars.
* be more social ;-)

.htaccss:
---------

I tried the following "htaccess" on many hosts including economic, and I never had any problems, then I suggest:

    <IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} !=/favicon.ico
    RewriteRule . /index.php [L]
    </IfModule>

Of course, feel free to use your preferred version, for more information I recommend the site of *Slim*.

References:
-----------

* [Slim](http://www.slimframework.com/), a PHP Microframework
* [ender](http://ender.no.de/), the no-library library
* [toast.css](http://daneden.me/toast/), a simple but complete CSS framework. 
* [idiorm.php](https://github.com/j4mie/idiorm), A lightweight nearly-zero-configuration object-relational mapper and fluent query builder for PHP5.

Live Sample:
------------

[piqo.it](http://www.piqo.it), a living demo.

Contact:
--------

* mail => [michelangelog@gmail.com](mailto://michelangelog@gmail.com)
* blog => [micheg.blogspot.com](http://micheg.blogspot.com)
