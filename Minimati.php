<?php

    /*
     * Minimati - Lightweight and Open-Source Blogging CMS
     * Written by Kidus Bewket (https://kidus.ca)
     * Released under the MIT License
     */
        
    /**
     * Article
     * Contains details of a single blog article
     */
    class Article
    {
        public $ID;
        public $slug;
        public $title;
        public $subtitle;
        public $content;
        public $photo;
        public $timestamp;
    }

    # General Functions

    function sql_query($query) {
        $sql = new mysqli("localhost", "root", "", "");
    }

    /**
     * slugify
     * Generates a clean URL slug from a string
     * @param mixed $text
     * @return void
     */
    function slugify($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            // Fallback in case user enters non-ASCII characters
            // generates pseudo-random slug
            return "post-".(rand() % 9999);
        }

        return $text;
    }
    
    /**
     * redir
     * A cleaner redirect? Perhaps.
     * @param  mixed $url
     * @return void
     */
    function redir($url) {
        header("Location: $url");
    }

?>