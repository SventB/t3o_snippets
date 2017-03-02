<?php
namespace T3O\T3oSnippets\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Sven Burkert <bedienung@sbtheke.de>, SBTheke web development
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @package t3o_snippets
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Snippet extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * crdate
     *
     * @var integer
     */
    protected $crdate;

    /**
     * tstamp
     *
     * @var integer
     */
    protected $tstamp;

    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title;

    /**
     * category
     *
     * @var T3o\T3oSnippets\Domain\Model\Category
     * @validate NotEmpty
     */
    protected $category;

    /**
     * description
     *
     * @var string
     * @validate NotEmpty
     */
    protected $description;

    /**
     * author
     *
     * @var T3o\T3oSnippets\Domain\Model\Author
     */
    protected $author;

    /**
     * code
     *
     * @var string
     * @validate NotEmpty
     */
    protected $code;

    /**
     * tags
     *
     * @var string
     */
    protected $tags;

    /**
     * Returns the tstamp
     *
     * @return integer $tstamp
     */
    public function getTstamp() {
        return $this->tstamp;
    }

    /**
     * Sets the tstamp
     *
     * @param integer $tstamp
     * @return void
     */
    public function setTstamp($tstamp) {
        $this->tstamp = $tstamp;
    }

    /**
     * Returns the crdate
     *
     * @return integer $crdate
     */
    public function getCrdate() {
        return $this->crdate;
    }

    /**
     * Sets the crdate
     *
     * @param integer $crdate
     * @return void
     */
    public function setCrdate($crdate) {
        $this->crdate = $crdate;
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Returns the category
     *
     * @return T3o\T3oSnippets\Domain\Model\Category $category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Sets the category
     *
     * @param T3o\T3oSnippets\Domain\Model\Category $category
     * @return void
     */
    public function setCategory(T3o\T3oSnippets\Domain\Model\Category $category) {
        $this->category = $category;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Returns the author
     *
     * @return T3o\T3oSnippets\Domain\Model\Author $author
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Sets the author
     *
     * @param T3o\T3oSnippets\Domain\Model\Author $author
     * @return void
     */
    public function setAuthor(T3o\T3oSnippets\Domain\Model\Author $author) {
        $this->author = $author;
    }

    /**
     * Returns the code
     *
     * @return string $code
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Sets the code
     *
     * @param string $code
     * @return void
     */
    public function setCode($code) {
        $this->code = $code;
    }

    /**
     * Returns the tags
     *
     * @return string $tags
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Sets the tags
     *
     * @param string $tags
     * @return void
     */
    public function setTags($tags) {
        $this->tags = $tags;
    }

}