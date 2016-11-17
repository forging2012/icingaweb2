<?php
/* Icinga Web 2 | (c) 2016 Icinga Development Team | GPLv2+ */

namespace Icinga\Module\Translation\Catalog;

use InvalidArgumentException;

/**
 * Class CatalogEntry
 *
 * Provides a convenient interface to handle entries of gettext PO files.
 *
 * @package Icinga\Module\Translation\Catalog
 */
class CatalogEntry
{
    protected $obsolete;
    protected $messageContext;
    protected $messageId;
    protected $messageIdPlural;
    protected $message;
    protected $messagePlurals;
    protected $previousMessageContext;
    protected $previousMessageId;
    protected $previousMessageIdPlural;
    protected $translatorComments;
    protected $extractedComments;
    protected $paths;
    protected $flags;

    /**
     * Create a new CatalogEntry
     *
     * @param   string  $messageId      The untranslated message
     * @param   string  $message        The translated message
     * @param   string  $messageContext The message's context
     */
    public function __construct($messageId, $message, $messageContext = null)
    {
        $this->messageId = $messageId;
        $this->message = $message;
        $this->messageContext = $messageContext;
    }

    /**
     * Create and return a new CatalogEntry from the given array
     *
     * @param   array   $entry
     *
     * @return  CatalogEntry
     *
     * @throws  InvalidArgumentException
     */
    public static function fromArray(array $entry)
    {
        if (! isset($entry['msgid']) || ! isset($entry['msgstr'][0])) {
            throw new InvalidArgumentException('Message id and a message are required to create a catalog entry');
        }

        $catalogEntry = new static(
            $entry['msgid'],
            $entry['msgstr'][0],
            isset($entry['msgctxt']) ? $entry['msgctxt'] : null
        );

        foreach ($entry as $key => $value)
        {
            switch ($key)
            {
                case 'obsolete':
                    $catalogEntry->setObsolete($value);
                    break;
                case 'msgid_plural':
                    $catalogEntry->setMessageIdPlural($value);
                    break;
                case 'msgstr':
                    unset($value[0]);
                    if (! empty($value)) {
                        $catalogEntry->setMessagePlurals($value);
                    }
                    break;
                case 'previous_msgctxt':
                    $catalogEntry->setPreviousMessageContext($value);
                    break;
                case 'previous_msgid':
                    $catalogEntry->setPreviousMessageId($value);
                    break;
                case 'previous_msgid_plural':
                    $catalogEntry->setPreviousMessageIdPlural($value);
                    break;
                case 'translator_comments':
                    $catalogEntry->setTranslatorComments($value);
                    break;
                case 'extracted_comments':
                    $catalogEntry->setExtractedComments($value);
                    break;
                case 'paths':
                    $catalogEntry->setPaths($value);
                    break;
                case 'flags':
                    $catalogEntry->setFlags($value);
                    break;
            }
        }

        return $catalogEntry;
    }

    /**
     * Set whether this CatalogEntry is obsolete
     *
     * @param   bool    $state
     *
     * @return  $this
     */
    public function setObsolete($state = true)
    {
        $this->obsolete = $state;
        return $this;
    }

    /**
     * Return whether this CatalogEntry is obsolete
     *
     * @return bool
     */
    public function getObsolete()
    {
        return $this->obsolete;
    }

    /**
     * Set the plural message id for this CatalogEntry
     *
     * @param   string  $messageIdPlural
     *
     * @return  $this
     */
    public function setMessageIdPlural($messageIdPlural)
    {
        $this->messageIdPlural = $messageIdPlural;
        return $this;
    }

    /**
     * Return the plural message id for this CatalogEntry
     *
     * @return string
     */
    public function getMessageIdPlural()
    {
        return $this->messageIdPlural;
    }

    /**
     * Set the plural messages for this CatalogEntry
     *
     * @param   array   $messagePlurals
     *
     * @return  $this
     */
    public function setMessagePlurals(array $messagePlurals)
    {
        $this->messagePlurals = $messagePlurals;
        return $this;
    }

    /**
     * Return the plural messages for this CatalogEntry
     *
     * @return array
     */
    public function getMessagePlurals()
    {
        return $this->messagePlurals;
    }

    /**
     * Set the previous message context for this CatalogEntry
     *
     * @param   string  $previousMessageContext
     *
     * @return  $this
     */
    public function setPreviousMessageContext($previousMessageContext)
    {
        $this->previousMessageContext = $previousMessageContext;
        return $this;
    }

    /**
     * Return the previous message context for this CatalogEntry
     *
     * @return  string
     */
    public function getPreviousMessageContext()
    {
        return $this->previousMessageContext;
    }

    /**
     * Set the previous message id for this CatalogEntry
     *
     * @param   string  $previousMessageId
     *
     * @return  $this
     */
    public function setPreviousMessageId($previousMessageId)
    {
        $this->previousMessageId = $previousMessageId;
        return $this;
    }

    /**
     * Return the previous message id for this CatalogEntry
     *
     * @return string
     */
    public function getPreviousMessageId()
    {
        return $this->previousMessageId;
    }

    /**
     * Set the previous plural message id for this CatalogEntry
     *
     * @param   string  $previousMessageIdPlural
     *
     * @return  $this
     */
    public function setPreviousMessageIdPlural($previousMessageIdPlural)
    {
        $this->previousMessageIdPlural = $previousMessageIdPlural;
        return $this;
    }

    /**
     * Return the previous plural message id for this CatalogEntry
     *
     * @return string
     */
    public function getPreviousMessageIdPlural()
    {
        return $this->previousMessageIdPlural;
    }

    /**
     * Set translator comments for this CatalogEntry
     *
     * @param   array   $translatorComments
     *
     * @return  $this
     */
    public function setTranslatorComments(array $translatorComments)
    {
        $this->translatorComments = $translatorComments;
        return $this;
    }

    /**
     * Return translator comments for this CatalogEntry
     *
     * @return array
     */
    public function getTranslatorComments()
    {
        return $this->translatorComments;
    }

    /**
     * Set extracted comments for this CatalogEntry
     *
     * @param   array   $extractedComments
     *
     * @return  $this
     */
    public function setExtractedComments(array $extractedComments)
    {
        $this->extractedComments = $extractedComments;
        return $this;
    }

    /**
     * Return extracted comments for this CatalogEntry
     *
     * @return array
     */
    public function getExtractedComments()
    {
        return $this->extractedComments;
    }

    /**
     * Set paths for this CatalogEntry
     *
     * @param   array   $paths
     *
     * @return  $this
     */
    public function setPaths(array $paths)
    {
        $this->paths = $paths;
        return $this;
    }

    /**
     * Return paths for this CatalogEntry
     *
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * Set flags for this CatalogEntry
     *
     * @param   array   $flags
     *
     * @return  $this
     */
    public function setFlags(array $flags)
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Return flags for this CatalogEntry
     *
     * @return array
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * Return whether this CatalogEntry is translated
     *
     * @return  bool
     */
    public function isTranslated()
    {
        return !empty($this->msgstr);
    }

    /**
     * Return whether this CatalogEntry is fuzzy
     *
     * @return  bool
     */
    public function isFuzzy()
    {
        return !empty($this->flags) && in_array('fuzzy', $this->flags);
    }

    /**
     * Return whether this CatalogEntry is faulty
     *
     * @return  bool
     */
    public function isFaulty()
    {
        $numberOfPlaceHoldersInId = substr_count($this->messageId, '%s');

        foreach ($this->messagePlurals as $key => $value)
        {
            if (substr_count($value, '%s') !== $numberOfPlaceHoldersInId)
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Return whether this CatalogEntry is obsolete
     *
     * @return  bool
     */
    public function isObsolete()
    {
        return $this->obsolete;
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
