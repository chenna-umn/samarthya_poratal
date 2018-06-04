<?php

class Paginator
{
    public $current_page = 1;
    public $num_pages;
    public $return;
    public $mid_range = 7;
    public $items_per_page = 3;
    public $items_total = 0;
    public $data = array();
    
    
    /**
     * the constructer
     */
    public function __construct()
    {
    }
    
    private function paginate($page = 1,$items_total = 0)
    {
        $this->num_pages = ceil($items_total/$this->items_per_page);
        $this->current_page = (isset($page) && $page > 0 && $page <= $this->num_pages) ? (int) $page : 1 ; // must be numeric > 0
        $prev_page = $this->current_page-1;
        $next_page = $this->current_page+1;        
        $this->data['totalRows'] = $items_total;
        $this->data['totalPages'] = $this->num_pages;
        $this->data['results'] = $this->items_total;
        $this->data['previous'] = $prev_page;
        $this->data['current'] = $this->current_page;
        $this->data['next'] =  $next_page;
        $this->data['last'] = $this->num_pages;
        
        if($this->num_pages > 10)
        {
            $this->return = ($this->current_page > 1 && $items_total >= 10) ? "<li><a class=\"paginate\" href=\"?page=$prev_page\">&laquo; Previous</a></li> ":"<span style=\"display:none\" class=\"inactive\" href=\"#\">&laquo; Previous</span> ";
            
            $this->start_range = $this->current_page - floor($this->mid_range/2);
            $this->end_range = $this->current_page + floor($this->mid_range/2);

            if($this->start_range <= 0)
            {
                $this->end_range += abs($this->start_range)+1;
                $this->start_range = 1;
            }
            if($this->end_range > $this->num_pages)
            {
                $this->start_range -= $this->end_range-$this->num_pages;
                $this->end_range = $this->num_pages;
            }
            $this->range = range($this->start_range,$this->end_range);

            for($i=1;$i<$this->num_pages;$i++)
            {
                if($this->range[0] > 2 && $i == $this->range[0]) 
                {
                    $this->data['pages'][] = "<li><a>...</a></li>";
                    $this->return .= "<li><a>...</a></li>";
                }
                if($i==1 || $i==$this->num_pages || in_array($i,$this->range))
                {
                    $this->data['pages'][] =  $i;
                    $this->return .= ($i == $this->current_page) ? "<li class=\"active\"><a title=\"Go to page $i of $this->num_pages\" class=\"current\" href=\"#\">$i</a></li> ":"<li><a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=\"?page=$i\">$i</a></li> ";
                }
                if($this->range[$this->mid_range-1] < $this->num_pages-1 && $i == $this->range[$this->mid_range-1])
                {    
                    $this->data['pages'][] = "<li><a>...</a></li>";
                    $this->return .= "<li><a>...</a></li>";
                }
            }
            $this->return .= (($this->current_page < $this->num_pages && $items_total >= 10) And ($page != 'All') And $this->current_page > 0) ? "<li><a class=\"paginate\" href=\"?page=$next_page\">Next &raquo;</a></li>\n":"<span style=\"display:none\" class=\"inactive\" href=\"#\">&raquo; Next</span>\n";
            
        }
        else
        {
            for($i=1;$i<$this->num_pages;$i++)
            {
                $this->data['pages'][] = $i; 
                $this->return .= ($i == $this->current_page) ? "<li class=\"active\"><a class=\"current\" href=\"#\">$i</a> </li>":"<li><a class=\"paginate\" href=\"?page=$i\">$i</a></li> ";
            }
        }
    }
    /**
     * Returns the string that is the result of the paginator
     */
    public function displayHtmlPages($page = 1,$items_total = 0)
    {
        $this->paginate($page,$items_total);
        return $this->return;
    }
    /**
     * Returns an array paginator data
     */
    public function getPaginateData( $page = 1,$items_total = 0 )
    {
        $this->paginate($page,$items_total);
        return $this->data;
    }
}