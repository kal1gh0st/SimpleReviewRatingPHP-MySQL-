# SimpleReviewRatingPHP-MySQL-
![immagine](https://user-images.githubusercontent.com/56889513/117020701-fb1f5900-acf6-11eb-8b5d-031657066238.png)

I have included a zip file with all the source code
QUICK NOTES
Create a database and import the 1-database.sql file.
Change the database settings in 2-core.php to your own.
Launch 3a-products.php in your browser.
If you spot a bug, please feel free to comment below

STAR RATING TABLE
database.sql
Field	Description
product_id	Partial primary key and foreign key. The product that is being rated, or you can change this to an article ID… Or whatever that you are rating.
user_id	Partial primary key and foreign key. The user ID of the rating.
rating	The number of stars given.
Yes, 3 fields are all we need. Feel free to add more fields as your project requires.

PHP STARS RATING CLASS
core.php
This one looks complicated at first, but keep calm and look carefully.

A – The class Stars literally contains all the mechanics to drive the stars rating.
The constructor will automatically connect to the database when a new Stars() object is created, the destructor will close the connection.
There are only 3 functions here – save() adds/updates a star rating entry, get() will fetch all the ratings set by a user, and avg() gets the average ratings for all products.
What this library essentially does, is literally just SQL queries.
B & C – Self-explanatory, the database settings, and creating a stars object. A gentle reminder here to change the database settings to your own again.

PRODUCTS LANDING PAGE
page.php
Oh no, this looks like trouble, but let’s walk through it part-by-part again.
A – The core library shouldn’t need any further introductions, but take note of $uid = 901. We will use a fixed dummy user for the demo, but this should be the user ID in your own system.
B – This part updates the star rating for a product, but it is only processed when the user clicks on a star and updates the rating.
C – Gets the average star ratings for all products, and also for the current user.
D – Generates the HTML for the dummy products, and also the rating stars. The “highlight number of stars on hover” and “update stars rating” part will be done with Javascript.
E – When the user clicks on a star, the hidden product ID and rating fields will be set. The form will be submitted and part B will handle the rating update.

THE CSS
production.css
Just some cosmetics here… Feel free to ignore or adapt in your own project

THE JAVASCRIPT
production.js
The final piece of the puzzle.
Remember the “hover to update the number of stars”? stars.hover() deals with that by simply replacing the src of the images.
On clicking a star, stars.click() will set the selected product ID, rating, and submit the form.
 
MUST USERS BE LOGGED IN?
Yes, it is best to keep the rating system to registered users only. It is otherwise difficult or impossible to identify who is who, it will be total chaos if we allow anyone to rate; It will become a spam magnet quickly. If you really have to open to the public, consider using the PHP session ID as the “unique user key”.

Change database user_id to VARCHAR.
session_start();
Use session_id() as the user_id.
 
STARS RATING FOR SEO
<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "PRODUCT NAME",
  "image": "https://site.com/image.jpg",
  "description": "PRODUCT IMAGE",
  "sku": "IF ANY",
  "mpn": "IF ANY",
  "brand": {
    "@type": "Thing",
    "name": "BRAND NAME"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "reviewCount": "2"
  }
}
</script>
Yes, we can actually add a small JSON-LD product snippet and include the average rating for SEO purposes
