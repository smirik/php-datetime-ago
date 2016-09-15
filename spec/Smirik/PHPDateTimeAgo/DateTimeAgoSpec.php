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

    function it_checks_weeks_in_english_when_enabled()
    {
        $translator = new \Smirik\PHPDateTimeAgo\TextTranslator\EnglishTextTranslator;
        $translator->enableWeeksMonthsYears(TRUE);
        $this->setTextTranslator($translator);
        $this->get(new \DateTime('-6 days'))->shouldBe('6 days ago');
        $this->get(new \DateTime('-7 days'))->shouldBe('1 week ago');
        $this->get(new \DateTime('-14 days'))->shouldBe('2 weeks ago');
        $this->get(new \DateTime('-29 days'))->shouldBe('4 weeks ago');
    }

    function it_checks_months_in_english_when_enabled()
    {
        $translator = new \Smirik\PHPDateTimeAgo\TextTranslator\EnglishTextTranslator;
        $translator->enableWeeksMonthsYears(TRUE);
        $this->setTextTranslator($translator);
        $this->get(new \DateTime('-30 days'))->shouldBe('1 month ago');
        $this->get(new \DateTime('-70 days'))->shouldBe('2 months ago');
        $this->get(new \DateTime('-364 days'))->shouldBe('11 months ago');
    }

    function it_checks_years_in_english_when_enabled()
    {
        $translator = new \Smirik\PHPDateTimeAgo\TextTranslator\EnglishTextTranslator;
        $translator->enableWeeksMonthsYears(TRUE);
        $this->setTextTranslator($translator);
        $this->get(new \DateTime('-365 days'))->shouldBe('1 year ago');
        $this->get(new \DateTime('-729 days'))->shouldBe('1 year ago');
        $this->get(new \DateTime('-15 years'))->shouldBe('15 years ago');
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

    function it_checks_italian()
    {
        $this->setTextTranslator(new \Smirik\PHPDateTimeAgo\TextTranslator\ItalianTextTranslator());

        $this->get(new \DateTime())->shouldBe('ora');
        $this->get(new \DateTime('-5 seconds'))->shouldReturn('ora');
        $this->get(new \DateTime('-25 seconds'))->shouldReturn('ora');
        $this->get(new \DateTime('-59 seconds'))->shouldReturn('ora');

        $this->get(new \DateTime('-1 minutes'))->shouldBe('1 minuto fa');
        $this->get(new \DateTime('-3 minutes'))->shouldBe('3 minuti fa');
        $this->get(new \DateTime('-25 minutes'))->shouldBe('25 minuti fa');
        $this->get(new \DateTime('-59 minutes'))->shouldBe('59 minuti fa');
        $this->get(new \DateTime('-61 minutes'))->shouldBe('1 ora fa');

        $this->get(new \DateTime('-24 hours'))->shouldBe('1 giorno fa');
        $this->get(new \DateTime('-2 days'))->shouldBe('2 giorni fa');
        $this->get(new \DateTime('-5 days'))->shouldBe('5 giorni fa');

    }

    function it_checks_german()
    {
        $this->setTextTranslator(new \Smirik\PHPDateTimeAgo\TextTranslator\GermanTextTranslator());

        //now
        $this->get(new \DateTime())->shouldReturn('jetzt');
        $this->get(new \DateTime('-5 seconds'))->shouldReturn('jetzt');
        $this->get(new \DateTime('-25 seconds'))->shouldReturn('jetzt');
        $this->get(new \DateTime('-59 seconds'))->shouldReturn('jetzt');

        //minutes
        $this->get(new \DateTime('-1 minutes'))->shouldBe('vor einer Minute');
        $this->get(new \DateTime('-3 minutes'))->shouldBe('vor 3 Minuten');
        $this->get(new \DateTime('-25 minutes'))->shouldBe('vor 25 Minuten');
        $this->get(new \DateTime('-59 minutes'))->shouldBe('vor 59 Minuten');
        $this->get(new \DateTime('-61 minutes'))->shouldBe('vor einer Stunde');

        //hours
        $this->get(new \DateTime('-90 minutes'))->shouldBe('vor einer Stunde');
        $this->get(new \DateTime('-119 minutes'))->shouldBe('vor einer Stunde');
        $this->get(new \DateTime('-2 hours'))->shouldBe('vor 2 Stunden');

        //days
        $this->get(new \DateTime('-24 hours'))->shouldBe('vor einem Tag');
        $this->get(new \DateTime('-2 days'))->shouldBe('vor 2 Tagen');
        $this->get(new \DateTime('-5 days'))->shouldBe('vor 5 Tagen');
    }

    function it_checks_portuguese()
    {
        $this->setTextTranslator(new \Smirik\PHPDateTimeAgo\TextTranslator\PortugueseTextTranslator());

        $this->get(new \DateTime())->shouldBe('agora');
        $this->get(new \DateTime('-5 seconds'))->shouldReturn('agora');
        $this->get(new \DateTime('-25 seconds'))->shouldReturn('agora');
        $this->get(new \DateTime('-59 seconds'))->shouldReturn('agora');

        $this->get(new \DateTime('-1 minutes'))->shouldBe('1 minuto atrás');
        $this->get(new \DateTime('-3 minutes'))->shouldBe('3 minutos atrás');
        $this->get(new \DateTime('-25 minutes'))->shouldBe('25 minutos atrás');
        $this->get(new \DateTime('-59 minutes'))->shouldBe('59 minutos atrás');
        $this->get(new \DateTime('-61 minutes'))->shouldBe('1 hora atrás');

        $this->get(new \DateTime('-24 hours'))->shouldBe('1 dia atrás');
        $this->get(new \DateTime('-2 days'))->shouldBe('2 dias atrás');
        $this->get(new \DateTime('-5 days'))->shouldBe('5 dias atrás');

    }

    function it_checks_polish()
    {
        $this->setTextTranslator(new \Smirik\PHPDateTimeAgo\TextTranslator\PolishTextTranslator);

        $this->get(new \DateTime())->shouldBe('teraz');
        $this->get(new \DateTime('-5 seconds'))->shouldReturn('teraz');
        $this->get(new \DateTime('-25 seconds'))->shouldReturn('teraz');
        $this->get(new \DateTime('-59 seconds'))->shouldReturn('teraz');

        $this->get(new \DateTime('-1 minutes'))->shouldBe('1 minutę temu');
        $this->get(new \DateTime('-3 minutes'))->shouldBe('3 minuty temu');
        $this->get(new \DateTime('-25 minutes'))->shouldBe('25 minut temu');
        $this->get(new \DateTime('-59 minutes'))->shouldBe('59 minut temu');
        $this->get(new \DateTime('-61 minutes'))->shouldBe('1 godzinę temu');

        $this->get(new \DateTime('-121 minutes'))->shouldBe('2 godziny temu');

        $this->get(new \DateTime('-24 hours'))->shouldBe('1 dzień temu');
        $this->get(new \DateTime('-2 days'))->shouldBe('2 dni temu');
        $this->get(new \DateTime('-5 days'))->shouldBe('5 dni temu');
        $this->get(new \DateTime('-6 days'))->shouldBe('6 dni temu');

        $this->get(new \DateTime('-7 days'))->shouldBe('1 tydzień temu');
        $this->get(new \DateTime('-18 days'))->shouldBe('2 tygodnie temu');
        $this->get(new \DateTime('-29 days'))->shouldBe('4 tygodnie temu');

        $this->get(new \DateTime('-30 days'))->shouldBe('1 miesiąc temu');
        $this->get(new \DateTime('2015-09-08'), new \DateTime('2015-08-06'))->shouldBe('1 miesiąc temu');
        $this->get(new \DateTime('-80 days'))->shouldBe('2 miesiące temu');
        $this->get(new \DateTime('-364 days'))->shouldBe('11 miesięcy temu');

        $this->get(new \DateTime('-365 days'))->shouldBe('1 rok temu');
        $this->get(new \DateTime('-729 days'))->shouldBe('1 rok temu');
        $this->get(new \DateTime('-730 days'))->shouldBe('2 lata temu');
        $this->get(new \DateTime('-95 years'))->shouldBe('95 lat temu');
    }

    function it_checks_spanish()
    {
        $translator = new \Smirik\PHPDateTimeAgo\TextTranslator\SpanishTextTranslator();
        $translator->enableWeeksMonthsYears(TRUE);
        $this->setTextTranslator($translator);

        $this->get(new \DateTime())->shouldBe('ahora');
        $this->get(new \DateTime('-5 seconds'))->shouldReturn('ahora');
        $this->get(new \DateTime('-25 seconds'))->shouldReturn('ahora');
        $this->get(new \DateTime('-59 seconds'))->shouldReturn('ahora');

        $this->get(new \DateTime('-1 minutes'))->shouldBe('hace 1 minuto');
        $this->get(new \DateTime('-3 minutes'))->shouldBe('hace 3 minutos');
        $this->get(new \DateTime('-25 minutes'))->shouldBe('hace 25 minutos');
        $this->get(new \DateTime('-59 minutes'))->shouldBe('hace 59 minutos');
        $this->get(new \DateTime('-61 minutes'))->shouldBe('hace 1 hora');

        $this->get(new \DateTime('-121 minutes'))->shouldBe('hace 2 horas');

        $this->get(new \DateTime('-24 hours'))->shouldBe('hace 1 día');
        $this->get(new \DateTime('-2 days'))->shouldBe('hace 2 días');
        $this->get(new \DateTime('-5 days'))->shouldBe('hace 5 días');
        $this->get(new \DateTime('-6 days'))->shouldBe('hace 6 días');

        $this->get(new \DateTime('-7 days'))->shouldBe('hace 1 semana');
        $this->get(new \DateTime('-18 days'))->shouldBe('hace 2 semanas');
        $this->get(new \DateTime('-29 days'))->shouldBe('hace 4 semanas');

        $this->get(new \DateTime('-30 days'))->shouldBe('hace 1 mes');
        $this->get(new \DateTime('2015-09-08'), new \DateTime('2015-08-06'))->shouldBe('hace 1 mes');
        $this->get(new \DateTime('-80 days'))->shouldBe('hace 2 meses');
        $this->get(new \DateTime('-364 days'))->shouldBe('hace 11 meses');

        $this->get(new \DateTime('-365 days'))->shouldBe('hace 1 año');
        $this->get(new \DateTime('-729 days'))->shouldBe('hace 1 año');
        $this->get(new \DateTime('-730 days'))->shouldBe('hace 2 años');
        $this->get(new \DateTime('-95 years'))->shouldBe('hace 95 años');
    }

}
