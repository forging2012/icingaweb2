<?php
/* Icinga Web 2 | (c) 2016 Icinga Development Team | GPLv2+ */

namespace Tests\Icinga\Module\Translation\Catalog;


use Icinga\Module\Translation\Exceptions\CatalogParserException;
use Icinga\Module\Translation\Catalog\CatalogParser;
use Icinga\Test\BaseTestCase;

class CatalogParserTest extends BaseTestCase
{
    protected $tmpFilePath;

    public function setUp()
    {
        $this->tmpFilePath = tempnam(sys_get_temp_dir(), 'CatalogParserTest_TestFile');
    }

    public function tearDown()
    {
        unlink($this->tmpFilePath);
    }

    protected function parseString($string)
    {
        file_put_contents($this->tmpFilePath, $string);
        return CatalogParser::parsePath($this->tmpFilePath);
    }

    public function testWhetherAMessageContextIsParsedCorrectly()
    {
        $parserResult = $this->parseString('msgctxt "context of the message"');

        $this->assertEquals(
            'context of the message',
            $parserResult[0]['msgctxt'],
            'CatalogParser does not parse a msgctxt correctly'
        );
    }

    public function testWhetherAnObsoleteMessageContextIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#~ msgctxt "context of the message"');

        $this->assertEquals(
            'context of the message',
            $parserResult[0]['msgctxt'],
            'CatalogParser does not parse a obsolete msgctxt correctly'
        );
    }

    public function testWhetherAPreviousMessageContextIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#| msgctxt "previous context of the message"');

        $this->assertEquals(
            'previous context of the message',
            $parserResult[0]['previous_msgctxt'],
            'CatalogParser does not parse a previous msgctxt correctly'
        );
    }

    public function testWhetherAMessageIdIsParsedCorrectly()
    {
        $parserResult = $this->parseString('msgid "this is a msgid"');

        $this->assertEquals(
            'this is a msgid',
            $parserResult[0]['msgid'],
            'CatalogParser does not parse a msgid correctly'
        );
    }

    public function testWhetherAnObsoleteMessageIdIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#~ msgid "this is a msgid"');

        $this->assertEquals(
            'this is a msgid',
            $parserResult[0]['msgid'],
            'CatalogParser does not parse a obsolete msgid correctly'
        );
    }

    public function testWhetherAPreviousMessageIdIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#| msgid "fuzzy id of the message"');

        $this->assertEquals(
            'fuzzy id of the message',
            $parserResult[0]['previous_msgid'],
            'CatalogParser does not parse a previous msgid correctly'
        );
    }

    public function testWhetherAMessageStringIsParsedCorrectly()
    {
        $parserResult = $this->parseString('msgstr "translation"');

        $this->assertEquals(
            'translation',
            $parserResult[0]['msgstr'][0],
            'CatalogParser does not parse a msgstr correctly'
        );
    }

    public function testWhetherAnObsoleteMessageStringIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#~ msgstr "translation"');

        $this->assertEquals(
            'translation',
            $parserResult[0]['msgstr'][0],
            'CatalogParser does not parse a obsolete msgstr correctly'
        );
    }

    public function testWhetherAPluralMessageIdIsParsedCorrectly()
    {
        $parserResult = $this->parseString('msgid_plural "id_plural"');

        $this->assertEquals(
            'id_plural',
            $parserResult[0]['msgid_plural'],
            'CatalogParser does not parse a msgid_plural correctly'
        );
    }

    public function testWhetherAnObsoletePluralMessageIdIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#~ msgid_plural "id_plural"');

        $this->assertEquals(
            'id_plural',
            $parserResult[0]['msgid_plural'],
            'CatalogParser does not parse a obsolete msgid_plural correctly'
        );
    }

    public function testWhetherAPreviousPluralMessageIdIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#| msgid_plural "id_plural"');

        $this->assertEquals(
            'id_plural',
            $parserResult[0]['previous_msgid_plural'],
            'CatalogParser does not parse a previous msgid_plural correctly'
        );
    }

    public function testWhetherAPluralMessageStringIsParsedCorrectly()
    {
        $parserResult = $this->parseString(<<<EOF
msgstr[0] "translation0"
msgstr[1] "translation1"
EOF
);

        $this->assertEquals(
            'translation0',
            $parserResult[0]['msgstr'][0],
            'CatalogParser does not parse a msgstr[0] correctly'
        );
        $this->assertEquals(
            'translation1',
            $parserResult[0]['msgstr'][1],
            'CatalogParser does not parse a msgstr[1] correctly'
        );
    }

    public function testWhetherAnObsoletePluralMessageStringIsParsedCorrectly()
    {
        $parserResult = $this->parseString(<<<EOF
#~ msgstr[0] "translation0"
#~ msgstr[1] "translation1"
EOF
);

        $this->assertEquals(
            'translation0',
            $parserResult[0]['msgstr'][0],
            'CatalogParser does not parse a obsolete msgstr[0] correctly'
        );
        $this->assertEquals(
            'translation1',
            $parserResult[0]['msgstr'][1],
            'CatalogParser does not parse a obsolete msgstr[1] correctly'
        );
    }

    public function testWhetherAnObsoleteEntryIsCorrectlyIdentified()
    {
        $parserResult = $this->parseString('#~ msgid "translation"');

        $this->assertTrue(
            $parserResult[0]['obsolete'],
            'CatalogParser does not identify obsolete entries correctly'
        );
    }

    public function testWhetherATranslatorCommentIsParsedCorrectly()
    {
        $parserResult = $this->parseString('# this is a translator comment');

        $this->assertEquals(
            'this is a translator comment',
            $parserResult[0]['translator_comments'][0],
            'CatalogParser does not parse a translator comment correctly'
        );
    }

    public function testWhetherAExtractedCommentIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#. this is a extracted comment');

        $this->assertEquals(
            'this is a extracted comment',
            $parserResult[0]['extracted_comments'][0],
            'CatalogParser does not parse a extracted comment correctly'
        );
    }

    public function testWhetherASinglePathIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#: /this/is/a/test/path:999');

        $this->assertEquals(
            '/this/is/a/test/path:999',
            $parserResult[0]['paths'][0],
            'CatalogParser does not parse paths correctly'
        );
    }

    public function testWhetherMultiplePathsAreParsedCorrectly()
    {
        $parserResult = $this->parseString(<<<EOF
#: /this/is/a/test/path:999 /this/is/another/test/path:99
#: /this/is/still/another/test/path:9
EOF
);

        $this->assertEquals(
            '/this/is/a/test/path:999',
            $parserResult[0]['paths'][0],
            'CatalogParser does not parse paths correctly'
        );
        $this->assertEquals(
            '/this/is/another/test/path:99',
            $parserResult[0]['paths'][1],
            'CatalogParser does not parse paths correctly'
        );
        $this->assertEquals(
            '/this/is/still/another/test/path:9',
            $parserResult[0]['paths'][2],
            'CatalogParser does not parse paths correctly'
        );
    }

    public function testWhetherASingleFlagIsParsedCorrectly()
    {
        $parserResult = $this->parseString('#, this-is-a-flag');

        $this->assertEquals(
            'this-is-a-flag',
            $parserResult[0]['flags'][0],
            'CatalogParser does not parse flags correctly'
        );
    }

    public function testWhetherMultipleFlagsAreParsedCorrectly()
    {
        $parserResult = $this->parseString(<<<EOF
#, this-is-a-flag, this-is-another-flag
#, this-is-still-another-flag
EOF
        );

        $this->assertEquals(
            'this-is-a-flag',
            $parserResult[0]['flags'][0],
            'CatalogParser does not parse flags correctly'
        );
        $this->assertEquals(
            'this-is-another-flag',
            $parserResult[0]['flags'][1],
            'CatalogParser does not parse flags correctly'
        );
        $this->assertEquals(
            'this-is-still-another-flag',
            $parserResult[0]['flags'][2],
            'CatalogParser does not parse flags correctly'
        );
    }

    /**
     * @depends testWhetherAExtractedCommentIsParsedCorrectly
     * @depends testWhetherAMessageIdIsParsedCorrectly
     * @depends testWhetherAMessageContextIsParsedCorrectly
     * @depends testWhetherAMessageStringIsParsedCorrectly
     * @depends testWhetherAPluralMessageStringIsParsedCorrectly
     */
    public function testWhetherEscapedCharactersAreProperlyResolved()
    {
        $parserResult = $this->parseString(<<<EOT
#. one line\\nanother line
msgid "a\\nb"
msgctxt "a\\r\\nb"
msgstr "a\\\\\\tb"
msgstr[1] "a\\""
EOT
);

        $this->assertEquals(
            "one line\nanother line",
            $parserResult[0]['extracted_comments'][0],
            'CatalogParser does not properly resolve escaped characters in extracted comments'
        );
        $this->assertEquals(
            "a\nb",
            $parserResult[0]['msgid'],
            'CatalogParser does not properly resolve escaped characters in message ids'
        );
        $this->assertEquals(
            "a\r\nb",
            $parserResult[0]['msgctxt'],
            'CatalogParser does not properly resolve escaped characters in message contexts'
        );
        $this->assertEquals(
            "a\\\\\tb",
            $parserResult[0]['msgstr'][0],
            'CatalogParser does not properly resolve escaped characters in message strings'
        );
        $this->assertEquals(
            'a"',
            $parserResult[0]['msgstr'][1],
            'CatalogParser does not properly resolve escaped characters in plural message strings'
        );
    }

    public function testWhetherMissingKeywordsCauseAnError()
    {
        try {
            $this->parseString('    "string with type missing in front"');
        } catch (CatalogParserException $e) {
            $this->assertEquals(5, $e->getPosition(), 'CatalogParser reports incorrect error positions');
            return;
        }

        $this->fail('CatalogParser does not throw an exception if keyword is missing');
    }

    public function testWhetherInvalidKeywordsCauseAnError()
    {
        try {
            $this->parseString('wrongkeyword "string with invalid type in front"');
        } catch (CatalogParserException $e) {
            $this->assertEquals(1, $e->getPosition(), 'CatalogParser reports incorrect error positions');
            return;
        }

        $this->fail('CatalogParser does not throw an exception if given keyword is wrong');
    }

    public function testWhetherInvalidEmbeddedKeywordsCauseAnError()
    {
        try {
            $this->parseString('#| wrongkeyword "string with type missing in front"');
        } catch (CatalogParserException $e) {
            $this->assertEquals(4, $e->getPosition(), 'CatalogParser reports incorrect error positions');
            return;
        }

        $this->fail('CatalogParser does not throw an exception if given previous keyword is wrong');
    }

    public function testWhetherSuperfluousQuotesCauseAnError()
    {
        try {
            $this->parseString('#| msgid    "string with a superfluous " in it"');
        } catch (CatalogParserException $e) {
            $this->assertEquals(42, $e->getPosition(), 'CatalogParser reports incorrect error positions');
            return;
        }

        $this->fail('CatalogParser does not throw an exception if superfluous quotes exist');
    }

    public function testWhetherMissingClosingQuotesCauseAnError()
    {
        try {
            $this->parseString('msgstr      "string with missing closing quote');
        } catch (CatalogParserException $e) {
            $this->assertEquals(47, $e->getPosition(), 'CatalogParser reports incorrect error positions');
            return;
        }

        $this->fail('CatalogParser does not throw an exception if closing quote is missing');
    }

    public function testWhetherMissingSpacesAfterAValidKeywordCauseAnError()
    {
        try {
            $this->parseString('msgstr');
        } catch (CatalogParserException $e) {
            $this->assertEquals(7, $e->getPosition(), 'CatalogParser reports incorrect error positions');
            return;
        }

        $this->fail('CatalogParser does not throw an exception if space is missing after keyword');
    }

    public function testWhetherInvalidHashIdentifiersCauseAnError()
    {
        try {
            $this->parseString('#a');
        } catch (CatalogParserException $e) {
            $this->assertEquals(2, $e->getPosition(), 'CatalogParser reports incorrect error positions');
            return;
        }

        $this->fail('CatalogParser does not throw an exception if char after hash is wrong');
    }
}