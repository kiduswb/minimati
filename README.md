<img src="assets/img/icon.png" width="60px" height="60px">

# Minimati 

Minimati is a simple, lightweight and open-source CMS for managing blog posts in your website. It's written in 
PHP and uses a MySQL backend, so your site must use these two for its backend. Minimati is best
for static websites that want to add simple blogging functionality without the need to write a custom
CMS or use something like WordPress. If you're a web developer working on static websites for your clients,
this framework is perfect for you.

# Setup Guide

Here's a simple step-by-step guide to get Minimati up and running on top of your website.

<ol>
    <li>Move Minimati's root folder to your website's root folder&mdash;you can also clone this repository into your website's root directory</li>
    <li>Import the <code>db.sql</code> file into your MySQL database</li>
    <li>Edit the <code>Minimati.php</code> file and add your database login info</li>
    <li>Navigate to <code>[your website]/minimati</code> in your browser</li>
    <li>Login (default admin password is "password"), then change your password</li>
    <li><b>IMPORTANT!</b> Make sure to edit your admin settings and specify which directory you'd like to upload
    article photos to. By default, the directory is <code>'../assets/images/blog/'</code>.</li>
</ol>

After these steps, you can begin publishing blog articles to your website's server. To display 
these articles, you'll need to refer to the simple example I've built for you in the 'example' directory
of this repo.<br>

# Usage Guide

`Minimati.php` has the following two functions that you can use to fetch the articles you've published on your website:

- `fetch_article($slug)`: Fetch article details in form of a neat `Article` class. Uses the 'slug' (URL of the article) to fetch article data from the database.
- `fetch_articles($start, $limit)`: Fetch `limit` articles, starting from `start`. Please refer to the 'example' directory to understand how Minimati's pagination system works. Articles are sorted by time published. This function returns array of `Article` objects.

You can get an article's contents from the handy `Article` class. The `Article` class contains the following important members:

- `slug`
- `title`
- `subtitle`
- `content`
- `timestamp`
- `photo`

You use these members to display an individual article's content on your website. Please check out the 
'example' directory to see this in action.
<br>
I've currently implemented this CMS in my personal website. It's been very helpful for my personal use-case.

<b>For a simple example, check out the 'example' directory in this repo.</b>

# FAQ

*Is there any way to measure interaction metrics?* <br>
It would be pointless to add it to Minimati, since you can easily use other tools that don't require a database.

*How do I add comments and replies to my blog?* <br>
I haven't come around to implementing that yet, as it would over-complicate things. For now, check out the easy-to-use service [Disqus](https://disqus.com).

<br>

*Happy blogging!*