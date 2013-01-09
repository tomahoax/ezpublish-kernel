<?php
/**
 * File contains: eZ\Publish\Core\Persistence\Cache\Tests\PersistenceHandlerTest class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\Core\Persistence\Cache\Tests;

use eZ\Publish\Core\Persistence\InMemory\Handler as InMemoryHandler;

/**
 * Test case for Persistence\Cache\Handler
 */
class PersistenceHandlerTest extends HandlerTest
{
    /**
     * Setup the PersistenceHandlerTest.
     */
    protected function setUp()
    {
        parent::setUp( array( 'getPersistenceHandler' ) );

        $this->persistenceFactoryMock
            ->expects( $this->any() )
            ->method( 'getPersistenceHandler' )
            ->will( $this->returnValue( new InMemoryHandler() ) );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::__construct
     */
    public function testHandler()
    {
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Handler', $this->persistenceHandler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\Cache\\Handler', $this->persistenceHandler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::contentHandler
     */
    public function testContentHandler()
    {
        $handler = $this->persistenceHandler->contentHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\ContentHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::searchHandler
     */
    public function testSearchHandler()
    {
        $handler = $this->persistenceHandler->searchHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\Search\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\SearchHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::contentLanguageHandler
     */
    public function testLanguageHandler()
    {
        $handler = $this->persistenceHandler->contentLanguageHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\Language\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\LanguageHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::contentTypeHandler
     */
    public function testContentTypeHandler()
    {
        $handler = $this->persistenceHandler->contentTypeHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\Type\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\ContentTypeHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::locationHandler
     */
    public function testContentLocationHandler()
    {
        $handler = $this->persistenceHandler->locationHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\Location\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\LocationHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::trashHandler
     */
    public function testTrashHandler()
    {
        $handler = $this->persistenceHandler->trashHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\Location\\Trash\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\TrashHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::objectStateHandler
     */
    public function testObjectStateHandler()
    {
        $handler = $this->persistenceHandler->objectStateHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\ObjectState\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\ObjectStateHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::sectionHandler
     */
    public function testSectionHandler()
    {
        $handler = $this->persistenceHandler->sectionHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\Section\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\Cache\\SectionHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::userHandler
     */
    public function testUserHandler()
    {
        $handler = $this->persistenceHandler->userHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\User\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\UserHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::urlAliasHandler
     */
    public function testUrlAliasHandler()
    {
        $handler = $this->persistenceHandler->urlAliasHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\UrlAlias\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\UrlAliasHandler', $handler );
    }

    /**
     * Test that instance is of correct type
     *
     * @covers eZ\Publish\Core\Persistence\Cache\Handler::urlWildcardHandler
     */
    public function testUrlWildcardHandler()
    {
        $handler = $this->persistenceHandler->urlWildcardHandler();
        $this->assertInstanceOf( 'eZ\\Publish\\SPI\\Persistence\\Content\\UrlWildcard\\Handler', $handler );
        $this->assertInstanceOf( 'eZ\\Publish\\Core\\Persistence\\InMemory\\UrlWildcardHandler', $handler );
    }
}
