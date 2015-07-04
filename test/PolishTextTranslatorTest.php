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

            ['PT11M', '11 minut temu'],
            ['PT12M', '12 minut temu'],
            ['PT13M', '13 minut temu'],
            ['PT14M', '14 minut temu'],
            ['PT15M', '15 minut temu'],
            ['PT16M', '16 minut temu'],
            ['PT17M', '17 minut temu'],
            ['PT18M', '18 minut temu'],
            ['PT19M', '19 minut temu'],

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
            ['PT5H', '5 godzin temu'],


            ['P7D', '1 tydzień temu'],
            ['P8D', '1 tydzień temu'],
            ['P9D', '1 tydzień temu'],
            ['P10D', '1 tydzień temu'],

            ['P11D', '2 tygodnie temu'],
            ['P12D', '2 tygodnie temu'],
            ['P13D', '2 tygodnie temu'],
            ['P14D', '2 tygodnie temu'],
            ['P15D', '2 tygodnie temu'],
            ['P16D', '2 tygodnie temu'],
            ['P17D', '2 tygodnie temu'],

            ['P18D', '3 tygodnie temu'],
            ['P19D', '3 tygodnie temu'],
            ['P20D', '3 tygodnie temu'],
            ['P21D', '3 tygodnie temu'],
            ['P22D', '3 tygodnie temu'],
            ['P22D', '3 tygodnie temu'],
            ['P23D', '3 tygodnie temu'],
            ['P24D', '3 tygodnie temu'],

            ['P25D', '1 miesiąc temu'],
            ['P35D', '1 miesiąc temu'],
            ['P45D', '2 miesiące temu'],
            ['P55D', '2 miesiące temu'],
            ['P65D', '2 miesiące temu'],
            ['P75D', '3 miesiące temu'],
            ['P85D', '3 miesiące temu'],
            ['P95D', '3 miesiące temu'],
            ['P105D', '4 miesiące temu'],
            ['P155D', '5 miesięcy temu'],

            ['P360D', '1 rok temu'],
            ['P400D', '1 rok temu'],
            ['P500D', '1 rok temu'],
            ['P600D', '2 lata temu'],
            ['P600D', '2 lata temu'],
            ['P1800D', '5 lat temu'],


        ];
    }
}