# Hakushi • 白紙

Simple PHP webapp boilerplate with basic routing, sqlite database, user table, and 

## Getting Started

**clone the repo** or **download as a zip**. Once the files are acquired, drop these files onto a server with PHP.

### Running Locally

To get this running locally, you need to make sure the base URL works for your setup and that the DB path is getting generated properly. You might need to experiment a bit to get this right, but this is how I got it working with MAMP. 

**If you clone this directly into your local servers main directory, there's a good chance you won't need to change anything**

In **system/db_connect.php** you'll find the following:

```php
//checks if running locally or on remote server
if(in_array($_SERVER['REMOTE_ADDR'], $localips)){
	//add your projects directory name here...
	$projectdirectory = "allowance";
	$dbrelativepath = "/".$projectdirectory."/system/data/database.sqlite";
}
else{
	$dbrelativepath = $cleanurizero."system/data/database.sqlite";
}
```

Inside my MAMP "HTDOCS" folder, I have a directory called "hakushi" - I need to add this to folder name manually to my path so that PHP can consistently find my DB and generate other base URLS.

### Sqlite

This app currently uses a local SQLITE database. This isn't an issue uploading to a basic server via FTP, but it can be a problem if your server config has permissions against that OR you're using a prod environment like Heroku.

If you want to use Heroku, you'll need a different database solution to get around their [ephemeral filesystem](https://devcenter.heroku.com/articles/sqlite3#disk-backed-storage). They recommend using postgres, however, you will need to make changes to some of the SQL used currently in the app. For example:

- When creating table, you'll need to switch`INTEGER` to `BIGSERIAL` for auto incrementing keys.

**SQLITE** uses `INTEGER` - when set as primary key, it will autoincrement.

```php
$db->exec("CREATE TABLE IF NOT EXISTS content (uid INTEGER PRIMARY KEY, pid INTEGER, sid INTEGER, pos INTEGER, title TEXT, body TEXT)");
```

**POSTGRES** needs `SERIAL` or `BIGSERIAL` in order to auto-increment a value with column set to primary key.

```php
$db->exec("CREATE TABLE IF NOT EXISTS content (uid BIGSERIAL PRIMARY KEY, pid INTEGER, sid INTEGER, pos INTEGER, title TEXT, body TEXT)");
```

- Also, using `lastInsertId()` is a little different.

**SQLITE** uses `lastInsertId()`

```php
$lastuid = $db->lastInsertId();
```

**POSTGRES** is cool with this, but it requires an additional parameter with the following syntax`lastInsertId(content_uid_seq)`

```php
$lastuid = $db->lastInsertId(content_uid_seq);
```

Making these changes, plus properly accessing your postgres DB for local and prod should have you covered.

## Creating Users

Currently, the app is set up to help you create one main user per instance. If no users exist in the `users` table, you'll get a form to create your first user. 

After the first user is added, the app is missing a means of adding additional users. I still need to decide on a user-adding modal that's right for this particular repo in it's current form. You can add users with custom PDO code - running a page with a single insert should do the trick. 

Maybe something like this (load once, then delete or comment out):

```php
$input_email = "email@email.com";
$input_password = "password";
$password_store = password_hash($input_password, PASSWORD_BCRYPT);
$input_fname = "Firsty";
$input_lname = "Lasterson";

$insert = $db->prepare("INSERT INTO users (email, password, fname, lname, stayloggedin) VALUES (?, ?, ?, ?, ?)");
$insertarray = array($input_email, $password_store, $input_fname, $input_lname, 0);
$insert->execute($insertarray); 
```

A table for users is provided in the sqlite database and features the following columns:

- email (TEXT PRIMARY KEY)
- password (TEXT via the `password_hash()` function with `PASSWORD_BCRYPT`)
- fname (first name, TEXT)
- lname (last name, TEXT)
- stayloggedin (BOOL that disables timed session expiration - defaults to 0)

## To-Do

- user creation model (admin-user drive per instance? open signup?)
- notification system for what's changed since last log in
- schedule deductions, schedule multple deposits/deductions per budget
- remove autofocus from modals

## Authors

**Timothy Reeder**

## License

This project is licensed under the MIT License.