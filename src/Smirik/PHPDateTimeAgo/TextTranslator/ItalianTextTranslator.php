<?php

namespace Smirik\PHPDateTimeAgo\TextTranslator;

class ItalianTextTranslator extends AbstractTextTranslator
{

    protected $minute_words = array('minuto fa', 'minuti fa');
    protected $hour_words   = array('ora fa', 'ore fa');
    protected $day_words    = array('giorno fa', 'giorni fa');

    /**
     * {@inheritdoc}
     */
    public function now()
    {
        return 'ora';
    }

    /**
     * {@inheritdoc}
     */
    public function pluralization($number)
    {
        return ($number == 1) ? 0 : 1;
    }

}
