## Test Your Laravel Routing Skills

This repository is a test for you: fill in `routes/web.php` and `routes/api.php` which are left intentionally empty.

In both of those files, you will find comments, describing 12 tasks. For majority of the tasks, you need to write ONE line of code.

Example:

```
// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
// Put one code line here below
```

To test if all the routes work correctly, there are PHPUnit tests in `tests/Feature/RoutesTest.php` file.

In the very beginning, if you run `php artisan test`, or `vendor/bin/phpunit`, all 8 tests fail.
Your task is to make those tests pass.


## How to Submit Your Solution

If you want to submit your solution, you should make a Pull Request to the `main` branch.
It will automatically run the tests via Github Actions and will show you/me if the test pass.

If you don't know how to make a Pull Request, [here's my video with instructions](https://www.youtube.com/watch?v=vEcT6JIFji0).

This task is mostly self-served, so I'm not planning review or merge the Pull Requests. This test is for yourselves to assess your skills, the automated tests will be your answer if you passed the test :)


## Questions / Problems?

If you're struggling with some of the tasks, or you have suggestions how to improve the task, create a Github Issue.

Good luck!

## How to install 

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__ (if anyone got problems with composer on windows, try running it like this:  __composer install --ignore-platform-reqs__)
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (it has some seeded data for your testing)
- That's it: launch the main URL and enjoy.