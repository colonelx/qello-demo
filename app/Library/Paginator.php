<?php

namespace QKidsDemo\Library;

class Paginator
{
    protected $currentPage;
    protected $totalResources;
    protected $perPage;
    protected $currentPageOffset;

    public function __construct($currentPage, $totalResources, $perPage, $currentPageOffset = 5 )
    {
        $this->currentPage = $currentPage;
        $this->totalResources = $totalResources;
        $this->perPage = $perPage;
        $this->currentPageOffset = $currentPageOffset;
    }

    public function getRequestOffset()
    {
        return ($this->currentPage-1) * $this->perPage;
    }

    public function getMaxPages()
    {
        return ceil($this->totalResources / $this->perPage );
    }

    /**
     * This could be written way better, but for the sake of this demo I will just use arrays.
     */
    public function getPaginationLinks()
    {
        $links = [];
        if ($this->currentPage !== 1) {
            $links[] = ['link_suffix' => '1', 'name' => 'First Page', 'active' => false];
        }

        if($this->currentPage > 1) {
            $prev_start = $this->currentPage - 1;
            $min_prev_page = $this->currentPage - $this->currentPageOffset;

            if ($min_prev_page < 1) $min_prev_page = 1;

            for ($prev_page = $min_prev_page; $prev_page <= $prev_start; $prev_page++)
                $links[] = ['link_suffix' => $prev_page, 'name' => $prev_page, 'active' => false];
        }

        $links[] = [
            'link_suffix' => $this->currentPage,
            'name' => $this->currentPage,
            'active' => true
        ];

        if($this->currentPage < $this->getMaxPages()) {
            $next_start = $this->currentPage + 1;
            $max_next_page = $this->currentPage + $this->currentPageOffset;

            if ($max_next_page > $this->getMaxPages()) $max_next_page = $this->getMaxPages();

            for ($next_page = $next_start; $next_page <= $max_next_page; $next_page++)
                $links[] = ['link_suffix' => $next_page, 'name' => $next_page, 'active' => false];
        }

        if ($this->currentPage !== $this->getMaxPages()) {
            $links[] = ['link_suffix' => $this->getMaxPages(), 'name' => 'Last Page', 'active' => false];
        }

        return $links;
    }

}