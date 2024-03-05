
# Routing Actions

In the Zenith framework, actions embody a robust mechanism for handling form submissions, POST requests, and other actionable elements within the routing system. This guide illuminates the pivotal role actions play in the framework's routing system, detailing how to define, create, and utilize actions effectively.

## Understanding Actions

Actions are specialized route handlers that respond to POST requests or other actionable elements, such as form submissions. They enable developers to encapsulate the logic for processing input data and carrying out operations like authentication, data storage, and redirecting users.

## Creating Actions

To create an action, a corresponding `action.php` file should be placed next to the page component it's associated with within the `routes/` directory. The framework automatically associates an `action.php` file with the same route as its sibling `page.php`.

**Example: Creating an Action for a Contact Form**
```shell
composer add-route /contact
# This action creates a `page.php` in the routes/contact/ directory.
# Manually create an `action.php` next to `page.php` to handle form submissions.
```

## Structure of an Action

An action can be defined as a PHP function or class method that processes the incoming POST data. It receives parameters similar to page components, providing context about the request and enabling dynamic response generation.

### Parameters Passed to an Action:
- `array $params`: Route parameters from dynamic segments.
- `ServerRequestInterface $request`: Current request object, containing POST data.
- `ResponseInterface $response`: Current response object for sending back the response.

## Implementing an Action

Actions should be designed to handle specific tasks, such as validating form data, updating a database, or performing user authentication.

```php
# In routes/contact/action.php
return function($params, $request, $response) {
    $postData = $request->getParsedBody();
    // Validate and process data...
    // Redirect or return a response...
};
```

## Interaction with Pages and Layouts

While actions primarily handle data processing, they can interact with pages and layouts by redirecting to other routes or displaying messages upon completion.

---

Actions form a crucial component of the Zenith's routing system, providing a streamlined approach to handling user inputs and server-side processing. By leveraging actions, developers can create interactive, dynamic web applications with efficient data handling and user feedback mechanisms.

