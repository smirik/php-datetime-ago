<?php

namespace spec\Smirik\PHPDateTimeAgo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateTimeAgoSpec extends ObjectBehavior
{
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Smirik\PHPDateTimeAgo\DateTimeAgo');
    }
    
    function it_checks_daily()
    {
        $now = new \DateTime();
        $diff = $now->diff(new \DateTime('-3 hours'));
        $this->daily($diff)->shouldBe(true);

        $diff = $now->diff(new \DateTime('-25 hours'));
        $this->daily($diff)->shouldBe(false);

        $diff = $now->diff(new \DateTime('-50 hours'));
        $this->daily($diff)->shouldBe(false);
    }

    function it_checks_hourly()
    {
        $now = new \DateTime();
        $diff = $now->diff(new \DateTime('-3 minute'));
        $this->hourly($diff)->shouldBe(true);

        $diff = $now->diff(new \DateTime('-64 minutes'));
        $this->hourly($diff)->shouldBe(false);

        $diff = $now->diff(new \DateTime('-2 hours'));
        $this->hourly($diff)->shouldBe(false);
    }    
    
    function it_checks_now()
    {
        $this->get(new \DateTime())->shouldReturn("now");
        $this->get(new \DateTime('-5 seconds'))->shouldReturn("now");
        $this->get(new \DateTime('-25 seconds'))->shouldReturn("now");
        $this->get(new \DateTime('-59 seconds'))->shouldReturn("now");
    }
    
    function it_checks_minutes()
    {
        $this->get(new \DateTime('-3 minutes'))->shouldBe('3 minutes ago');
        $this->get(new \DateTime('-25 minutes'))->shouldBe('25 minutes ago');
        $this->get(new \DateTime('-61 minutes'))->shouldBe('1 hour ago');
    }
    
    function it_checks_hours()
    {
        $this->get(new \DateTime('-90 minutes'))->shouldBe('1 hour ago');
        $this->get(new \DateTime('-119 minutes'))->shouldBe('1 hour ago');
        $this->get(new \DateTime('-120 minutes'))->shouldBe('2 hours ago');
        $this->get(new \DateTime('-2 hours'))->shouldBe('2 hours ago');
    }
    
    function it_checks_days()
    {
        $this->get(new \DateTime('-24 hours'))->shouldBe('1 day ago');
        $this->get(new \DateTime('-2 days'))->shouldBe('2 days ago');
        $this->get(new \DateTime('-5 days'))->shouldBe('5 days ago');
        $this->setMaxDaysCount(3);
        $this->get(new \DateTime('-5 days'))->shouldNotBe('5 days ago');
    }
    
    function it_checks_format()
    {
        $this->get(new \DateTime('2001-01-01 23:59'), new \DateTime('2001-01-20 01:00'))->shouldBe('2001-01-01');
        $this->setFormat('Y-m-d H:i');
        $this->get(new \DateTime('2001-01-01 23:59'), new \DateTime('2001-01-20 01:00'))->shouldBe('2001-01-01 23:59');
    }
    
    function it_checks_russian()
    {
        $this->setTextTranslator(new \Smirik\PHPDateTimeAgo\TextTranslator\RussianTextTranslator());
        $this->get(new \DateTime())->shouldBe('сейчас');
        $this->get(new \DateTime('-3 minutes'))->shouldBe('3 минуты назад');
        $this->get(new \DateTime('-25 minutes'))->shouldBe('25 минут назад');
        $this->get(new \DateTime('-59 minutes'))->shouldBe('59 минут назад');
        $this->get(new \DateTime('-61 minutes'))->shouldBe('1 час назад');
        
        $this->get(new \DateTime('-24 hours'))->shouldBe('1 день назад');
        $this->get(new \DateTime('-2 days'))->shouldBe('2 дня назад');
        $this->get(new \DateTime('-5 days'))->shouldBe('5 дней назад');
        
    }

}
