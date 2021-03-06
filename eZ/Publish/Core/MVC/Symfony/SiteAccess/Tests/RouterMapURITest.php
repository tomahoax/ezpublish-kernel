<?php

/**
 * File containing the RouterMapURITest class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */
namespace eZ\Publish\Core\MVC\Symfony\SiteAccess\Tests;

use eZ\Publish\Core\MVC\Symfony\SiteAccess\Matcher\Map\URI as URIMapMatcher;
use eZ\Publish\Core\MVC\Symfony\Routing\SimplifiedRequest;
use PHPUnit_Framework_TestCase;

class RouterMapURITest extends PHPUnit_Framework_TestCase
{
    public function testSetGetRequest()
    {
        $request = new SimplifiedRequest(array('pathinfo' => '/bar/baz'));
        $mapKey = 'bar';
        $matcher = new URIMapMatcher(array('foo' => $mapKey));
        $matcher->setRequest($request);
        $this->assertSame($request, $matcher->getRequest());
        $this->assertSame($mapKey, $matcher->getMapKey());
    }

    /**
     * @param string $uri
     * @param string $expectedFixedUpURI
     *
     * @dataProvider fixupURIProvider
     */
    public function testAnalyseURI($uri, $expectedFixedUpURI)
    {
        $matcher = new URIMapMatcher(array());
        $matcher->setRequest(
            new SimplifiedRequest(array('pathinfo' => $uri))
        );
        $this->assertSame($expectedFixedUpURI, $matcher->analyseURI($uri));
        // Unserialized matcher should have the same behavior
        $unserializedMatcher = unserialize(serialize($matcher));
        $this->assertSame($expectedFixedUpURI, $unserializedMatcher->analyseURI($uri));
    }

    /**
     * @param string $fullUri
     * @param string $linkUri
     *
     * @dataProvider fixupURIProvider
     */
    public function testAnalyseLink($fullUri, $linkUri)
    {
        $matcher = new URIMapMatcher(array());
        $matcher->setRequest(
            new SimplifiedRequest(array('pathinfo' => $fullUri))
        );
        $this->assertSame($fullUri, $matcher->analyseLink($linkUri));
        // Unserialized matcher should have the same behavior
        $unserializedMatcher = unserialize(serialize($matcher));
        $this->assertSame($fullUri, $unserializedMatcher->analyseLink($linkUri));
    }

    public function fixupURIProvider()
    {
        return array(
            array('/my_siteaccess/foo/bar', '/foo/bar'),
            array('/foo/foo/bar', '/foo/bar'),
            array('/foo/foo/bar?something=foo&bar=toto', '/foo/bar?something=foo&bar=toto'),
            array('/vive/le/sucre', '/le/sucre'),
            array('/ezdemo_site/some/thing?foo=ezdemo_site&bar=toto', '/some/thing?foo=ezdemo_site&bar=toto'),
        );
    }

    public function testReverseMatchFail()
    {
        $config = array('foo' => 'bar');
        $matcher = new URIMapMatcher($config);
        $this->assertNull($matcher->reverseMatch('non_existent'));
    }

    public function testReverseMatch()
    {
        $config = array(
            'some_uri' => 'some_siteaccess',
            'something_else' => 'another_siteaccess',
            'toutouyoutou' => 'ezdemo_site',
        );
        $request = new SimplifiedRequest(array('pathinfo' => '/foo'));
        $matcher = new URIMapMatcher($config);
        $matcher->setRequest($request);

        $result = $matcher->reverseMatch('ezdemo_site');
        $this->assertInstanceOf('eZ\Publish\Core\MVC\Symfony\SiteAccess\Matcher\Map\URI', $result);
        $this->assertSame($request, $matcher->getRequest());
        $this->assertSame('toutouyoutou', $result->getMapKey());
        $this->assertSame('/toutouyoutou/foo', $result->getRequest()->pathinfo);
    }
}
