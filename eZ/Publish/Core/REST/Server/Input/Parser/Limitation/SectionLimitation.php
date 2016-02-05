<?php
/**
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZ\Publish\Core\REST\Server\Input\Parser\Limitation;

use eZ\Publish\API\Repository\Values\User\Limitation;

class SectionLimitation extends BaseLimitationParser
{

    /**
     * Returns the name of the id variable in the href of a limitation value.
     * Example: the ID of the Section in /content/sections/{contentId} is 'contentId'.
     * @return string
     */
    protected function getLimitationValueHrefIdName()
    {
        return 'sectionId';
    }

    /**
     * Returns the limitation object the parser handles.
     * @return \eZ\Publish\API\Repository\Values\User\Limitation A Limitation value object
     */
    protected function buildLimitationObject()
    {
        return new Limitation\SectionLimitation();
    }
}
