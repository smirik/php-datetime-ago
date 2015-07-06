<?php

namespace Smirik\PHPDateTimeAgo;

use DateInterval;
use DateTime;
use Smirik\PHPDateTimeAgo\TextTranslator\EnglishTextTranslator;
use Smirik\PHPDateTimeAgo\TextTranslator\TextTranslatorInterface;


class DateTimeAgo
{
    /**
     * @var TextTransformerInterface $text_translator
     */
    protected $text_translator;
    
    /**
     * @var integer $max_days_count
     */
    protected $max_days_count = 6;
    
    /**
     * @var string $format
     */
    protected $format = 'Y-m-d';
    
    public function __construct(TextTranslatorInterface $text_translator = null)
    {
        if (is_null($text_translator)) {
            $text_translator = new EnglishTextTranslator();
        }
        
        $this->text_translator = $text_translator;
    }
    
    /**
     * Get string representation of the date with given translator
     * @param DateTime $date
     * @param DateTime|null $reference_date
     * @return string
     */
    public function get(DateTime $date, DateTime $reference_date = null )
    {
        if (is_null($reference_date)) {
            $reference_date = new DateTime();
        }
        
        $diff = $reference_date->diff($date);
        return $this->getText($diff, $date);
    }
    
    /**
     * Get string related to DateInterval object
     * @param DateInterval $diff
     * @return string
     */
    public function getText(DateInterval $diff, $date)
    {
        if ($this->now($diff)) {
            return $this->text_translator->now();
        }
        
        if ($this->minutes($diff)) {
            return $this->text_translator->minutes($this->minutes($diff));
        }
        
        if ($this->hours($diff)) {
            return $this->text_translator->hours($this->hours($diff));
        }
        
        if ($this->days($diff)) {
            return $this->text_translator->days($this->days($diff));
        }

        if ($this->text_translator->supportsWeeks() && $this->weeks($diff)) {
            return $this->text_translator->weeks($this->weeks($diff));
        }

        if ($this->text_translator->supportsMonths() && $this->months($diff)) {
            return $this->text_translator->months($this->months($diff));
        }

        if ($this->text_translator->supportsYears() && $this->years($diff)) {
            return $this->text_translator->years($this->years($diff));
        }
        
        return $date->format($this->format);
    }
    
    /**
     * Is date limit by day
     * @param DateInterval $diff
     * @return bool
     */
    public function daily($diff)
    {
        if (($diff->y == 0) && ($diff->m == 0) && (($diff->d == 0) || (($diff->d == 1) && ($diff->h == 0) && ($diff->i == 0)))) {
            return true;
        }
        return false;
    }
    
    /**
     * Is date limit by hour
     * @param DateInterval $diff
     * @return bool
     */
    public function hourly($diff)
    {
        if ($this->daily($diff) && ($diff->d == 0) && (($diff->h == 0) || (($diff->h == 1) && ($diff->i == 0)))) {
            return true;
        }
        return false;
    }
    
    /**
     * @param DateInterval $diff
     * @return bool
     */
    public function now(DateInterval $diff)
    {
        if ($this->hourly($diff) && ($diff->h == 0) && ($diff->i == 0) && ($diff->s <= 59)) {
            return true;
        }
        return false;
    }
    
    /**
     * Number of minutes related to the interval or false if more.
     * @param DateInterval $diff
     * @return integer|false
     */
    public function minutes(DateInterval $diff)
    {
        if ($this->hourly($diff)) {
            return $diff->i;
        }
        return false;
    }
    
    /**
     * Number of hours related to the interval or false if more.
     * @param DateInterval $diff
     * @return integer|false
     */
    public function hours(DateInterval $diff)
    {
        if ($this->daily($diff)) {
            return $diff->h;
        }
        return false;
    }

    /**
     * Number of days related to the interval or false if more.
     * @param DateInterval $diff
     * @return integer|false
     */
    public function days(DateInterval $diff)
    {
        if ($diff->d <= $this->max_days_count) {
            return $diff->d;
        }
        return false;
    }

    /**
     * Get Number of weeks
     * @param DateInterval $diff
     * @return integer|false
     */
    public function weeks(DateInterval $diff)
    {
        $x = (int) round($diff->d / 7, 0);
        if ($x < 4) {
            return $x;
        }
        return false;
    }

    /**
     * Get Number of months
     * @param DateInterval $diff
     * @return integer|false
     */
    public function months(DateInterval $diff)
    {
        $x = (int) round($diff->d / 30, 0);
        if ($x < 12) {
            return $x;
        }
        return false;
    }

    /**
     * Get Number of years
     * @param DateInterval $diff
     * @return integer|false
     */
    public function years(DateInterval $diff)
    {
        return (int) round($diff->d / 365, 0);
    }
    
    /**
     * Setters
     */

    /**
     * @param TextTranslatorInterface $text_translator
     */
    public function setTextTranslator(TextTranslatorInterface $text_translator)
    {
        $this->text_translator = $text_translator;
    }

    /**
     * @param integer $max_days_count
     */
    public function setMaxDaysCount($max_days_count)
    {
        $this->max_days_count = $max_days_count;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }
    
}