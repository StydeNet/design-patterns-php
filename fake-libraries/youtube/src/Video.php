<?php

namespace YouTube;

class Video
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $length;

    /**
     * @var int
     */
    protected $likes;

    /**
     * @var int
     */
    protected $views;

    /**
     * Video constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'] ?? '';
        $this->title = $attributes['title'] ?? '';
        $this->length = $attributes['length'] ?? 0;
        $this->likes = $attributes['likes'] ?? 0;
        $this->views = $attributes['views'] ?? 0;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getLikes(): int
    {
        return $this->likes;
    }

    /**
     * @return int
     */
    public function getViews(): int
    {
        return $this->views;
    }
}
