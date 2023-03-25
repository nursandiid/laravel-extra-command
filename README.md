# Laravel Extra Command
Laravel extra command is a collection of a few php commands is not available from default Laravel. You can use it to create a Repository and Interface for now, But maybe in future after updated you can add more additional commands not only that.

## Installation
For installation you can add manually the syntax because the repository not available in packagist yet. Add the following to your composer.json require-dev section.

```json
"require-dev": {
    "sandinur157/laravel-extra-command": "@dev"
}
```

And you must to add the repository github to your composer.json.
```json
"repositories": [
      {
          "type": "vcs",
          "url": "https://github.com/sandinur157/laravel-extra-command"
      }
  ]
```

## Artisan Command List
1. Make Repository
2. Make Interface

## Example
Create a repository class
```bash
php artisan make:repository TestRepository
```

Create an interface class
```bash
php artisan make:interface TestRepositoryInterface
```