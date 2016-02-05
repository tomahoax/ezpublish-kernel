<?php
/**
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZ\Publish\Core\REST\Server\Input\Parser\Limitation;

use eZ\Publish\Core\REST\Common\Input\BaseParser;
use eZ\Publish\Core\REST\Common\Input\ParsingDispatcher;
use eZ\Publish\Core\REST\Common\Exceptions;
use eZ\Publish\API\Repository\Values;

abstract class BaseLimitationParser extends BaseParser
{
    /**
     * Parse input structure.
     *
     * @param array $data
     * @param \eZ\Publish\Core\REST\Common\Input\ParsingDispatcher $parsingDispatcher
     *
     * @return \eZ\Publish\API\Repository\Values\ValueObject
     */
    public function parse(array $data, ParsingDispatcher $parsingDispatcher)
    {
        if (!array_key_exists('_identifier', $data)) {
            throw new Exceptions\Parser("Missing '_identifier' attribute for Limitation.");
        }

        $limitationObject = $this->buildLimitationObject();

        if (!isset($data['values']['ref']) || !is_array($data['values']['ref'])) {
            throw new Exceptions\Parser('Invalid format for data values in Limitation.');
        }

        $limitationValues = [];
        foreach ($data['values']['ref'] as $limitationValue) {
            if (!array_key_exists('_href', $limitationValue)) {
                throw new Exceptions\Parser('Invalid format for data values in Limitation.');
            }

            $limitationValues[] = $this->requestParser->parseHref(
                $limitationValue['_href'],
                $this->getLimitationValueHrefIdName()
            );
        }

        $limitationObject->limitationValues = $limitationValues;

        return $limitationObject;
    }

    /**
     * Returns the name of the id variable in the href of a limitation value.
     * Example: the ID of the Section in /content/sections/{contentId} is 'contentId'.
     *
     * @return string
     */
    abstract protected function getLimitationValueHrefIdName();

    /**
     * Returns the limitation object the parser handles.
     *
     * @return \eZ\Publish\API\Repository\Values\User\Limitation A Limitation value object
     */
    abstract protected function buildLimitationObject();
}
