# BStore

Resides in:
http://bstore.herokuapp.com/

# CSV import file

For CSV import you should use a file like:

```
Title, Author
Difference Engine, William Gibson
The Blind Watchmaker, Richard Dawkins
Physics of the Future, Michio Kaku
```

# Running locally

For running it locally remove the below code block

```
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);
```

and replace

```
'host'      => $host,
'database'  => $database,
'username'  => $username,
'password'  => $password,
```

with

```
'host'      => env('DB_HOST', 'localhost'),
'database'  => env('DB_DATABASE', 'forge'),
'username'  => env('DB_USERNAME', 'forge'),
'password'  => env('DB_PASSWORD', ''),
```

and change your `.env` db adapter settings in prior to your installation.
