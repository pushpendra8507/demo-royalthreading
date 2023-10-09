<?php

class PaginateIt {

    var $currentPage, $itemCount, $itemsPerPage, $linksHref, $linksToDisplay;
    var $pageJumpBack, $pageJumpNext, $pageSeparator;
    var $queryString, $queryStringVar;

    function SetCurrentPage($reqCurrentPage) {
        global $pdo;
        $this->currentPage = (integer) abs($reqCurrentPage);
    }

    function SetItemCount($reqItemCount) {
        global $pdo;
        $this->itemCount = (integer)abs($reqItemCount);
    }

    function SetItemsPerPage($reqItemsPerPage) {
        global $pdo;
        $this->itemsPerPage = (integer) abs($reqItemsPerPage);
    }

    function SetLinksHref($reqLinksHref) {
        global $pdo;
        $this->linksHref = $reqLinksHref;
    }

    function SetLinksFormat($reqPageJumpBack, $reqPageSeparator,
            $reqPageJumpNext) {
        global $pdo;
        $this->pageJumpBack = $reqPageJumpBack;
        $this->pageSeparator = $reqPageSeparator;
        $this->pageJumpNext = $reqPageJumpNext;
    }

    function SetLinksToDisplay($reqLinksToDisplay) {
        global $pdo;
        $this->linksToDisplay = (integer) abs($reqLinksToDisplay);
    }

    function SetQueryStringVar($reqQueryStringVar) {
        global $pdo;
        $this->queryStringVar = $reqQueryStringVar;
    }

    function SetQueryString($reqQueryString) {
        global $pdo;
        $this->queryString = $reqQueryString;
    }

    function GetCurrentCollection($reqCollection) {
        global $pdo;
        if ($this->currentPage < 1) {
            $start = 0;
        } elseif ($this->currentPage > $this->GetPageCount()) {
            $start = $this->GetPageCount() * $this->itemsPerPage - $this->itemsPerPage;
        } else {
            $start = $this->currentPage * $this->itemsPerPage - $this->itemsPerPage;
        }

        return array_slice($reqCollection, $start, $this->itemsPerPage);
    }

    function GetPageCount() {
        global $pdo;
        return (integer) ceil($this->itemCount / $this->itemsPerPage);
    }

    function GetPageLinks() {
        global $pdo;
        $strLinks = '';
        $pageCount = $this->GetPageCount();
        $queryString = $this->GetQueryString();
        $linksPad = floor($this->linksToDisplay / 2);

        if ($this->linksToDisplay == -1) {
            $this->linksToDisplay = $pageCount;
        }
        if ($pageCount == 0) {
            $strLinks = '1';
        } elseif ($this->currentPage - 1 <= $linksPad || ($pageCount - $this->linksToDisplay
                + 1 == 0) || $this->linksToDisplay > $pageCount) {
            $start = 1;
        } elseif ($pageCount - $this->currentPage <= $linksPad) {
            $start = $pageCount - $this->linksToDisplay + 1;
        } else {
            $start = $this->currentPage - $linksPad;
        }
        if (isset($start)) {
            if ($start > 1) {
                if (!empty($this->pageJumpBack)) {
                    $pageNum = $start - $this->linksToDisplay + $linksPad;
                    if ($pageNum < 1) {
                        $pageNum = 1;
                    }

                    $strLinks .= '<span class="pagenos" style="margin: 7px;background: #3c8dbc;;;padding: 5px;"><a href="' . $this->linksHref . $queryString . $pageNum . '" style="color: #fff;">';
                    $strLinks .= $this->pageJumpBack . '</a></span>' . $this->pageSeparator;
                }

                $strLinks .= '<span class="pagenos" style="margin: 7px;background: #3c8dbc;;;padding: 5px;"><a href="' . $this->linksHref . $queryString . '1" style="color: #fff;">1</a></span><span class="disabled">.....</span>' . $this->pageSeparator;
            }


            if ($start + $this->linksToDisplay > $pageCount) {
                $end = $pageCount;
            } else {
                $end = $start + $this->linksToDisplay - 1;
            }


            for ($i = $start; $i <= $end; $i ++) {
                if ($i != $this->currentPage) {

                    $strLinks .= '<span class="pagenos" style="margin: 7px;background: #3c8dbc;;;padding: 5px;"><a href="' . $this->linksHref . $queryString . ($i) . '" style="color: #fff;">';
                    $strLinks .= ($i) . '</a></span>' . $this->pageSeparator;
                } else {
                    $strLinks .= '<span class="current" style="padding: 5px;

                    background: #06067e; color: #fff">' . $i . '</span>' . $this->pageSeparator;
                }
            }
            $strLinks = substr($strLinks, 0, -strlen($this->pageSeparator));


            if ($start + $this->linksToDisplay - 1 < $pageCount) {
                $strLinks .= $this->pageSeparator . '<span class="disabled">.....</span><span class="pagenos"><a href="' . $this->linksHref . $queryString . $pageCount . '" style="color: #fff;">';
                $strLinks .= $pageCount . '</a></span>' . $this->pageSeparator;

                if (!empty($this->pageJumpNext)) {
                    $pageNum = $start + $this->linksToDisplay + $linksPad;
                    if ($pageNum > $pageCount) {
                        $pageNum = $pageCount;
                    }
                    $strLinks .= '<span class="pagenos" style="margin: 7px;background: #3c8dbc;;;padding: 5px;"><a href="' . $this->linksHref . $queryString . $pageNum . '" style="color: #fff;">';
                    $strLinks .= $this->pageJumpNext . '</a></span>';
                }
            }
        }


        return $strLinks;
    }

    function GetQueryString() {
        global $pdo;
        $pattern = array('/' . $this->queryStringVar . '=[^&]*&?/', '/&$/');
        $replace = array('', '');
        $queryString = preg_replace($pattern, $replace, $this->queryString);
        $queryString = str_replace('&', '&amp;', $queryString);

        if (!empty($queryString)) {
            $queryString .= '&amp;';
        }

        return '?' . $queryString . $this->queryStringVar . '=';
    }

    function GetSqlLimit() {
        global $pdo;
        return ' LIMIT ' . ($this->currentPage * $this->itemsPerPage - $this->itemsPerPage) . ', ' . $this->itemsPerPage;
    }

    function topDisplystring($result_page, $total_result) {
        global $pdo;
        $to_subtract = $this->itemsPerPage - $result_page;
        if ($this->currentPage < 1) {
            $from = "1";
            $to = 1 * $this->itemsPerPage - $to_subtract;
        } else {
            $from = ($this->currentPage - 1) * $this->itemsPerPage + 1;
            $to = $this->currentPage * $this->itemsPerPage - $to_subtract;
        }
        return "Displaying " . $from . " - " . $to . " of " . $total_result . " results.";
    }

    function PaginateIt() {
        global $pdo;
        $this->SetCurrentPage(1);
        $this->SetItemsPerPage(10);
        $this->SetItemCount(0);
        $this->SetLinksFormat('&laquo; Previous', ' &bull; ', 'Next &raquo;');
        $this->SetLinksHref($_SERVER['PHP_SELF']);
        $this->SetLinksToDisplay(10);
        $this->SetQueryStringVar('page');
        $this->SetQueryString($_SERVER['QUERY_STRING']);

        if (isset($_GET[$this->queryStringVar]) && is_numeric($_GET[$this->queryStringVar])) {
            $this->SetCurrentPage($_GET[$this->queryStringVar]);
        }
    }

}

$PaginateIt = new PaginateIt();
?>