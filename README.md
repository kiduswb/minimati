# Minimati

Minimati is a simple, lightweight and open-source CMS for managing blog posts in your website. It's written in 
PHP and uses a MySQL backend, so your site must use these two for its backend. Minimati is best
for static websites that want to add simple blogging functionality without the need to write a custom
CMS or use something like WordPress.

# Setup Guide

Here's a simple step-by-step guide to get Minimati up and running on top of your website.

<ol>
    <li>Move Minimati's root folder to your website's root folder. You can also clone this repository into your website's root directory</li>
    <li>Import the `db.sql` file into your MySQL database</li>
    <li>Head over to `[your root folder]/minimati`</li>
    <li>Login (default admin password is "`password`"), then change your password.</li>
</ol>

After these steps, you can begin publishing articles on your website's server. To show these articles
you'll need to require `Minimati.php` located in the root directory.<br>

`Minimati.php` has the following classes and functions that you can use to easily fetch articles you've published
on your website:

- `fetch_articles(min, max)`: Fetch articles from page min to max. Articles are sorted by time published.
- `fetch_article(slug)`: Fetch article details in form of a neat `Article` class.