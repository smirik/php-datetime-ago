<?php
    
namespace Smirik\PHPDateTimeAgo\TextTranslator;

class GermanTextTranslator extends AbstractTextTranslator
{
    
    protected $minute_words = array('Minute', 'Minuten');
    protected $hour_words   = array('Stunde', 'Stunden');
    protected $day_words    = array('Tag', 'Tagen');
    
    protected $pre_word = 'vor';
    
    /**
     * {@inheritdoc}
     */
    public function now()
    {
        return 'jetzt';
    }
    
    /**
     * Returns minutes with correct pluralization based on minute_words property & pluralization method
     * @param integer $minutes
     * @return string
     */
    public function minutes($minutes)
    {
        return $this->pre_word.' '.parent::minutes( $minutes );
    }

    /**
     * Returns hours with correct pluralization based on hour_words property & pluralization method
     * @param integer $hours
     * @return string
     */
    public function hours($hours)
    {
        return $this->pre_word.' '.parent::hours( $hours );
    }

    /**
     * Returns days with correct pluralization based on day_words property & pluralization method
     * @param integer $days
     * @return string
     */
    public function days($days)
    {
        return $this->pre_word.' '.parent::days( $days );
    }

    /**
     * {@inheritdoc}
     */
    public function pluralization($number)
    {
        return ($number == 1) ? 0 : 1;
    }
    
}