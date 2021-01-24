<?php

namespace App\Entity;

class Search
{
    /**
     * @var int|null
     */
    private $genre;

    /**
     * @return int|null
     */
    public function getGenre(): ?int
    {
        return $this->genre;
    }

    /**
     * @param int|null $genre
     * @return Search
     */
    public function setGenre(int $genre): Search
    {
        $this->genre = $genre;
        return $this;
    }
}
