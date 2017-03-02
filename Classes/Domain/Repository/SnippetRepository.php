<?php
namespace T3O\T3oSnippets\Domain\Repository;

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
class SnippetRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    /**
     * Returns all snippets, sorted
     *
     * @param array $orderings
     * @param T3o\T3oSnippets\Domain\Model\Category $category
     * @param T3o\T3oSnippets\Domain\Model\Author $author
     * @param string $search
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     *         all objects, will be empty if no objects are found, will be an array if raw query results are enabled
     * @api
     */
    public function findAllSorted(array $orderings, T3o\T3oSnippets\Domain\Model\Category $category = NULL, T3o\T3oSnippets\Domain\Model\Author $author = NULL, $search = NULL) {
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $and = [];
        if($category) {
            $and[] = $query->equals('category', $category);
        }
        if($author) {
            $and[] = $query->equals('author', $author);
        }
        if($search) {
            $or = [];
            $or[] = $query->like('title', '%' . $search . '%');
            $or[] = $query->like('description', '%' . $search . '%');
            $or[] = $query->like('code', '%' . $search . '%');
            $or[] = $query->like('tags', '%' . $search . '%');
            $and[] = $query->logicalOr($or);
        }
        if(count($and)) {
            $query->matching($query->logicalAnd($and));
        };
        return $query->execute();
    }

    /**
     * Returns all snippets of a specific category
     *
     * @param T3o\T3oSnippets\Domain\Model\Category $category
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     *         all objects, will be empty if no objects are found, will be an array if raw query results are enabled
     * @api
     */
    public function findAllCategory(T3o\T3oSnippets\Domain\Model\Category $category) {
        $query = $this->createQuery();
        $query->matching($query->equals('category', $category));
        return $query->execute();
    }

    /**
     * Returns all snippets of a specific author
     *
     * @param T3o\T3oSnippets\Domain\Model\Author $author
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     *         all objects, will be empty if no objects are found, will be an array if raw query results are enabled
     * @api
     */
    public function findAllAuthor(T3o\T3oSnippets\Domain\Model\Author $author) {
        $query = $this->createQuery();
        $query->matching($query->equals('author', $author));
        return $query->execute();
    }

    /**
     * Returns all snippets with a specific tag
     *
     * @param string $tag
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     *         all objects, will be empty if no objects are found, will be an array if raw query results are enabled
     * @api
     */
    public function findAllTag($tag) {
        $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
        $query = $this->createQuery();
        $query->matching(
            $query->logicalOr(
                $query->equals('tags', $tag),
                $query->like('tags', $tag . ',%'),
                $query->like('tags', '%,' . $tag),
                $query->like('tags', '%,' . $tag . ',%')
            )
        );
        return $query->execute();
    }

}