<?php
    
namespace Smirik\PHPDateTimeAgo\TextTranslator;

class EnglishTextTranslator extends AbstractTextTranslator
{
    
    protected $minute_words = array('minute ago', 'minutes ago');
    protected $hour_words   = array('hour ago', 'hours ago');
    protected $day_words    = array('day ago', 'days ago');
    
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
    
}