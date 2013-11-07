# Example of an installed resource

Clone it in `/installed` and add it as a definition.

* `\Request` Is the Laravel request object that can be used to read query parameters for example
* Use `\App::abort(code, message)` to throw errors to users:

```php
\App::abort(400, "This is an error message.");
```

* [Buzz](https://github.com/kriswallsmith/Buzz) is available to make requests to other API's
