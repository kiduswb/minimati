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
    const DB_NAME = "kidus"; // Database Name
        
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

        function __construct($ID) {
            if($ID !== 0) {
                $result = sql_query("SELECT * FROM `blog` WHERE `ID`=$ID");
                if(!$result) throw new Exception("Invalid ID");
                while($row = $result->fetch_assoc())
                {
                    $this->ID = $row['ID'];
                    $this->slug = $row['slug'];
                    $this->title = $row['title'];
                    $this->subtitle = $row['subtitle'];
                    $this->content = $row['content'];
                    $this->photo = $row['photo'];
                    $this->timestamp = $row['timestamp'];
                }
            }
        }

        function get_date() {
            return date("d M, Y h:i A", $this->timestamp);
        }
    }

    # General Functions #
    
    /**
     * sql_query
     * Performs a MySQL Query and returns the result in form of a MySQLi object
     * @param  mixed $query
     * @return result
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
     * @return slug
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

    # Blogging and Publishing #
    
    /**
     * publish
     * Adds blog article to database
     * @param  Article $article
     * @return void
     */
    function publish($article) {
        $result = sql_query("
            INSERT INTO `blog` VALUES(
                $article->ID,
                '$article->slug',
                '$article->title',
                '$article->subtitle',
                '$article->content',
                $article->timestamp,
                '$article->photo'
            );
        ");

        if($result) return true;
        return false;
    }
    
    /**
     * delete
     * Deletes article from database, retains photo
     * @param  int $articleID
     * @return void
     */
    function delete($articleID) {
        $article = new Article($articleID);
        sql_query("DELETE FROM `blog` WHERE ID=$articleID");
    }
    
    /**
     * full_delete
     * Deletes article from database AND photo from files
     * @param  mixed $articleID
     * @return void
     */
    function full_delete($articleID) {
        $article = new Article($articleID);
        sql_query("DELETE FROM `blog` WHERE ID=$articleID");
        $dir = fetch_upload_dir()."/$articleID";
        array_map("unlink", glob("$dir/*")); 
        array_map("rmdir", glob("$dir/*")); 
        rmdir($dir);
    }
    
    /**
     * fetch_articles
     * Fetch all articles from $start to $limit
     * Supply $query if searching for articles
     * @param  int $start
     * @param  int $limit
     * @param  string $query
     * @return array
     */
    function fetch_articles($start, $limit, $search) {
        $query = "SELECT * FROM `blog`";
        if(!empty($search)) $query .= " WHERE (`title` LIKE '%$search%') OR (`subtitle` LIKE '%$search%') OR (`content` LIKE '%$search%')";
        $query .= " ORDER BY `timestamp` DESC LIMIT $start, $limit";
        $result = sql_query($query);
        $articles = array();
        $i = 0;

        while($row = $result->fetch_assoc()) {
            $articles[$i] = new Article($row['ID']);
            $i++;    
        }

        return $articles;
    }
    
    /**
     * fetch_article
     * Fetch the details of a particular article
     * @param  string $slug
     * @return object Article
     */
    function fetch_article($slug) {
        $result = sql_query("SELECT * FROM `blog` WHERE slug='$slug'");
        if(!$result) return null;
        return new Article($result->fetch_assoc()['ID']);
    }

    /**
     * article_count
     * Returns the number of articles in the database
     * @return int
     */
    function article_count($query = null) {
        $qry_str = "SELECT COUNT(*) AS `count` FROM `blog`";
        if($query != null) $qry_str .= " WHERE (`title` LIKE '%$query%') OR (`subtitle` LIKE '%$query%') OR (`content` LIKE '%$query%')";
        $result = sql_query($qry_str);
        return $result->fetch_assoc()['count'];
    }
    
    /**
     * fetch_upload_dir
     * Gets the current image upload directory
     * @return string
     */
    function fetch_upload_dir() {
        $result = sql_query("SELECT * FROM `admin`");
        return $result->fetch_assoc()['upload_dir'];
    }
    
    /**
     * update_upload_dir
     * Updates the current image upload directory
     * @param  mixed $newdir
     * @return bool
     */
    function update_upload_dir($newdir) {
        $result = sql_query("UPDATE `admin` SET upload_dir='$newdir'");
        if(!$result) return false;
        return true;
    }
    
    /**
     * edit_count
     * Returns the number of edits made so far
     * @return int
     */
    function edit_count() {
        $result = sql_query("SELECT * FROM `admin`");
        return $result->fetch_assoc()['edits'];
    }

    # Administrator Management #
    
    /**
     * admin_login
     * Authenticates admin password
     * @param  string $password
     * @return bool
     */
    function admin_login($password) {
        $result = sql_query("SELECT * FROM `admin` WHERE 1");
        if(password_verify($password, $result->fetch_assoc()['pwd_hash'])) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * change_upload_dir
     * Update the image upload directory
     * @param  mixed $newdir
     * @return void
     */
    function change_upload_dir($newdir) {
        sql_query("UPDATE `admin` SET upload_dir='$newdir'");
    }
    
    /**
     * update_password
     * Update the admin's password
     * @param  mixed $newpassword
     * @return void
     */
    function update_password($newpassword) {
        $newhash = password_hash($newpassword, PASSWORD_DEFAULT);
        sql_query("UPDATE `admin` SET pwd_hash='$newhash'");
    }

?>