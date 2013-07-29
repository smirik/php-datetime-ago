How to integrate with Symfony2
==============================

It is easy to integrate `PHPDateTime` library with Symfony2 via Twig Extension.


#### Step 0. Add to composer

``` json
"require": {
    ...
    "smirik/php-datetime-ago": "dev-master"
}, ...
```

You can also use tags (~v1.0).

#### Step 1. Creating Twig Extension

First of all, create class in `Twig/Extension` directory in your bundle:

``` php
<?php
    
namespace Acme\DemoBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
use Twig_Extension;
use Twig_Filter_Method;

use \Smirik\PHPDateTimeAgo\DateTimeAgo as DateTimeAgo;

class DateTimeAgoExtension extends \Twig_Extension
{
    
    protected $container;
    
    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
      return array(
        'ago' => new Twig_Filter_Method($this, 'ago')
      );
    }

    public function ago($date)
    {
        /** Add your custom logic depending on locale */
        $locale = $this->container->get('request')->getLocale();
        if ($locale == 'ru') {
            $datetime_ago = new DateTimeAgo(new \Smirik\PHPDateTimeAgo\TextTranslator\RussianTextTranslator());
            $datetime_ago->setFormat('d.m.Y');
        }
        return $datetime_ago->get($date);
    }

    public function getName()
    {
      return 'ago.twig.extension';
    }
    
}
```

#### Step 2. Register extension in services.yml

Define the extension in `services.yml`. Container dependence is optional. If you don't need in locale support --- just remove it.

``` yaml
ago.twig.extension:
  class: Smirik\CoreBundle\Twig\Extension\DateTimeAgoExtension
  tags:
    - { name: twig.extension }
  calls:
      - [ setContainer, [ "@service_container" ]]
```

#### Step 3. Use it!

Remember, that `PHPDateTime` library accepts only `DateTime` objects. To format the date use `ago` twig filter.

``` php 
<?php

{{ task.createdAt|ago }}

```