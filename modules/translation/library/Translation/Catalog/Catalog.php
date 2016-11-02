<?php
/* Icinga Web 2 | (c) 2016 Icinga Development Team | GPLv2+ */

namespace Icinga\Module\Translation\Catalog;

use ArrayIterator;
use DateTime;
use IteratorAggregate;


/**
 * Class Catalog
 *
 * Provides a convenient interface to handle gettext PO files.
 *
 * @package Icinga\Module\Translation\Catalog
 */
class Catalog implements IteratorAggregate
{
    /**
     * Create a new Catalog
     *
     * @param   CatalogHeader   $header
     * @param   array           $entries
     */
    public function __construct(CatalogHeader $header, array $entries)
    {

    }

    /**
     * Create and return a new Catalog from the given array of entries
     *
     * @param   array   $rawEntries
     *
     * @return  Catalog
     */
    public static function fromArray(array $rawEntries)
    {

    }

    /**
     * Create and return a new Catalog from the given path
     *
     * @param   string  $catalogPath
     *
     * @return  Catalog
     */
    public static function fromPath($catalogPath)
    {

    }

    /**
     * Create and return a iterator for this catalogs entries
     *
     * @return  ArrayIterator
     */
    public function getIterator()
    {

    }

    /**
     * Return whether the given header exists
     *
     * @param   string  $name   The name of the header
     *
     * @return  bool
     */
    public function hasHeader($name)
    {

    }

    /**
     * Return the value of the given header
     *
     * @param   string  $name   The name of the header
     *
     * @return  string
     */
    public function getHeader($name)
    {

    }

    /**
     * Set the given header to the given value
     *
     * @param   string  $name   The name of the header
     * @param   string  $value  The value of the header
     *
     * @return  $this
     */
    public function setHeader($name, $value)
    {

    }

    /**
     * Remove the given header
     *
     * @param   string  $name   The name of the header
     *
     * @return  $this
     */
    public function removeHeader($name)
    {

    }

    /**
     * Return the creation date of this Catalog
     *
     * @return  DateTime
     */
    public function creationDate()
    {

    }

    /**
     * Return the revision date of this Catalog
     *
     * @return  DateTime
     */
    public function revisionDate()
    {

    }

    /**
     * Render and return this catalog as a string
     *
     * @return  string
     */
    public function render()
    {

    }

    /**
     * @see Catalog::render()
     */
    public function __toString()
    {

    }
}
