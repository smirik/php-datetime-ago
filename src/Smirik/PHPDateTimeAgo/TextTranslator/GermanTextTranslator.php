<?php

namespace Smirik\PHPDateTimeAgo\TextTranslator;

class GermanTextTranslator implements TextTranslatorInterface
{
    protected $pre_word = 'vor';
    protected $one_words = array('einer', 'einem'); //0 for minutes and hours, 1 for days
    protected $minute_words = array('Minute', 'Minuten');
    protected $hour_words = array('Stunde', 'Stunden');
    protected $day_words = array('Tag', 'Tagen');

    /**
     * Gets used by minutes(), hours() and days(), does the actual formatting work.
     */
    protected function format($number, $oneWord, $typeWords)
    {
        $typeWord = $typeWords[$this->pluralization($number)];
        if ($number === 1) {
            $number = $oneWord;
        }
        return $this->pre_word . ' ' . $number . ' ' . $typeWord;
    }

    /**
     * {@inheritdoc}
     */
    public function now()
    {
        return 'jetzt';
    }

    /**
     * {@inheritdoc}
     */
    public function minutes($minutes)
    {
        return $this->format($minutes, $this->one_words[0], $this->minute_words);
    }

    /**
     * {@inheritdoc}
     */
    public function hours($hours)
    {
        return $this->format($hours, $this->one_words[0], $this->hour_words);
    }

    /**
     * {@inheritdoc}
     */
    public function days($days)
    {
        return $this->format($days, $this->one_words[1], $this->day_words);
    }

    /**
     * Pluralize the number. Returns key in related array (minute_words, hour_words, day_words)
     * @param integer $number
     * @return integer
     */
    public function pluralization($number)
    {
        return $number === 1 ? 0 : 1;
    }
}
