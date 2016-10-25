<?php
/* Icinga Web 2 | (c) 2016 Icinga Development Team | GPLv2+ */

namespace Icinga\Web;

use DateTime;

/**
 * An announce to be displayed prominently in the web UI
 */
class Announce
{
    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var DateTime
     */
    protected $start;

    /**
     * @var DateTime
     */
    protected $end;

    /**
     * Hash of this Announce computed from its members
     *
     * @var string|null
     */
    protected $hash = null;

    /**
     * Announce constructor
     *
     * @param   string      $author
     * @param   string      $message
     * @param   DateTime    $start
     * @param   DateTime    $end
     */
    public function __construct($author, $message, $start, $end)
    {
        $this->author = $author;
        $this->message = $message;
        $this->start = clone $start;
        $this->end = clone $end;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param   string $author
     *
     * @return  $this
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        $this->hash = null;
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param   string $message
     *
     * @return  $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        $this->hash = null;
        return $this;
    }

    /**
     * Get start
     *
     * @return DateTime
     */
    public function getStart()
    {
        return clone $this->start;
    }

    /**
     * Set start
     *
     * @param   DateTime $start
     *
     * @return  $this
     */
    public function setStart($start)
    {
        $this->start = clone $start;
        $this->hash = null;
        return $this;
    }

    /**
     * Get end
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return clone $this->end;
    }

    /**
     * Set end
     *
     * @param   DateTime $end
     *
     * @return  $this
     */
    public function setEnd($end)
    {
        $this->end = clone $end;
        $this->hash = null;
        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        if ($this->hash === null) {
            $this->hash = md5(serialize(array(
                $this->author,
                $this->message,
                $this->start->getTimestamp(),
                $this->end->getTimestamp()
            )));
        }
        return $this->hash;
    }
}
