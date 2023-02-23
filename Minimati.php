<?php

    /*
     * Minimati - Lightweight and Open-Source Blogging CMS
     * Written by Kidus Bewket (https://kidus.ca)
     * Released under the MIT License
     */

    # EDIT THESE VALUES TO CONNECT MINIMATI TO YOUR DATABASE! #
    
    const DB_HOST = "localhost"; // Database Host
    const DB_USER = "root"; // Database Username
    const DB_PASS = ""; // Database Password
    const DB_NAME = "minimati"; // Database Name
        
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
    
    /**
     * sql_query
     * Performs a MySQL Query and returns the result in form of a MySQLi object
     * @param  mixed $query
     * @return void
     */
    function sql_query($query) {
        $sql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if(!$sql) throw new Exception("Minimati - Failed to connect to database.");
       
        $result = $sql->query($query);
        $sql->close();
        return $result;
        
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
     * @param  string $url
     * @return void
     */
    function redir($url) {
        header("Location: $url");
    }

    # Blogging and Publishing
    
    /**
     * publish
     * Adds blog article to database
     * @param  Article $article
     * @return void
     */
    function publish($article) {
        //...
    }
    
    /**
     * delete
     * Deletes article from database
     * @param  int $articleID
     * @return void
     */
    function delete($articleID) {
        //...
    }
    
    /**
     * fetch_articles
     * Fetch all articles from $start to $limit
     * @param  int $start
     * @param  int $limit
     * @return void
     */
    function fetch_articles($start, $limit) {
        //...
    }
    
    /**
     * fetch_article
     * Fetch the details of a particular article
     * @param  string $slug
     * @return void
     */
    function fetch_article($slug) {
        //...
    }
    
    /**
     * article_count
     * Returns the number of articles in the database
     * @return void
     */
    function article_count() {
        //...
    }
    
    /**
     * edit_count
     * Returns the number of edits made so far
     * @return void
     */
    function edit_count() {
        //...
    }

    # Administrator Management

    function admin_login($password) {
        $result = sql_query("SELECT * FROM `admin` WHERE 1");
        if(password_verify($password, $result->fetch_assoc()['pwd_hash'])) {
            return true;
        } else {
            return false;
        }
    }

?>