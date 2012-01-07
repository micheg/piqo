A URL shortening service written in php with slim microframework.
=================================================================

History:
--------

I wanted to learn *Slim* and *ender*, and I decided that the best way was a "tour de force" of twelve hours spent in documentation and some code.
From this was born the idea of a url shortening service, because it is easy to implement.
There is much work to do: it completely missing a part of administration, and I would like to use notorm instead of PDO.
This is only a small base.

Implementation choices:
-----------------------

To facilitate the user there is no difference between hash written in uppercase or lowercase.
For this reason we chose an algorithm for generating hashes very simple:
He recovers from the last DB Id (integer, autoincrement) then add 1 and converts everything into base 36.
The base 36 allows the use of letters and numbers. [0-9] and [a-z].
You can still get a good number of URLs "shortened" even with the base 36, for example by taking a hash of 5 characters we can index:
36 * 36 * 36 * 36 * 36-1 => 60,466,175 urls!

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
* Switch to NotORM (<= probably)
* bug fixing (???)

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

Live Sample:
------------
[piqo.it](http://www.piqo.it), a living demo.

Contact:
--------
* mail => [michelangelog@gmail.com](mailto://michelangelog@gmail.com)
* blog => [micheg.blogspot.com](http://micheg.blogspot.com)
