<?php

namespace Smirik\PHPDateTimeAgo\TextTranslator;

class PolishTextTranslator  extends AbstractTextTranslator
{
    protected $minute_words = array('minutę temu', 'minuty temu', 'minut temu');
    protected $hour_words   = array('godzinę temu', 'godziny temu', 'godzin temu');
    protected $day_words    = array('dzień temu', 'dni temu', 'dni temu');
    protected $week_words    = array('tydzień temu', 'tygodnie temu', 'tygodni temu');
    protected $month_words    = array('miesiąc temu', 'miesiące temu', 'miesięcy temu');
    protected $year_words    = array('rok temu', 'lata temu', 'lat temu');

    /**
     * {@inheritdoc}
     */
    public function supportsWeeks()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsMonths()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsYears()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function now()
    {
        return 'teraz';
    }

    /**
     * {@inheritdoc}
     */
    protected function pluralization($number)
    {
        if ($number === 1) //for 1
        {
            return 0;
        }

        if ($number % 10 === 0) //for 10, 20, 30...
        {
            return 2;
        }

        if ($number % 10 === 1) //for 11, 21, 31, 141....
        {
            return 2;
        }

        if ($number > 10 && $number < 21) //for 10-20
        {
            return 2;
        }

        if ($number % 10 < 5) //for x1..x4
        {
            return 1;
        }

        return 2;
    }
}
