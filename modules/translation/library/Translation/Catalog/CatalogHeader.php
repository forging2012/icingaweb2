<?php
/* Icinga Web 2 | (c) 2016 Icinga Development Team | GPLv2+ */

namespace Icinga\Module\Translation\Catalog;

use ArrayAccess;


/**
 * Class CatalogHeader
 *
 * Provides a convenient interface to handle headers of gettext PO files.
 *
 * @package Icinga\Module\Translation\Catalog
 */
class CatalogHeader implements ArrayAccess
{
    /**
     * The format used in header entries to represent date and time
     *
     * @var string
     */
    const DATETIME_FORMAT = 'Y-m-d H:iO';

    /**
     * Create a new CatalogHeader
     *
     * @param   array   $headers
     */
    public function __construct(array $headers)
    {

    }

    /**
     * Create and return a new CatalogHeader from the given string
     *
     * @param   string  $header
     *
     * @return  CatalogHeader
     */
    public static function fromString($header)
    {

    }

    /**
     * Return whether the given header exists
     *
     * @param   string  $name   The name of the header
     *
     * @return  bool
     */
    public function offsetExists($name)
    {

    }

    /**
     * Return the value of the given header
     *
     * @param   string  $name   The name of the header
     *
     * @return  string
     */
    public function offsetGet($name)
    {

    }

    /**
     * Set the given header to the given value
     *
     * @param   string  $name   The name of the header
     * @param   string  $value  The value of the header
     */
    public function offsetSet($name, $value)
    {

    }

    /**
     * Unset the given header
     *
     * @param   string  $name   The name of the header
     */
    public function offsetUnset($name)
    {

    }

    /**
     * Render and return this CatalogHeader as string
     *
     * @return  string
     */
    public function render()
    {

    }

    /**
     * @see CatalogHeader::render()
     */
    public function __toString()
    {

    }
}
