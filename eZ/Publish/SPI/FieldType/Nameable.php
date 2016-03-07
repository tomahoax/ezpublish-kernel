<?php

/**
 * File containing the FieldType Indexable interface.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @since 6.2.1/5.4.6
 */
namespace eZ\Publish\SPI\FieldType;

use eZ\Publish\SPI\Persistence\Content\Field;
use eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition;

/**
 * The field type interface which all field types have to implement to be
 * able to generate content name when field is part of name-schema or url-schema.
 *
 * For use by business logic (API implementation), so can *not* directly or indirectly rely on API.
 */
interface Nameable
{
    /**
     * Get field name for use in content name/url schema.
     *
     * @param \eZ\Publish\SPI\Persistence\Content\Field $field
     * @param \eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition $fieldDefinition
     *
     * @return string
     */
    public function getName(Field $field, FieldDefinition $fieldDefinition);
}
