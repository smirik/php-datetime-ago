<?php

namespace Smirik\PHPDateTimeAgo\TextTranslator;

class SpanishTextTranslator extends AbstractTextTranslator {

    protected $pre_word = 'hace';
    protected $minute_words = array('minuto', 'minutos');
    protected $hour_words   = array('hora', 'horas');
    protected $day_words    = array('día', 'días');
    protected $week_words   = array('semana', 'semanas');
    protected $month_words  = array('mes', 'meses');
    protected $year_words   = array('año', 'años');

    protected $weeks_months_years = FALSE;



    /**
     * {@inheritdoc}
     */
    function now()
    {
        return "ahora";
    }

    /**
     * Gets used by minutes(), hours(), days(), weeks(), months() and years(), does the actual
     * formatting work.
     * @param $number
     * @param $typeWords
     * @return string
     */
    protected function format($number, $typeWords)
    {
        $typeWord = $typeWords[$this->pluralization($number)];

        return $this->pre_word . ' ' . $number . ' ' . $typeWord;
    }

    /**
     * {@inheritdoc}
     */
    public function minutes($minutes)
    {
        return $this->format($minutes, $this->minute_words);
    }

    /**
     * {@inheritdoc}
     */
    public function hours($hours)
    {
        return $this->format($hours, $this->hour_words);
    }

    /**
     * {@inheritdoc}
     */
    public function days($days)
    {
        return $this->format($days, $this->day_words);
    }

    /**
     * {@inheritdoc}
     */
    public function weeks($days)
    {
        return $this->format($days, $this->week_words);
    }

    /**
     * {@inheritdoc}
     */
    public function months($days)
    {
        return $this->format($days, $this->month_words);
    }

    /**
     * {@inheritdoc}
     */
    public function years($days)
    {
        return $this->format($days, $this->year_words);
    }

    /**
     * Pluralize the number. Returns key in related array (minute_words, hour_words, day_words)
     * @param integer $number
     * @return integer
     */
    protected function pluralization($number)
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

    /**
     * Toggle whether to render weeks/months/years or fall back to date format for longer periods.
     *
     * @param bool $enable
     */
    public function enableWeeksMonthsYears($enable)
    {
        $this->weeks_months_years = $enable;
    }

}