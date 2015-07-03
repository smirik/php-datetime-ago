<?php
use Smirik\PHPDateTimeAgo\DateTimeAgo;
use Smirik\PHPDateTimeAgo\TextTranslator\PolishTextTranslator;

class PolishTextTranslatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider textFormattingData
     */
    public function testTextFormatting($format, $expected)
    {
        $ago = new DateTimeAgo(new PolishTextTranslator);
        $formattedText = $ago->getText(new \DateInterval($format), new \DateTime());
        $this->assertEquals($expected, $formattedText);
    }

    public function textFormattingData()
    {
        return [
            ['PT1M', '1 minutę temu'],
            ['PT2M', '2 minuty temu'],
            ['PT3M', '3 minuty temu'],
            ['PT4M', '4 minuty temu'],
            ['PT5M', '5 minut temu'],
            ['PT10M', '10 minut temu'],

            ['PT20M', '20 minut temu'],
            ['PT21M', '21 minut temu'],
            ['PT22M', '22 minuty temu'],

            ['PT120M', '120 minut temu'],
            ['PT121M', '121 minut temu'],
            ['PT122M', '122 minuty temu'],
            ['PT123M', '123 minuty temu'],
            ['PT124M', '124 minuty temu'],
            ['PT125M', '125 minut temu'],
            ['PT126M', '126 minut temu'],
            ['PT127M', '127 minut temu'],
            ['PT128M', '128 minut temu'],
            ['PT129M', '129 minut temu'],
            ['PT130M', '130 minut temu'],

            ['P1D', '1 dzień temu'],
            ['P2D', '2 dni temu'],
            ['P3D', '3 dni temu'],
            ['P4D', '4 dni temu'],
            ['P5D', '5 dni temu'],

            ['PT1H', '1 godzinę temu'],
            ['PT2H', '2 godziny temu'],
            ['PT5H', '5 godzin temu']
        ];
    }
}