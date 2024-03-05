
# Routing Basics

The routing system in the Zenith framework is inspired by Next.js and integrates seamlessly with PHP applications. This guide delves into setting up routes and leveraging dynamic segments, along with advanced features like reactive and lazy loading.

## Creating Routes

Routes are the backbone of web applications, allowing you to map URLs to specific content or functionality. To add a new route:

```shell
composer add-route /example-route
```

This command creates necessary files under the `routes/` directory. For instance, adding a route `/about-me` creates `route/about-me/page.php`, making it accessible via `https://localhost:8080/about-me`.

## Directory Structure for Routes

- `routes/`: Contains subdirectories or PHP files for each defined route. Each route can have a combination of page and layout components to structure the content and presentation.

## Using Dynamic Segments in Routes

Dynamic segments in routes enable parameterization, allowing for more flexible URL schemes. To create a route with a dynamic segment:

1. Add a route with a dynamic placeholder:
   ```shell
   composer add-route /users/{id}
   ```

2. Access the dynamic param in your PHP script:
   ```php
   return function(array $params) {
       yield "User with id: " + $params['id'];
   };
   ```

## Reactive Pages and Layouts

The `#[Reactive]` attribute makes pages and layouts reactive, enabling AJAX-like behavior for links and forms, reducing full page reloads:

```php
return #[\Compass\Reactive] function(array $params) {
    yield "User with id: " + $params['id'];
    yield new \Zenith\Components\Link(new \Zenith\Plugin\Url('/user-history/{id}', ['id' => $params['id']]), 'Users history');
};
```

Using this attribute, the application can provide a smoother user experience similar to a single-page application (SPA).

## Lazy Pages and Layouts

The `#[Lazy]` attribute delays the rendering of a page or layout until necessary, which is particularly useful for optimizing load times on resource-intensive components.

```php
return #[\Compass\Lazy] function(array $params) {
    yield "User with id: " + $params['id'];
    sleep(5); // Simulating a delay
    yield "Result of a very slow data source.";
};
```

This approach allows for the rest of the web page to render and become interactive while waiting for specific components to load, enhancing the perceived performance.

---
