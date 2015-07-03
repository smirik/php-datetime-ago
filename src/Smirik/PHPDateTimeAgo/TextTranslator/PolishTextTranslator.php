<?php

namespace Smirik\PHPDateTimeAgo\TextTranslator;

class PolishTextTranslator  extends AbstractTextTranslator
{
    protected $minute_words = array('minutę temu', 'minuty temu', 'minut temu');
    protected $hour_words   = array('godzinę temu', 'godziny temu', 'godzin temu');
    protected $day_words    = array('dzień temu', 'dni temu', 'dni temu');

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
        if ($number === 1)
        {
            return 0;
        }

        if ($number % 10 === 0)
        {
            return 2;
        }

        if ($number % 10 === 1)
        {
            return 2;
        }

        if ($number % 10 < 5)
        {
            return 1;
        }

        return 2;
    }


}
