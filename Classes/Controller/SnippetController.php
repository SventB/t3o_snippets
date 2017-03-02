<?php
namespace T3O\T3oSnippets\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

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
class SnippetController extends ActionController {

    /**
     * snippetRepository
     *
     * @var T3o\T3oSnippets\Domain\Repository\SnippetRepository
     * @inject
     */
    protected $snippetRepository;

    /**
     * action list
     *
     * @param string $order: Ordering
     * @param string $orderDir: Direction of ordering
     * @param T3o\T3oSnippets\Domain\Model\Category $category
     * @param T3o\T3oSnippets\Domain\Model\Author $author
     * @param string $search
     * @return void
     */
    public function listAction($order = 'title', $orderDir = 'asc', T3o\T3oSnippets\Domain\Model\Category $category = NULL, T3o\T3oSnippets\Domain\Model\Author $author = NULL, $search = NULL) {
        $snippets = $this->snippetRepository->findAllSorted(
            [$order => ($orderDir == 'asc' ? Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING : Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING)],
            $category,
            $author,
            $search
        );
        $this->view->assign('snippets', $snippets);
        $orderDirArray = [
            'title' => 'asc',
            'tstamp' => 'asc',
            'crdate' => 'asc'
        ];
        if($orderDir == 'asc' && $order == 'title') {
            $orderDirArray['title'] = 'desc';
        }
        if($orderDir == 'asc' && $order == 'tstamp') {
            $orderDirArray['tstamp'] = 'desc';
        }
        if($orderDir == 'asc' && $order == 'crdate') {
            $orderDirArray['crdate'] = 'desc';
        }
        $this->view->assign('orderDir', $orderDirArray);
        $this->view->assign('category', $category);
        $this->view->assign('author', $author);
        $this->view->assign('search', $search);
    }

    /**
     * action list uncached
     *
     * @param string $order: Ordering
     * @param string $orderDir: Direction of ordering
     * @param T3o\T3oSnippets\Domain\Model\Category $category
     * @param T3o\T3oSnippets\Domain\Model\Author $author
     * @param string $search
     * @return void
     */
    public function listUncachedAction($order = 'title', $orderDir = 'asc', T3o\T3oSnippets\Domain\Model\Category $category = NULL, T3o\T3oSnippets\Domain\Model\Author $author = NULL, $search = NULL) {
        $this->listAction($order, $orderDir, $category, $author, $search);
    }

    /**
     * action search
     *
     * @param string $search
     * @param T3o\T3oSnippets\Domain\Model\Category $category
     * @return void
     */
    public function searchAction($search = NULL, T3o\T3oSnippets\Domain\Model\Category $category = NULL) {
        $this->view->assign('search', $search);
        $this->view->assign('category', $category);
        $this->view->assign('categories', $this->objectManager->get('Tx_T3oSnippets_Domain_Repository_CategoryRepository')->findAll());
    }

    /**
     * action show
     *
     * @param T3o\T3oSnippets\Domain\Model\Snippet $snippet
     * @return void
     */
    public function showAction(T3o\T3oSnippets\Domain\Model\Snippet $snippet) {
        if($snippet->getAuthor()) {
            $this->view->assign('authorSnippets', $this->snippetRepository->findAllAuthor($snippet->getAuthor()));
        }
        $this->view->assign('codeClipboard', $codeClipboard);
        $this->view->assign('codeGeshi', $this->codeGeshi($snippet->getCode(), $snippet->getCategory()->getTitle()));
        $this->view->assign('snippet', $snippet);
        $this->view->assign('tags', t3lib_div::trimExplode(',', $snippet->getTags()));
    }

    /**
     * action category
     *
     * @param T3o\T3oSnippets\Domain\Model\Category $category
     * @return void
     */
    public function categoryAction(T3o\T3oSnippets\Domain\Model\Category $category) {
        $snippets = $this->snippetRepository->findAllCategory($category);
        $this->view->assign('snippets', $snippets);
        $this->view->assign('category', $category);
    }

    /**
     * action tag
     *
     * @param string $tag
     * @return void
     */
    public function tagAction($tag) {
        $snippets = $this->snippetRepository->findAllTag($tag);
        $this->view->assign('snippets', $snippets);
        $this->view->assign('tag', $tag);
    }

    /**
     * action author
     *
     * @param T3o\T3oSnippets\Domain\Model\Author $author
     * @return void
     */
    public function authorAction(T3o\T3oSnippets\Domain\Model\Author $author) {
        $snippets = $this->snippetRepository->findAllAuthor($author);
        $this->view->assign('snippets', $snippets);
        $this->view->assign('author', $author);
    }

    /**
     * action new
     *
     * @param T3o\T3oSnippets\Domain\Model\Snippet $newSnippet
     * @dontvalidate $newSnippet
     * @return void
     */
    public function newAction(T3o\T3oSnippets\Domain\Model\Snippet $newSnippet = NULL) {
        $this->view->assign('newSnippet', $newSnippet);
        $this->view->assign('categories', $this->objectManager->get('Tx_T3oSnippets_Domain_Repository_CategoryRepository')->findAll());
        $this->view->assign('tags', $this->getTags());
    }

    /**
     * action create
     *
     * @param T3o\T3oSnippets\Domain\Model\Snippet $newSnippet
     * @return void
     */
    public function createAction(T3o\T3oSnippets\Domain\Model\Snippet $newSnippet) {
        if($GLOBALS['TSFE']->loginUser) {
            $author = $this->objectManager->get('Tx_T3oSnippets_Domain_Repository_AuthorRepository')->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
            $newSnippet->setAuthor($author);
        }
        $this->snippetRepository->add($newSnippet);
        $this->flashMessageContainer->add('Your new Snippet was created.');
        $this->redirect(NULL, NULL, NULL, NULL, $this->settings['pidList']);
    }

    /**
     * action edit
     *
     * @param T3o\T3oSnippets\Domain\Model\Snippet $snippet
     * @dontvalidate $snippet
     * @return void
     */
    public function editAction(T3o\T3oSnippets\Domain\Model\Snippet $snippet) {
        $this->view->assign('snippet', $snippet);
        $this->view->assign('categories', $this->objectManager->get('Tx_T3oSnippets_Domain_Repository_CategoryRepository')->findAll());
    }

    /**
     * action update
     *
     * @param T3o\T3oSnippets\Domain\Model\Snippet $snippet
     * @return void
     */
    public function updateAction(T3o\T3oSnippets\Domain\Model\Snippet $snippet) {
        $this->snippetRepository->update($snippet);
        $this->flashMessageContainer->add('Your Snippet was updated.');
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param T3o\T3oSnippets\Domain\Model\Snippet $snippet
     * @return void
     */
    public function deleteAction(T3o\T3oSnippets\Domain\Model\Snippet $snippet) {
        $this->snippetRepository->remove($snippet);
        $this->flashMessageContainer->add('Your Snippet was removed.');
        $this->redirect('list');
    }

    /**
     * @return \TYPO3\Flow\Error\Message
     */
    protected function getErrorFlashMessage() {
        switch($this->actionMethodName) {
            case 'createAction':
                return false;
            break;
            default:
                return parent::getErrorFlashMessage();
            break;
        }
    }

    /**
     * Return all available tags
     *
     * @return array: tags
     */
    protected function getTags() {
        $tags = [];
        foreach($this->snippetRepository->findAll() as $snippet) {
            if($snippet->getTags()) {
                foreach(t3lib_div::trimExplode(',', $snippet->getTags()) as $tag) {
                    $tags[] = $tag;
                }
            }
        }
        $tags = array_unique($tags);
        natcasesort($tags);
        return $tags;
    }

    /**
     * Highlight code with GeSHi
     *
     * @param string $code: Code to highlight
     * @param string $language: Type of code, e.g. "php", "typoscript", "html4strict", ...
     */
    protected function codeGeshi($code, $language) {
        require_once(t3lib_extMgm::siteRelPath('geshilib') . 'res/geshi.php');
        $geshi = new GeSHi($code, $language, '');
        $geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
        $geshi->enable_classes(true);
        $geshi->set_overall_id($this->settings['codeGeshiId']);
        $GLOBALS['TSFE']->additionalCSS[$this->request->getControllerExtensionKey() . '_geshiCss'] = $geshi->get_stylesheet();
        return $geshi->parse_code();
    }

}