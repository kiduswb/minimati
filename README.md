<img src="assets/img/icon.png" width="60px" height="60px">

# Minimati 

Minimati is a simple, lightweight and open-source headless CMS for managing blog posts in your website. It's written in PHP and uses MySQL for its database, so your site must have the ability to utilize these two. Minimati is best for static websites that want to add simple blogging functionality without the need to write a custom
CMS or use third party software. 

<b>If you're a web developer working on simple & static websites for your clients,
this CMS is great for you.</b>

# Setup Guide

Simply clone this repo in the directory you want your Minimati installtion to be stored in. For example:

<code>'[your-website]/minimati'</code>

Afterwards, simply navigate to that directory in your browser to start the installation process. 

<b>Important Note</b>

The default image upload folder is <code>../assets/images/blog</code>. You can change this in the Settings menu after you finish installing Minimati and start using it.

# Usage Guide

Here's some example code to show you how to work with Minimati:

*Loading all articles:*

```php
<?php
    require_once '[your-website]/[installation-dir]/Minimati.php';

    // Fetch an array of Article objects
    // The Article object contains data on a single blog post
    $start = 0; // Starting point for fetching articles, 0 indicates the latest
    $limit = 10; // How many articles do you wanna fetch?
    $search = ""; // A string query to search thru articles
    $articles  = fetch_articles($start, $limit, $search);

    foreach($articles as $ar) {
        // Article Data
        /*
            Article::ID;
            Article::slug;
            Article::title;
            Article::subtitle;
            Article::content;
            Article::photo;
            Article::timestamp;
         */
        //...
    }
?>
```

You can implement pagination yourself by utilizing the `$start` and `$limit` variables.

*Loading a single article:*

```php
<?php
    require_once '[your-website]/[installation-dir]/Minimati.php';

    $ID = 0; // Assign your article's unique identifier number (ID) here
    $article = new Article($ID);
    // ...
?>
```

# FAQ

*Is there any way to measure user metrics?* <br>
Use [Google Analytics](https://analytics.google.com). It's a cumbersome task to implement detailed user analytics,
especially when perfect solutions like Google Analytics exist.

*How do I add comments and replies to my blog?* <br>
I haven't come around to implementing that yet, as it would over-complicate things. For now, check out the easy-to-use service [Disqus](https://disqus.com).

<br>

*Happy blogging!*
