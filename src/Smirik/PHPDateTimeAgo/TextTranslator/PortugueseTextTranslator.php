<?php
    
namespace Smirik\PHPDateTimeAgo\TextTranslator;

class PortugueseTextTranslator extends AbstractTextTranslator
{
    
    protected $minute_words = array('minuto atrás', 'minutos atrás');
    protected $hour_words   = array('hora atrás', 'horas atrás');
    protected $day_words    = array('dia atrás', 'dias atrás');
    
    /**
     * {@inheritdoc}
     */
    public function now()
    {
        return 'agora';
    }
    
    /**
     * {@inheritdoc}
     */
    public function pluralization($number)
    {
        return ($number == 1) ? 0 : 1;
    }
    
}