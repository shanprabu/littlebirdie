## Installing the application
Clone the application to your local machine and install dependencies using composer

`cd little-birdie`

`composer install` 


Copy the .env.example to .env and change the database connection credentials

Update the environment variable `QUEUE_CONNECTION=database` since we will be using the database to handle job queus

The `injestuser` artisan command is scheduled to run hourly. This needs to be added to the cron with the following command

`crontab -e`

`* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`

The `injestusers` command can be run from the command prompt if it needs to be run manually.

`php artisan injestusers`

## Using the application
Open the URL on a web browser. You are required to register yourself to view user list and details. Please follow the Registration link to sign up for access. After successful registration you can login to your account to view a list of users. The user details can be updated by clicking on the "Edit" action against each user in the list. When changes are made and submitted, the user details are
- Validated
- Stored in the user table and user_details table
- The user details are dispatched to a job to update Reqres.in. This job is added to the queue.

To process the jobs on queue execute the following command from the command prompt

`php artisan queue:work`
