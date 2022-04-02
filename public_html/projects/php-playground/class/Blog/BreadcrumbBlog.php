<?php

class BreadcrumbBlog {

    public const PROJECT_ROOT = DIRECTORY_SEPARATOR . 'projects' . DIRECTORY_SEPARATOR . 'php-playground' . DIRECTORY_SEPARATOR;

    private const LAST_PART_LENGTH = 30; // Letters
    private const DELIMITER = '>';

    public function __construct(string $root_step_title, array $middle_steps, string $current_page_title) {
        $this->root_step_title = $root_step_title;
        $this->middle_steps = $middle_steps;
        $this->current_page_title = $current_page_title;
    }
    public function show_breadcrumb()
    {
        $root_folder = self::PROJECT_ROOT . strtolower($this->root_step_title);
        $root_step = '<a href="' . $root_folder . '">' . $this->root_step_title . '</a> ' . self::DELIMITER . ' ';
        $middle_steps = '';
        foreach ($this->middle_steps as $bc_title => $bc_link) {
            $middle_steps .= '<a href="' . $root_folder . DIRECTORY_SEPARATOR . $bc_link . '">' . $bc_title . '</a> ' . self::DELIMITER . ' ';
        }
        $last_step = $this->get_bc_exerpt();
        return $root_step . $middle_steps . $last_step ;
    }
    
    private function get_bc_exerpt()
    {
        if(strlen($this->current_page_title) > 30) {
            $exerpt = wordwrap($this->current_page_title, self::LAST_PART_LENGTH, '__break__');
            $array = explode('__break__', $exerpt);
            return ucfirst($array[0]) . ' ...';
        } else {
            return $this->current_page_title;
        }
    }

}