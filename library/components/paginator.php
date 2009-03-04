<?php

interface igs_Paginator extends ArrayAccess, Countable, Iterator
{
    /**
     * @param integer $totalItems
     * @param integer $perPage
     * @param integer $currentPage    OPTIONAL
     * @param mixed   $scrollingStyle OPTIONAL
     */
    public function __construct($totalItems, $perPage, $currentPage = 1, $scrollingStyle = null);

    /**
     * @return boolean
     */
    public function isCurrentPage();

    /**
     * @return boolean
     */
    public function isFirstPage();

    /**
     * @return boolean
     */
    public function isLastPage();
}
