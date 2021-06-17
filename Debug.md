# Debug

El Debug es una parte importante del desarrollo aquí veremos algunas formas y herramientas para hacer debug en PHP.

## Basico

Podemos hacer un debug básico con `var_dump()` esta función nos permite visualizar el contenido de una variable, array u objecto, también conocer información básica de esta, numero de elementos, tipo y longitud.

**Nota:** Puede que no visualizamos en un formato entendible la salida a la hora de usar `var_dump` podemos envolverlo entre etiquetas de `<pre>` de html.

```php
$array = [1, 2, 4];

echo '<pre>';
   var_dump($array);
echo '</pre>';
die;
```
Cuando estamos haciendo debug es recomendable terminar la ejecución del script para ahorrar tiempo, esto lo logramos con `exit()` o `die()` también podemos usarlo para hacer debug pasando un parámetro string que visualizaremos cuando se termine la ejecución de script.


Otra función muy útil a la hora de obtener un muestra de un elemento en su propio formato es `var_export`, esto nos sirve para obtener muestras de arreglos que luego podemos usar en las pruebas.
