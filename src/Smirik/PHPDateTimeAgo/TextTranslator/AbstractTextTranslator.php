<?php
    
namespace Smirik\PHPDateTimeAgo\TextTranslator;

abstract class AbstractTextTranslator implements TextTranslatorInterface
{
    
    /**
     * Returns minutes with correct pluralization based on minute_words property & pluralization method
     * @param integer $minutes
     * @return string
     */
    public function minutes($minutes)
    {
        return $minutes.' '.$this->minute_words[$this->pluralization($minutes)];
    }

    /**
     * Returns hours with correct pluralization based on hour_words property & pluralization method
     * @param integer $hours
     * @return string
     */
    public function hours($hours)
    {
        return $hours.' '.$this->hour_words[$this->pluralization($hours)];
    }

    /**
     * Returns days with correct pluralization based on day_words property & pluralization method
     * @param integer $days
     * @return string
     */
    public function days($days)
    {
        return $days.' '.$this->day_words[$this->pluralization($days)];
    }
    
    /**
     * Pluralize the number according to the language. Returns key in related array (minute_words, hour_words, day_words)
     * @param integer $number
     * @return integer
     */
    abstract protected function pluralization($number);
    
}
