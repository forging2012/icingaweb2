<?php
/* Icinga Web 2 | (c) 2016 Icinga Development Team | GPLv2+ */

namespace Icinga\Module\Translation\Catalog;


/**
 * Class CatalogEntry
 *
 * Provides a convenient interface to handle entries of gettext PO files.
 *
 * @package Icinga\Module\Translation\Catalog
 */
class CatalogEntry
{
    /**
     * Create a new CatalogEntry
     *
     * @param   string  $messageId  The untranslated message
     * @param   string  $message    The translated message
     * @param   string  $context    The message's context
     */
    public function __construct($messageId, $message, $context = null)
    {

    }

    /**
     * Create and return a new CatalogEntry from the given array
     *
     * @param   array   $entry
     *
     * @return  CatalogEntry
     */
    public static function fromArray(array $entry)
    {

    }

    /**
     * Return whether this CatalogEntry is translated
     *
     * @return  bool
     */
    public function isTranslated()
    {

    }

    /**
     * Return whether this CatalogEntry is fuzzy
     *
     * @return  bool
     */
    public function isFuzzy()
    {

    }

    /**
     * Return whether this CatalogEntry is faulty
     *
     * @return  bool
     */
    public function isFaulty()
    {

    }

    /**
     * Return whether this CatalogEntry is obsolete
     *
     * @return  bool
     */
    public function isObsolete()
    {

    }

    /**
     * Render and return this CatalogEntry as string
     *
     * @return  string
     */
    public function render()
    {

    }

    /**
     * @see CatalogEntry::render()
     */
    public function __toString()
    {

    }
}
