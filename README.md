<h1>VividMVC</h1>
<p>Welcome to VividMVC - Custom PHP MVC Framework, a lightweight and flexible MVC (Model-View-Controller) framework designed to streamline your PHP web development projects. This framework provides a solid foundation for building scalable and maintainable web applications.</p>

<h2>Table of Contents</h2>
<ul>
<li><a href="#features">Features</a></li>
<li><a href="#getting_started">Getting Started</a></li>
<ul>
    <li><a href="#prerequisites">Prerequisites</a></li>
    <li><a href="#installation">Installation</a></li>
</ul>
<li><a href="#usage">Usage</a></li>
<ul>
    <li><a href="#folder_structure">Folder Structure</a></li>
    <li><a href="#Middleware">Middleware</a></li>
    <li><a href="#database_configuration">Database Configuration</a></li>
    <li><a href="#login_registration">Login and Registration</a></li>
    <li><a href="#routing">Routing</a></li>
</ul>
</ul>

<h2 id="features">Features</h2>
<ul>
    <li><b>Simple Structure: </b>Follows the MVC architecture with a clear folder structure for controllers, models, and views.</li>
    <li><b>Routing: </b>Basic routing system to handle different URLs and display appropriate content.</li>
    <li><b>Middleware: </b>Middleware support for request processing.</li>
    <li><b>Database Integration: </b> Simple database connection and interaction.</li>
    <li><b>Dependency Injection Container: </b>Efficient management and injection of dependencies.</li>
    <li><b>Template Engine: </b>Integration with the Twig template engine for flexible and maintainable views.</li>
</ul>

<h2 id="getting_started">Getting Started</h2>
<h3 id="prerequisites">Prerequisites</h3>
<ul>
    <li>PHP 7.0 or higher</li>
    <li>Web server (e.g., Apache or Nginx)</li>
    <li>Composer (for installing dependencies)</li>
</ul>

<h3 id="installation">Installation</h3>
<ol>
    <li>
    Clone the repository:
    <pre><code class="language-bash">git clone https://github.com/sammaniLM/VividMVC-.git
</code></pre>
    </li>
    <li>
    Install dependencies using Composer:
    <pre><code class="language-bash">composer install
</code></pre>
    </li>
    <li>Set up your web server to point to the public directory.</li>
    <li>
    Start the development server:
    <pre><code class="language-bash">php -S localhost:8000 -t public
</code></pre>
    </li>
    <li>Visit <code>http://localhost:8000</code> in your browser.</li>
</ol>

<h2 id="usage">Usage</h2>
<h3 id="folder_structure">Folder Structure</h3>
<pre>
    <code class="language-bash">
    /project-root
|-- app
|   |-- controllers
|   |-- models
|   |-- views
|-- config
|-- public
|   |-- css
|   |-- js
|   |-- index.php
|-- System
|   |-- core
|   |   |-- Application.php
|   |   |-- Container.php
|   |   |-- Controller.php
|   |   |-- Database.php
|   |   |-- Middleware.php
|   |   |-- Model.php
|   |   |-- View.php
|   |-- libraries
|-- .htaccess
|-- index.php
</code>
</pre>

<h3 id="Middleware">Middleware</h3>
<p>Middleware can be added in the <code>Application.php</code> file. For example, to add a logging middleware:</p>
<pre><code class="language-bash">// Add the following code in Application.php constructor
$this->addMiddleware(new LoggingMiddleware());
</code></pre>
<p>Create your custom middleware classes in the <code>System/Core/Middleware</code> directory.</p>

<h3 id="database_configuration">Database Configuration</h3>
<p>Update the database configuration in <code>Application.php</code>:</p>
<pre><code class="language-bash">// Add the following code in Application.php constructor
$this->container->bind('database', new Database('localhost', 'username', 'password', 'database_name'));
</code></pre>

<h3 id="login_registration">Login and Registration</h3>
<p>For implementing login and registration functionality, you can create controllers, models, and views dedicated to authentication.</p>
<ol>
    <li><b>Create a User Model:</b>
    Create a <code>User.php</code> model in the <code>app/models</code> directory.
<pre><code class="language-bash">// Example User.php
class User extends Model
{
    // Implement user-related methods
}
</code></pre>
</li>

<li>
    <b>Create Authentication Controllers:</b>
    Create controllers like <code>AuthController.php</code> for handling authentication actions (login, register, logout).
<pre><code class="language-bash">// Example AuthController.php
class AuthController extends Controller
{
    public function login()
    {
        // Implement login logic
    }
    public function register()
    {
        // Implement registration logic
    }
    public function logout()
    {
        // Implement logout logic
    }
}
</code></pre>
</li>
<li>
    <b>Create Authentication Views:</b>
    Create views in the <code>app/views/auth</code> directory for login, registration, and other authentication-related views.
</li>
<li>
    <b>Configure Routes:</b>
    Update the routing in <code>Application.php</code> to handle authentication routes. file.
    <pre><code class="language-bash">// Add the following code in handleRoutes() method
switch ($uri) {
    case '/login':
        $this->getContainer()->resolve('authController')->login();
        break;
    case '/register':
        $this->getContainer()->resolve('authController')->register();
        break;
    case '/logout':
        $this->getContainer()->resolve('authController')->logout();
        break;
    // Other routes...
}
</code></pre>
</li>
</ol>
<h3 id="routing">Routing</h3>
<p>Routing is defined in the <code>Application.php</code> file.</p>
<ol>
    <li><b>Adding Routes</b></li>
Routes are added in the handleRoutes() method of Application.php. Each route is associated with a specific URI, and you can define the corresponding controller and action to handle the request.
<pre><code class="language-bash">public function handleRoutes()
{
    $uri = $_SERVER['REQUEST_URI'];
    switch ($uri) {
        case '/':
            $this->render('welcome.twig', ['name' => 'John']);
            break;
        case '/about':
            $this->render('about.twig');
            break;
        case '/contact':
            $this->render('contact.twig');
            break;
        default:
            $this->render404Page();
            break;
    }
}
</code></pre>
<li><b>Dynamic Routes</b></li>
You can define dynamic routes with parameters. For example, to capture a user's ID in the URL:
<pre><code class="language-bash">public function handleRoutes()
{
    $uri = $_SERVER['REQUEST_URI'];
    // Example: /user/123
    if (preg_match('/\/user\/(\d+)/', $uri, $matches)) {
        $userId = $matches[1];
        $this->render('user_profile.twig', ['userId' => $userId]);
        return;
    }
    // Other routes...
}
</code></pre>
</ol>