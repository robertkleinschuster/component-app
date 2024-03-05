# Zenith

**Zenith** is an advanced PHP application framework designed to streamline the development process by incorporating both the [Slim Framework](https://www.slimframework.com) and [Compass Router](https://github.com/robertkleinschuster/compass) for a component-driven development experience inspired by NEXT.js routing.

## Key Features

- **Component-Driven Development:** Utilizes a highly modular architecture allowing for reusable components.
- **NEXT.js Inspired Routing:** Offers an intuitive approach to routing in PHP, enhancing the navigational structure of your application.
- **Slim Framework Base:** Leverages the Slim Framework, providing a powerful and robust base for building applications.
- **Advanced Rendering Techniques:** Supports reactive and lazy page rendering to optimize user experiences.

## Quick Start

Create and run your next PHP application in a few easy steps:

1. **Project Setup:**

    Initialize a new project using Composer:

    ```bash
    composer create-project robertkleinschuster/zenith-starter my-new-project
    ```

2. **Development Server:**

    Launch the development server:

    ```bash
    composer dev
    ```

   Visit your application at https://localhost:8080/.

3. **Add Routes:**

    Introduce new routes to your application easily:

    ```bash
    composer add-route /about-me
    ```

   **Example:** Access `route/about-me/page.php` via https://localhost:8080/about-me.

## Directory Structure

Understand the architecture of your project:

```
components/       # Put functional components here
public/           # Webserver document root
routes/           # Route entrypoints
src/              # Object-oriented code for business logic
tests/            # Unit tests
```

## Usage Example

This example demonstrates setting up a user profile page, focusing on automatic route registration, dynamic layouts, and handling form submissions according to the framework's conventions.

### Convention Overview

- `page.php` files for GET requests and `layout.php` for layouts follow a specific naming and directory structure convention based on the route they serve.
- `action.php` files, for POST requests, are placed alongside `page.php` and `layout.php` files, adhering to the same path-related conventions.

### Step 1: Profile Page and Layout

For the route `/user/{userId}`, arrange the following structure inside the `routes` directory:

- Add `page.php` within `routes/user/{userId}/` to render profile content:
    ```php
    <?php

    use Mosaic\Fragment;
    use Psr\Http\Message\ServerRequestInterface;

    return function(ServerRequestInterface $request, array $params) {
        $userId = $params['userId'];
        $content = "<h1>User Profile for User ID: {$userId}</h1>";

        return new Fragment($content);
    };
    ```

- Create `layout.php` in the same directory (`routes/user/{userId}/`) to establish the page layout:
    ```php
    <?php

    use Mosaic\Fragment;
    use Mosaic\Renderer;

    return function(Renderer $renderer, $children) {
        $html = "<html><body>{$renderer->render($children)}</body></html>";

        return new Fragment($html);
    };
    ```

### Step 2: Form Submission Action

- Implement `action.php` within `routes/user/{userId}/` for processing the form submission:
    ```php
    <?php

    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;

    return function(ServerRequestInterface $request, ResponseInterface $response) {
        $formData = $request->getParsedBody();
        $response->getBody()->write("Form data: " + htmlspecialchars($formData['data']));

        return $response;
    };
    ```
