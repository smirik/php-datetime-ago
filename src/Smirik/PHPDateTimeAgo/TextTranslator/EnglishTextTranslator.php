<?php
    
namespace Smirik\PHPDateTimeAgo\TextTranslator;

class EnglishTextTranslator extends AbstractTextTranslator
{
    
    protected $minute_words = array('minute ago', 'minutes ago');
    protected $hour_words   = array('hour ago', 'hours ago');
    protected $day_words    = array('day ago', 'days ago');
    protected $week_words   = array('week ago', 'weeks ago');
    protected $month_words  = array('month ago', 'months ago');
    protected $year_words   = array('year ago', 'years ago');

    protected $weeks_months_years = FALSE;

    /**
     * Toggle whether to render weeks/months/years or fall back to date format for longer periods.
     *
     * @param bool $enable
     */
    public function enableWeeksMonthsYears($enable)
    {
        $this->weeks_months_years = $enable;
    }

    /**
     * {@inheritdoc}
     */
    public function now()
    {
        return 'now';
    }
    
    /**
     * {@inheritdoc}
     */
    public function pluralization($number)
    {
        return ($number == 1) ? 0 : 1;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsWeeks()
    {
        return $this->weeks_months_years;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsMonths()
    {
        return $this->weeks_months_years;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsYears()
    {
        return $this->weeks_months_years;
    }

}
