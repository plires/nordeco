Perfit PHP SDK
==============

Esta SDK funciona como un wrapper de [cURL](http://php.net/manual/en/book.curl.php), abstrayendo la complejidad del armado de los pedidos y simplificando la obtención de la información.

# Instalación

La versión mínima requerida de PHP es la 5.4.0. Si tu versión es anterior, tendrás que actualizarla.

Hay dos formas de instalar el PHP SDK de Perfit:

## Instalación a través de Composer

Si tu proyecto PHP utiliza [Composer](https://getcomposer.org/), el SDK puede incluirse como una dependencia más. En tu archivo `composer.json` debes incluir:

```json
{
    "require": {
        "perfitdev/sdkphp": "dev-master"
    }
}
```

Luego debes ejecutar `composer install` para descargar las dependencias de un proyecto nuevo, o `composer update` para actualizar un proyecto existente. El código será guardado en la carpeta `vendors`, donde encontrarás también el archivo `autoload.php` que deberás incluir para tener acceso al SDK y todas las otras dependencias:

```
require_once __DIR__ . "/vendor/autoload.php";
```

## Instalación manual

Si tu proyecto PHP no utiliza Composer, puedes clonar el código del repositorio público en GitHub e incluirlo cuando vayas a utilizarlo. Para clonar el repositorio, desde nuestra terminal podemos hacer:

```bash
cd /myproject/
mkdir vendor
cd vendor
git clone https://github.com/perfitdev/sdkphp.git
```

Una vez descargados los contenidos, tendremos nuestro SDK en la carpeta `myproject/vendors/sdkphp`. Para comenzar a usar el SDK, debemos incluirlo en nuestro `index.php`.

```
require_once __DIR__ . "/vendor/sdkphp/src/PerfitSDK/Perfit.php";
```

# Uso básico

¡Manos a la obra! Una vez instalado, podemos comenzar a utilizar el SDK. Luego de incluir la librería como vimos en la instalación, debemos instanciar el objeto. Si vamos a utilizar autenticación mediante API key, debemos indicarla en la configuración:

```
$perfit = new PerfitSDK\Perfit( ['apiKey' => 'myaccount-Es6R0UIh4naZIhwIsZDQUecP62PcLCP7' ] );
```

O también lo podemos hacer en dos pasos:

```
$perfit = new PerfitSDK\Perfit();
$perfit->apiKey('myaccount-Es6R0UIh4naZIhwIsZDQUecP62PcLCP7');
```


¡Perfecto! Ahora podemos comenzar a hacer pedidos a la API. Los métodos pueden ser utilizados directamente con cualquiera de los verbos básicos HTTP (GET, POST, PUT, DELETE). Cada una de las funciones recibe como primer parámetro el **recurso al cual queremos acceder** y como segundo parámetro un **array de valores** que será utilizado como argumentos del método a ejecutar.

Veamos unos ejemplos:

**GET**

Listar algunos contacts:

```
$response = $perfit->get('/contacts', ['limit' => 20, 'sortBy' => 'email']);
```

Ver un contacto en particular:

```
$response = $perfit->get('/contacts/134');
```

**POST**

Crear un nuevo contacto:

```
$response = $perfit->post('/contacts', ['firstName' => 'John', 'email' => 'john@gmail.com']);
```

**PUT**

Modificar un contacto existente:

```
$response = $perfit->put('/contacts/134', ['firstName' => 'Mario']);
```

**DELETE**

Eliminar un contacto:

```
$response = $perfit->delete('/contacts/134');
```

# Atajos

Si bien este uso básico hace más sencillas las comunicaciones con el API, indicar la URL completa y los parámetros en un array es bastante similar a utilizar [file_get_contents](http://php.net/manual/en/function.file-get-contents.php) directamente. Por eso, el SDK ofrece atajos muy útiles para que tu código sea aún más limpio y simple.

Estos atajos funcionan como métodos mágicos, que permiten una sintaxis más descriptiva al emular un componente nativo de PHP. Veamos su uso a continuación.

## Namespace

Para ejecutar un método de un namespace en particular, podemos invocar el namespace como si fuera una variable del objeto instanciado. Por ejemplo, para hacer un GET al namespace `contacts` podemos ejecutar:

```
$contacts = $perfit->contacts->get();
```

## IDs

Para solicitudes del tipo GET (al pedir un elemento), PUT o DELETE, podemos especificar el ID del elemento a través del metodo `id`. Por ejemplo, para obtener la información del contacto de ID 13 podemos hacer:

```
$contact = $perfit->contacts->id(13)->get();
```

## Paginación

Tambien podemos definir la paginación de nuestros listados utilizando los métodos `limit` y `offset` de esta forma:

```
$contacts = $perfit->contacts->limit(20)->get();
```

```
$contacts = $perfit->contacts->offset(20)->get();
```

## Ordenamiento

El método `sort` define el ordenamiento y el sentido de ordenamiento del próximo pedido. Se puede definir solamente el campo por el que ordenar, o tanto el campo como su sentido. Veamos unos ejemplos:

```
$response = $perfit->contacts->sort('email')->get();
```

```
$response = $perfit->contacts->sort('email', 'DESC')->get();
```

## Parámetros

El método `params` define los parámetros que se van a enviar en el llamado. Sirve tanto para definir las propiedades del elemento al hacer un POST o PUT, como para los especificar los parámetros de los listados al hacer un GET.

Se puede invocar más de una vez antes de un pedido, acumulándose los parámetros y sobreescribiendo aquellos cuya clave ya exista.

```
$response = $perfit->contacts->params(['state' => 'inactive'])->get();
```

```
$response = $perfit->contacts->params(['lastName' => 'Doom', 'email' => 'DrDoom@gmail.com'])->post();
```

## Métodos en cadena

Todos estos métodos pueden invocarse en cadena, uno detrás del otro, en el mismo pedido. El llamado se ejecutará cuando se llame a cualquiera de los métodos posibles (GET, POST, PUT, DELETE).

Por ejemplo, podemos obtener un listado de contactos que tengan estado inactivo, limite 30 y offset 10 de la siguiente forma:

```
$contacts = $perfit->contacts->params(['state' => 'inactive'])->limit(30)->offset(10)->get();
```

O modificar el nombre del formulario Opt-In de ID 10:

```
$contact = $perfit->optins->params(['name' => 'Formulario Mayo'])->id(10)->put();
```

O bien eliminar la lista con ID 15:

```
$list = $perfit->lists->id(15)->delete();
```

## Método

Para definir manualmente el método utilizado, podemos llamar a la función `method`:

```
$response = $perfit->method('delete');
```

## Acciones

Algunos namespaces permiten ejecutar tareas. Por ejemplo, las listas: podemos limpiar una lista, duplicarla, dividirla, etc. En esos casos, todos las tareas se pueden invocar como funciones de ejecución (en lugar de los métodos HTTP). Veamos un ejemplo:

```
$response = $perfit->lists->params(['bounced' => true, 'action' => 'delete'])->id(3)->clean();
```

# Respuesta

Al ejecutar un método (ya sea una accion o cualquier método HTTP), los parámetros definidos con `params` y `id` se limpian. Si queremos seguir ejecutando llamadas con los mismos parámetros debemos definirlos nuevamente.

La respuesta llega en formato array, sin necesidad de hacer un [json_decode](http://php.net/json_decode). Además de los datos que toda respuesta contiene, tenemos acceso a la propiedad `request` que contiene el pedido original enviado por el PHP SDK, lo cual es muy útil al momento de hacer un debug.

# Ejemplos

** Ejemplo 1: Listar contactos**

```
require_once __DIR__ . "/vendor/autoload.php";

$perfit = new PerfitSDK\Perfit( ['apiKey' => 'myaccount-Es6R0UIh4naZIhwIsZDQUecP62PcLCP7' ] );

$response = $perfit->contacts->get();
```

** Ejemplo 2: Listar 30 contactos activos ordenados por email**

```
require_once __DIR__ . "/vendor/autoload.php";

$perfit = new PerfitSDK\Perfit( ['apiKey' => 'myaccount-Es6R0UIh4naZIhwIsZDQUecP62PcLCP7' ] );

$response = $perfit->contacts->params(['state' => 'active'])->limit(30)->sort('email')->get();
```

** Ejemplo 3: Obtener la información del contacto con ID 201**

```
require_once __DIR__ . "/vendor/autoload.php";

$perfit = new PerfitSDK\Perfit( ['apiKey' => 'myaccount-Es6R0UIh4naZIhwIsZDQUecP62PcLCP7' ] );

$response = $perfit->contacts->id(201)->get();
```

** Ejemplo 4: Modificar el nombre del contacto con ID 23**

```
require_once __DIR__ . "/vendor/autoload.php";

$perfit = new PerfitSDK\Perfit( ['apiKey' => 'myaccount-Es6R0UIh4naZIhwIsZDQUecP62PcLCP7' ] );


$response = $perfit->contacts->params(['firstName' => 'Mario'])->id(23)->put();
```

** Ejemplo 5: Agregar un contacto nuevo**

```
require_once __DIR__ . "/vendor/autoload.php";

$perfit = new PerfitSDK\Perfit( ['apiKey' => 'myaccount-Es6R0UIh4naZIhwIsZDQUecP62PcLCP7' ] );

$params = ['firstName' => 'Jorge', 'lastName' => 'Lopez', 'email' => 'jlopez@gmail.com',];
$response = $perfit->contacts->params($params)->post();
```

** Ejemplo 6: Elimino el contacto con ID 43**

```
require_once __DIR__ . "/vendor/autoload.php";

$perfit = new PerfitSDK\Perfit( ['apiKey' => 'myaccount-Es6R0UIh4naZIhwIsZDQUecP62PcLCP7' ] );

$result = $perfit->contacts->id(43)->delete();
```

** Ejemplo 7: Limpiar contactos rebotados de la lista con ID 56**

```
require_once __DIR__ . "/vendor/autoload.php";

$perfit = new PerfitSDK\Perfit( ['apiKey' => 'myaccount-Es6R0UIh4naZIhwIsZDQUecP62PcLCP7' ] );

$result = $perfit->lists->params(['bounced' => true, 'action' => 'delete'])->id(56)->clean();
```


# Configuración avanzada

El SDK utiliza un array de configuraciones generales donde podemos especificar, además del API key, la URL de la API y la versión que queremos utilizar. Estas propiedades se pueden modificar al instanciar el objeto. En la mayoría de los casos usaremos los valores por defecto, pero de ser necesario se pueden modificar:

```
$perfit = new PerfitSDK\Perfit(['version' => 2]);
```

O en cualquier momento llamando al método `settings`:

```
$perfit->settings(['version' => 2]);
```

La lista completa de configuraciones posibles y sus valores por defecto son:

```
$settings = [
    'url' => "https://api.myperfit.com",
    'version' => 2,
    'apiKey' => ''
];
```

Invocando el método `settings` sin parámetros, el SDK devuelve la configuración actual:

```
$currentSettings = $perfit->settings();
```

# Login mediante usuario y contraseña

La forma preferida de identificarnos en la API es mediante el API key como se explicó anteriormente. Sin embargo, también podemos autenticarnos usando el usuario y contraseña. Este método tiene algunas desventajas:

- La contraseña puede modificarse al expirar o si el usuario necesita reestablecerla.
- El token que se obtiene luego del llamado al login expira luego de un tiempo de inactividad, en ese cado debemos obtener uno nuevo.
- Debemos almacenar de nuestro lado el token para utilizar en los sucesivos llamados a la API.

Para realizar el llamado a `login` debemos indicar el `user`, `password` y opcionalmente `account`, como lo muestra el siguiente ejemplo:

```
$perfit->login($user, $password, $account);
```

En caso de éxito, esta llamada almacenará el token devuelto y lo utilizará para incluirlo en los futuros pedidos al API. De esta forma, no tenemos que preocuparnos por guardar el token y enviarlo manualmente junto con los parámetros de cada pedido, el SDK lo hará por nosotros.

El nombre de la cuenta es opcional, de ser definido también servirá para cualquier futuro pedido. En el caso de querer cambiar la cuenta a la que se quieren ejecutar los pedidos, se puede utilizar el método `account` de esta forma:

```
$perfit->account($account);
```

Si ya se posee un token, se puede definir en la instancia de la librería mediante el método `token`. Este método devuelve el token configurado actualmente.

```
$perfit->token($_SESSION['token']);
```
