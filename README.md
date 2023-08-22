## Introduction

Laravel security questions helps you easily integration security question facility for your project

## Installation

```
composer require bluecloud/laravel-security-question
```

## Migrate Tables

Run the following command to create tables to enable saving security questions

```
php artisan migrate
```

## Publish Config

The package allows you to publish a config file to change settings for the package. Run the command below and
select ```Bluecloud\SecurityQuestionHelpers\SecurityQuestionHelpersProvider```. A configuration file will be created
at ```config/questions.php```

```
php artisan vendor:publish
```

## Load Questions

Run the following command

```
php artisan questions:migrate
```

## Adding Trait to User

Add the ```HasSecurityQuestions``` trait to your ```App\Models\User``` model as indicated below.

```php
use Bluecloud\SecurityQuestionHelpers\HasSecurityQuestions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasSecurityQuestions;
}
```

## Add Question(s) for User

To add question(s) for a user, add the code below

```php
$user = auth()->user();
$user->save_questions([
    ["security_question_id" => 1, "answer" => "Blantyre, Malawi"]
]);
```

## Checking Question Answer

To check a user's submitted answer against the saved answers, add the code below

```php
 $question = SecurityQuestion::find(1);
 $check = $user->check_answer($question, "Blantyre, Malawi");
```

**Note**: The questions will **sync**. If the question was already attached for the user, the new answer will update the
existing record

## Routes

To manage question, you can make use of preconfigured api endpoints

### 1. List Security Question

```
GET /security-questions
```

### 2. Create Security Question

```
POST /security-questions

{
    "name": "Sample security question"
}
```

### 3. Delete Security Question

```
DELETE /security-question/{id}
```

## Configuration

Change package settings

### 1. Default Questions

Navigate to ```config/questions.php``` and find default security questions. You may change if you please.

```php
<?php

return [
    "seeds": []
]
```

### 2. Strict Mode

By default, the package turns ```strict mode``` off. When strict mode is off, the package ignores case for the answers
and removes all whitespaces and special characters to ease the matching of user submitted answers. If you want the
answers to match exact case and whitespace, turn ```strict mode``` on in ```config/questions.php```

```php
'strict' => true,
```

### 3. Middleware

To protect ```/security-questions``` routes, and middleware in ```config/questions.php```. For example to
add ```auth:sanctum``` for authentication:

```php
'middleware' => ["auth:sanctum"]
```

### Base Routes Path

To change the base routes path for ```/security-questions``` for example in ```config/questions.php``` change the
following line

```php
'path' => 'api/questions',
```

## License

Laravel Sanctum is open-sourced software licensed under the [MIT license](LICENSE.md).
