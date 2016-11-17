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
     * @param   string $messageId The untranslated message
     * @param   string $message The translated message
     * @param   string $messageContext The message's context
     */
    public function __construct($messageId, $message, $messageContext = null)
    {

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
        if (isset($entry['msgid']) && isset($entry['msgstr'][0])) {
            throw new InvalidArgumentException();
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
                    $catalogEntry->setMessage($value);
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
                    break;
                case 'paths':
                    break;
                case 'flags':
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
    public function setObsolete($state)
    {
        $this->obsolete = $state;
        return $this;
    }

    /**
     * Get whether this CatalogEntry is obsolete
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
     * @param   string  $messageIdPluralValue
     *
     * @return  $this
     */
    public function setMessageIdPlural($messageIdPluralValue)
    {
        $this->messageIdPlural = $messageIdPluralValue;
        return $this;
    }

    /**
     * Get the plural message id for this CatalogEntry
     *
     * @return string
     */
    public function getMessageIdPlural()
    {
        return $this->messageIdPlural;
    }

    /**
     * Set the message for this CatalogEntry
     *
     * @param   array   $messageValue
     *
     * @return  $this
     */
    public function setMessage($messageValue)
    {
        $this->message = $messageValue;
        return $this;
    }

    /**
     * Get the message for this CatalogEntry
     *
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the previous message context for this CatalogEntry
     *
     * @param   string  $previousMessageContextValue
     *
     * @return  $this
     */
    public function setPreviousMessageContext($previousMessageContextValue)
    {
        $this->previousMessageContext = $previousMessageContextValue;
        return $this;
    }

    /**
     * Get the previous message context for this CatalogEntry
     *
     * @return  string
     */
    public function getPreviousMessageContent()
    {
        return $this->previousMessageContext;
    }

    /**
     * Set the previous message id for this CatalogEntry
     *
     * @param   string  $previousMessageIdValue
     *
     * @return  $this
     */
    public function setPreviousMessageId($previousMessageIdValue)
    {
        $this->previousMessageId = $previousMessageIdValue;
        return $this;
    }

    /**
     * Get the previous message id for this CatalogEntry
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
     * @param   string  $previousMessageIdPluralValue
     *
     * @return  $this
     */
    public function setPreviousMessageIdPlural($previousMessageIdPluralValue)
    {
        $this->previousMessageIdPlural = $previousMessageIdPluralValue;
        return $this;
    }

    /**
     * Get the previous plural message id for this CatalogEntry
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
     * @param   array   $translatorCommentsValue
     *
     * @return  $this
     */
    public function setTranslatorComments($translatorCommentsValue)
    {
        $this->translatorComments = $translatorCommentsValue;
        return $this;
    }

    /**
     * Get translator comments for this CatalogEntry
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
     * @param   array   $extractedCommentsValue
     *
     * @return  $this
     */
    public function setExtractedComments($extractedCommentsValue)
    {
        $this->extractedComments = $extractedCommentsValue;
        return $this;
    }

    /**
     * Get extracted comments for this CatalogEntry
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
     * @param   array   $pathsValue
     *
     * @return  $this
     */
    public function setPaths($pathsValue)
    {
        $this->paths = $pathsValue;
        return $this;
    }

    /**
     * Get paths for this CatalogEntry
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
     * @param   array   $flagsValue
     *
     * @return  $this
     */
    public function setFlags($flagsValue)
    {
        $this->flags = $flagsValue;
        return $this;
    }

    /**
     * Get flags for this CatalogEntry
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
