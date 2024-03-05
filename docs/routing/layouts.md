
# Routing Layouts

In the Zenith framework, layouts play a crucial role in the routing system by defining the structure and presentation of content across different routes. This guide explores the concept of layouts within the framework, their integration with routed pages, and how they enhance the application’s modularity and maintainability.

## Understanding Layouts

Layout components are reusable templates that define common structural elements of web pages (e.g., headers, footers, navigation bars) and provide a consistent look and feel across the application. By defining a layout once and using it across multiple routes, you streamline the development process and ensure thematic consistency.

## Creating Layouts

Layouts are typically defined in the `routes/` directory alongside page components. For example, a global layout applicable to all routes can be placed in a `layout.php` file within the `routes/` root. Route-specific layouts can live within their corresponding route subdirectories.

## Using Layouts with Pages

A layout component can wrap around a page component, acting as a parent in the component hierarchy. The layout provides the skeletal framework within which the page content can be inserted.

### Parameters Passed to a Layout Component

Layout components receive several parameters, mirroring those passed to page components, such as:

- `array $params`: Route parameters from dynamic segments.
- `array $queryParams`: URL query parameters.
- `string $uri`: The complete URI of the currently visited page.
- `Route $route`: The matched route object.
- `$children`: The child components of the page (e.g., the content passed from the page component).
- Additional request and response objects.

The `$children` parameter is particularly important as it allows layouts to integrate and display the content of nested page components dynamically.

## Example: Global Layout for All Routes

```php
# In routes/layout.php
return function($params, $queryParams, $uri, $route, $request, $response, $children) {
    // Header and navigation
    yield new \Mosaic\Fragment("<header>My App</header><nav>...</nav>");
    
    // Page content
    yield $children;
    
    // Footer
    yield new \Mosaic\Fragment("<footer>Footer contents</footer>");
};
```

## Reactive and Lazy Layouts

Similar to page components, layouts can also leverage `#[Reactive]` and `#[Lazy]` attributes for AJAX-like interactions and deferred rendering, respectively. This functionality enhances user experience by optimizing content loading strategies and interactive behaviors.

---

Utilizing layouts within the routing system of the Zenith framework allows for a hierarchically organized, reusable, and maintainable codebase. The separation of layout and page logic fosters a modular development approach, enabling rapid iterations on both content and structural elements independently.
