<?php
    
namespace Smirik\PHPDateTimeAgo\TextTranslator;

abstract class AbstractTextTranslator implements TextTranslatorInterface
{
    private $formatPattern = "%d %s";

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
     * Returns "weeks ago" like string
     * @param integer $weeks
     * @return string
     */
    public function weeks($weeks)
    {
        return sprintf($this->formatPattern, $weeks, $this->week_words[$this->pluralization($weeks)]);
    }

    /**
     * Returns "months ago" like string
     * @param integer $months
     * @return string
     */
    public function months($months)
    {
        return sprintf($this->formatPattern, $months, $this->month_words[$this->pluralization($months)]);
    }

    /**
     * Returns "years ago" like string
     * @param integer $years
     * @return string
     */
    public function years($years)
    {
        return sprintf($this->formatPattern, $years, $this->year_words[$this->pluralization($years)]);
    }
    
    /**
     * Pluralize the number according to the language. Returns key in related array (minute_words, hour_words, day_words)
     * @param integer $number
     * @return integer
     */
    abstract protected function pluralization($number);

    /**
     * Does the translator support weeks
     *
     * @return bool
     */
    public function supportsWeeks()
    {
        return false;
    }

    /**
     * Does the translator support months
     *
     * @return bool
     */
    public function supportsMonths()
    {
        return false;
    }

    /**
     * Does the translator support years
     *
     * @return bool
     */
    public function supportsYears()
    {
        return false;
    }
    
}
