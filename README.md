# currency-calculator

		Currency Calcylator -  Readme file
For the needs of our project, we used PHP framework, Symfony 4 and we were programming mostly in PHP and  JavaScript.
Also we used CSS and Bootstrap for stylesheet and twig template engine for our pages.

First of all we built ourController.php for rendering the pages and get used it as our server. After we set the requirements we needed,
we created our routes: Home (for home page), login (for login page), admin (for administrator page) and delete 
(for deleting the currencies from administrator page).

On home page (templates/pages/index.html.twig) we have a form where there are the options of base currency,
amount (if it is empty, a prompt message shows up and reloads the page) and exchange.
After user gives his options and click the calculation button, a JavaScript function make the calculation and send the proper message
on the screen.

On administrator page (templates/pages/admin.html.twig) we have access after log in authentication (templates/pages/login.html.twig),
the administrator has the ability to add and delete a currency for the home page. The currency must be validated.

Furthermore we created a JavaScript file (public/index.js) with a function which makes the calculation of currencies after getting APIs
for them and sends the proper message to home page and also a callback function which deletes from the database and by extension from the
screen, the currencies from administrator page.

Finally, for our database we created an Entity with the use of Composer (src/Enity/Currency.php).
Composer also helped us for the annotations, form creation (for administrator page), validator and authentication
(creation of config/security.yaml where you can find username (administrator) and password for login page).
