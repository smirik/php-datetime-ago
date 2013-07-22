<?php

namespace Smirik\PHPDateTimeAgo\TextTranslator;    

interface TextTranslatorInterface 
{
    
    /**
     * Returns formatted "now" value
     * @return string
     */
    
    function now();

    /**
     * Returns formatted hours value
     * @param integer $minutes
     * @return string
     */
    function minutes($minutes);

    /**
     * Returns formatted hours value
     * @param integer $hours
     * @return string
     */
    function hours($hours);
    
    /**
     * Returns formatted days value
     * @param integer $days
     * @return string
     */
    function days($days);
    
}