<?php

/**
 * File containing a test class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */
namespace eZ\Publish\Core\REST\Server\Tests\Input\Parser;

use eZ\Publish\API\Repository\Values\User\Limitation\SectionLimitation;
use eZ\Publish\Core\REST\Server\Input\Parser\Limitation\SectionLimitation as Parser;

class SectionInputTest extends BaseTest
{
    /**
     * Tests the SectionInput parser.
     */
    public function testParse()
    {
        $inputArray = array(
            '_identifier' => 'Section',
            'values' => [
                'ref' => [
                    [
                        '_href' => '/content/section/2',
                        '_media-type' => "application/vnd.ez.api.Section+json",
                    ],
                ],
            ],
        );

        $this->getRequestParserMock()
            ->expects($this->once())
            ->method('parseHref')
            ->with('/content/section/2', 'sectionId')
            ->will($this->returnValue(2));

        $result = $this->getParser()->parse($inputArray, $this->getParsingDispatcherMock());

        $this->assertEquals(
            new SectionLimitation(['limitationValues' => [2]]),
            $result,
            'SectionLimitation not created correctly.'
        );
    }

    public function getParseHrefExpectationsMap()
    {
        return [
            ['/content/section/2', 'sectionId', 2]
        ];
    }


    /**
     * Returns the section input parser.
     *
     * @return \eZ\Publish\Core\REST\Server\Input\Parser\SectionInput
     */
    protected function internalGetParser()
    {
        return new Parser($this->getSectionServiceMock());
    }

    /**
     * Get the section service mock object.
     *
     * @return \eZ\Publish\API\Repository\SectionService
     */
    protected function getSectionServiceMock()
    {
        $sectionServiceMock = $this->getMock(
            'eZ\\Publish\\Core\\Repository\\SectionService',
            array(),
            array(),
            '',
            false
        );

        $sectionServiceMock->expects($this->any())
            ->method('newSectionCreateStruct')
            ->will(
                $this->returnValue(new SectionCreateStruct())
            );

        return $sectionServiceMock;
    }
}
