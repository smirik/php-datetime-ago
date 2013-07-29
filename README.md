php-datetime-ago
================

This library helps to format the date/time interval into text.

Examples
-------

| Condition | Text |
| --------- | ---- |
| Now | now |
| Less than an hour | xx minutes ago |
| Between 1 and 2 hours | 1 hour ago |
| Between 2 and 24 hours | xx hours ago |
| Between 1 and 2 days | 1 day ago |
| Between 2 and 10 days | xx days ago |
| More than 10 days ago | xxxx-xx-xx |

Usage
-----

`DateTimeAgo` class has public method `get`. It accepts 1 required argument (`\DateTime` object) and 1 optional (reference date. If it is `null`, current time is used).

```php
<?php
    $date_ago = new \Smirik\PHPDateTimeAgo\DateTimeAgo();
    $date_ago->get(new \DateTime('-24 hours')); /* returns "1 day ago" */
    $date_ago->get(new \DateTime('-69 minutes')); /* returns "1 hour ago" */
    $date_ago->get(new \DateTime('-100 minutes')); /* returns "2 hours ago" */
    $date_ago->get(new \DateTime('-155 minutes')); /* returns "3 hours ago" */
```

Russian translation:
```php
<?php
    $date_ago = new \Smirik\PHPDateTimeAgo\DateTimeAgo(new \Smirik\PHPDateTimeAgo\TextTranslator\RussianTextTranslator());
    $date_ago->get(new \DateTime('-24 hours')); /* returns "1 день назад" */
    $date_ago->get(new \DateTime('-69 minutes')); /* returns "1 час назад" */
    $date_ago->get(new \DateTime('-100 minutes')); /* returns "2 часа назад" */
    $date_ago->get(new \DateTime('-155 minutes')); /* returns "3 часа назад" */
```

Customization
-------------

#### Date formatter for more than 10 days

```php
<?php
    ...
    $date_ago->setFormat('d.m.Y H:i:s');
```
This setup date in format `01.01.2001 22:52:12`.

#### Custom translator

The DateTimeAgo constructor accept `TextTranslator` file as the first argument. By default `EnglishTextTranslator` is provided. You can add your custom translator to this constructor. Just make sure that your class implements `Smirik\PHPDateTimeAgo\TextTranslator\TextTranslatorInterface`. There is also standard way for translations based on pluralization procedure. The methods are already implemented for any language in `AbstractTextTranslator` class. English & Russian samples are already included in this package. You can also change the translator after creation:

```php
<?php
    ...
    $date_ago->setTextTranslator(new \Smirik\PHPDateTimeAgo\TextTranslator\RussianTextTranslator());
```

#### Implementation

* [How to integrate library with Symfony2](doc/Symfony2_twig_extension.md)

#### Tests

Most parts of the code are tested via `phpspec`. To run the tests clone the repository and run 
```bash
$ php bin/phpspec run
```

## Contribution

Any contribution is welcome.

## Acknowledgements

* Symfony cookbook for [Russian pluralization rule](http://symfony.com/doc/current/book/translation.html#explicit-interval-pluralization).
