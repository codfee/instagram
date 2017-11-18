# Instagram

![instagram](http://www.ironpaper.com/webintel/wp-content/uploads/2013/09/instagram-api.png)

> An easy-to-use and simple [Instagram](https://www.instagram.com/) package.

```php
use CodFee\Instagram\Instagram;

// Create a new instagram instance.
$instagram = new Instagram('your-access-token');

// Fetch the user's recent media feed.
$instagram->get();
```


## Installation

Instagram is decoupled from any library sending HTTP requests (like Guzzle), instead it uses an abstraction called [HTTPlug](http://httplug.io) which provides the http layer used to send requests to exchange rate services. This gives you the flexibility to choose what HTTP client and PSR-7 implementation you want to use.

Read more about the benefits of this and about what different HTTP clients you may use in the [HTTPlug documentation](http://docs.php-http.org/en/latest/httplug/users.html). Below is an example using [Guzzle 6](http://docs.guzzlephp.org/en/latest/index.html):

```bash
$ composer require codfee/instagram php-http/message php-http/guzzle6-adapter
```

## Usage

First you need to generate an access token using Pixel Union's [access token generator](http://instagram.pixelunion.net) or by creating an [Instagram application](https://www.instagram.com/developer/authentication).

```
5937104658.5688ed0.675p84e21a0341gcb3b44b1a13d9de91
```

Then create a new `CodFee\Instagram\Instagram` instance with your Instagram access token.

```php
use CodFee\Instagram\Instagram;

$instagram = new Instagram('Your-ACCESS-TOKEN');
```

To fetch the user's recent media data you may use the `get()` method.

```php
$instagram->get($table='users',$user='self',$condition='/media/recent');
default -> users/self/media/recent
$table = users,tags,media,locations
$instagram->getMediaById($id);
/media/$id?access_token=$token
```

> **Note:** You can only fetch a user's recent media from the given access token.

## License

<<<<<<< HEAD
=======
[MIT](LICENSE) © [Xalid Balagozov](https://phpdevelop.xyz)
>>>>>>> 2268f95d350dc2387484a26cef8808249ba27753
