# Pen & Paper v2

My friends had aquired the site [Pen & Paper](https://web.archive.org/web/20110226030702/http://pen-paper.net/) which was not being maintained and was going to be shut down.

The site was getting hacked all the time because the code running it was a mess.

Long story short, we ended up archiving the old site and replaced it with a WordPress blog.

Fast forward to today. We want to do something interesting with the site, take it back to its roots.

The first step is to simply see what data we have and migrate to a modern codebase.

This is that project.

## Follow Along At Home

Right now, if you'd like to see the site in action you can go to [pen-paper.geekity.com](http://pen-paper.geekity.com/) and login with the username "pen-paper" and password "hoopla".

You can run this code locally as well although this isn't officially supported.

These are the basic steps:

1. Clone repo into a folder
2. Point web server at `htdocs` folder
3. Set up MySQL database
4. Copy `config/conn.dist.php` to `config/conn.php`
5. Update `config/conn.php` with MySQL credentials
6. Run `composer install`
7. Hopefully the site works!
