# Instagram Page Tags

This laravel project allows a user to connet their Instagram business account and pull public instagram posts which other instagram users have tagged the connected business Instagram Account. This is done using the Instagram Graph API v3.2.

This project demonstrates how to request data access permissions via Oauth2, get access tokens and how these tokens are used to call other graph API endpoints.

# Setting up the environment

1. Download the source code
2. Find the sql file in the database folder and add it to your phpmyadmin
3. Rename the .env-dev file as .env
4. Add your application URL for APP_URL in the .env file
5. Run command npm install to install the node modueles
6. Run composer update to install dependancies 
7. Run php artisan config:cache command to clear off the caches

# Connecting Facebook application with the website 

1. Once you have deployed this laravel application, access it in your browser. The initial page is a blank page
2. Access the admin login via {{ Your website URL }}/login
3. Key in 'info@nilaksha.com' as username and 'password' as the password at the login form.
4. Find the settings button under the profile menu
5. Key in your facebook application ID and Secret in relevant fields
6. Key in '/account/callback' followed by your hosted application URL. Note these settings should be available in your facebook            application.
7. Hit on save to save the settings

# Pulling Instagram Posts from your Instagram Business account 

1. Naigate to accounts page by clicking on "Set Account" menu item.
2. Click on Add Accounts. This will redirect you to your facebook login. You may grant permission to read data by selecting a Facebook     page that has a Instagram Business account linked to. Once you submit this, it will redirect you back to the applicaton with a          select box with options to select the pages you have granted the permissions. 
3. Select the page with Inststagram business account linked with and click on add.
4. If successfull, it will show the account with instagram business ID filled in the table.
5. Click on "Instagram Feed" button to navigate to the dashboard section.
6. Select an account from the list in the dropdown and click on "Pull Instagram Posts" button.
7. If things go right, it will populate posts on Instagram Page Posts section. This data will be populated in the temp_posts table
8. Select the Instagram posts you need and click on the + button on the top of the section. This will move the selected posts to           Instagram Selected Posts section and these posts will be displayed on the main page.

