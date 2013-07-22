<?php
    
namespace Smirik\PHPDateTimeAgo\TextTranslator;

class RussianTextTranslator  extends AbstractTextTranslator
{
    
    protected $minute_words = array('минуту назад', 'минуты назад', 'минут назад');
    protected $hour_words   = array('час назад', 'часа назад', 'часов назад');
    protected $day_words    = array('день назад', 'дня назад', 'дней назад');
    
    /**
     * {@inheritdoc}
     */
    public function now()
    {
        return 'сейчас';
    }
    
    /**
     * {@inheritdoc}
     */
    protected function pluralization($number)
    {
        return (($number % 10 == 1) && ($number % 100 != 11)) ? 0 : ((($number % 10 >= 2) && ($number % 10 <= 4) && (($number % 100 < 10) || ($number % 100 >= 20))) ? 1 : 2);
    }
    
    
}
