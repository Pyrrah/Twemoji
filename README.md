# Pyrrah/Twemoji 😉

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Contributors][ico-contributors]][link-contributors]
[![Total Downloads][ico-downloads]][link-downloads]

This bundle allows you to replace emojis on a web page with emojis from the Twitter Emojis library (Twemoji).
Usually, the emojis used come from your system and they are different from one system to another.

Based on [Avris\Twemoji](https://gitlab.com/Avris/Twemoji).

*Since 2023, @jdecked has stopped working for Twitter but continues to maintain the package on Jdecked/Twemoji. The actually version used is 14.1.2.*

What is Twemoji ?
-----------------

[Twemoji](https://github.com/jdecked/twemoji) is a great way to make emoji's on your website independent of system and browser ([old repository](https://github.com/twitter/twemoji)).

Unless you just use this library to replace emojis with `<img>` tags in your backend.

Note: it will, of course, increase the server response time (instead removing a flash of system emojis before JS loads).
Therefore, it's better suited for generated static websites or HTTP cached requests.

Installation
------------

  1. To install this bundle, run the following [Composer](https://getcomposer.org/) command :

  ```
  composer require pyrrah/twemoji
  ```

  2. If you're using Symfony with autowiring, just register the service(s) :

  ```yaml
  # config/services.yaml
    Pyrrah\Twemoji\TwemojiService: ~
    Pyrrah\Twemoji\TwemojiExtension: ~
  ```


Usage
-----

In your controller :

  ```
  $twemoji->replace('Hello! 👋');
  // Hello! <img draggable="false" class="emoji" alt="👋" src="https://twemoji.maxcdn.com/v/14.0.2/svg/1f44b.svg">
  ```

Using Twig:
  ```
  {% filter twemoji %}
    <p>
        Hello! 👋
    </p>
  {% endfilter %}
  ```

  ```
  yourBestVar|twemoji
  ```

## Tests

  ```
  vendor/bin/phpunit
  ```

Credits
-------

- [Pierre-Yves Dick][link-author]
- [Andrea Prusinowski][link-author-origine]
- [All Contributors][link-contributors]

License
-------

This bundle is under the MIT license. For the full copyright and license
information please view the [License File](LICENSE) that was distributed with this source code.

[ico-version]: https://img.shields.io/packagist/v/pyrrah/twemoji.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-contributors]: https://img.shields.io/github/contributors/Pyrrah/twemoji?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pyrrah/twemoji.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pyrrah/twemoji
[link-downloads]: https://packagist.org/packages/pyrrah/twemoji
[link-author]: https://github.com/Pyrrah
[link-author-origine]: https://gitlab.com/Avris
[link-contributors]: ../../contributors