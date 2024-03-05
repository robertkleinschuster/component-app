
# Routing Pages

The Zenith framework uses a routing system that integrates pages as a key element in serving content to users. This guide will delve into the role of pages within the framework's routing system, how to define and create them, and their interaction with layouts and the routing mechanism.

## Understanding Pages

In the context of routing, pages represent the content displayed for specific routes within the application. Each page is associated with a route and contains the HTML, PHP, or other server-generated content that is rendered when that route is accessed.

## Creating Pages

Pages are created within the `routes/` directory, corresponding to their URL paths. For example, to create a homepage, you would define a `page.php` file at the root of `routes/`:

**Example: Creating a Homepage**
```shell
composer add-route /
# This action creates a page.php in the routes/ directory for the homepage.
```

## Structure of a Page

A page can be as simple as a PHP function that generates content. It receives several parameters from the routing system, enabling dynamic content generation based on route parameters, query parameters, and the current request and response objects.

### Parameters Passed to a Page Component:
- `array $params`: Route parameters from dynamic segments.
- `array $queryParams`: URL query parameters.
- `string $uri`: The complete URI of the currently visited page.
- `Route $route`: The matched route object.
- `ServerRequestInterface $request`: Current request object.
- `ResponseInterface $response`: Current response object where the rendered body will be written to.

## Implementing Dynamic Content

Pages can dynamically adjust their content based on parameters passed by the routing system:

```php
# In route/about-me/page.php
return function($params, $queryParams, $uri, $route, $request, $response) {
    yield new \Mosaic\Fragment("<h1>About Me</h1>");
    yield new \Mosaic\Fragment("<p>Welcome to my personal page. Here are some details about me.</p>");
    // Use $params or $queryParams for dynamic content
};
```

## Interaction with Layouts

Pages can be wrapped within layout components to achieve a consistent look across different routes. The layout acts as a skeleton for the page content, enabling a separation of concerns between content and presentation.

## Using Attributes for Enhanced Behavior

Pages can also utilize attributes like `#[Reactive]` for AJAX-like behavior without full page reloads and `#[Lazy]` for deferred loading, optimizing performance and user experience.

---

Pages are the cornerstone of content delivery within the Zenith's routing system. By effectively leveraging pages and their capabilities, developers can create rich, dynamic, and interactive web applications.
