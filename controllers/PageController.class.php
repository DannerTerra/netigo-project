<?php

require_once './XMLStructure.class.php';

class PageController {

    private $arrayStructure;
    private $html;
    private $path;
    private $pageContent;
    private $breadcrumb;

    public function __construct($xmlFilename) {
        $xmlStructure = new XMLStructure($xmlFilename);
        $this->arrayStructure = $xmlStructure->getPageXMLArray();
        $this->getNavbar();
    }

    public function getNavbar() {
        $this->html = '<ul class="navbar-nav me-auto mb-2 mb-md-0">';
        foreach($this->arrayStructure->page as $page) {


                 $this->html .= $this->getNavItem($page);

            $this->removePath($page);
        }
        $this->html .= '</ul>';
        return $this->html;
    }

    private function getNavItem($page) {

        $path = $this->addPath($page);
        $this->storeContent($page->title, $path, $page->content);
        $this->html .= '<li class="nav-item dropdown">
                    <a href="' . $path . '" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">'
                        . $page->title . 
                    '</a>';

        $this->html .= $this->getDropdownItems($page);
        $this->removePath($page);
        $this->html .= '</li>';
    }


    private function getDropdownItems($page) {
        if(!isset($page->subpages)) return '';

        $subPages = $page->subpages;
        $this->html .= '<ul class="dropdown-menu">';

        foreach($subPages->page as $subPage) {
            $path = $this->addPath($subPage);
            $this->storeContent($subPage->title, $path, $subPage->content);
            $this->html .=    '<li>
                            <a class="dropdown-item" href="'  . $path . '">'
                                . $subPage->title .
                            '</a>';
            $this->html .= $this->getNestedUl($subPage);
            $this->removePath($page);
        }
        $this->html .= '</li></ul>';
    }

    private function getNestedUl($page) {
        if(!isset($page->subpages)) return '';

        $subPages = $page->subpages;
        $this->html .= '<ul>';

        foreach($subPages->page as $subPage) {
            $path = $this->addPath($subPage);
            $this->storeContent($subPage->title, $path, $subPage->content);
            $this->html .=    '<li>
                            <a class="dropdown-item" href="' . $path .'">'
                                . $subPage->title .
                            '</a>';
            $this->html .= $this->getNestedUl($subPage);
            $this->removePath($page);
        }
        $this->html .= '</li></ul>';
    }

    function addPath($page) {
        $this->path .= '/' . $page->slug;
        return $this->path;
    }

    function removePath($page) {
        $pages = explode('/',$this->path);
        array_splice($pages,-1);
        $this->path = implode('/',$pages);
    }

	function getArrayStructure() { 
 		return $this->arrayStructure; 
	} 

    function storeContent($title, $path, $content) {
        $this->pageContent[str_replace("/","",$path)] = [
            'title' => $title,
            'content' => $content,
        ];
    }

    function getContent($path) { 
        if(empty($path)) {
            return $this->pageContent["home"];
        }
        return $this->pageContent[$path];
    }

    function getBreadcrumb($path){
        if($path == '/')
            return [['path' => 'home', 'title' => 'Home']];

        $pages = explode('/',$path);
        array_shift($pages);

        $paths = $pages;
        $pathAux = "";

        foreach($pages as $pag) {
            $this->breadcrumb[] = [
                'path' => $pathAux .= '/' .$pag,
                'title' => str_replace('-', ' ',ucwords($pag))
            ];
            array_shift($paths);
        }
        return $this->breadcrumb;
    }
}