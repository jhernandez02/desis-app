# Instalación de la aplicación

### Clonar el repositorio
    ```
    git clone https://github.com/jhernandez02/desis-app.git
    ```

### Base de datos
- Crear una base de datos en MySQL
- Importar el archivo sql/prueba_desis.sql
- Para modificar los datos de conexión a la base de datos, modificar en el archivo app/Config/Database.php los valores de las siguiente variables:
    ```    
    $host = 'localhost';
    $db_name = 'prueba_desis';
    $username = 'root';
    $password = '';
    ``` 

### Levantar el servidor localmente
- Ingresar a la carpeta desis-app y desde consolo ejecutar los siguiente comandos:
    ```  
    cd public
    php -S localhost:8000
    ```  

### Probar la aplicación
- Desde el navegador ingresar a la siguiente URL
    ```  
    localhost:8000
    ```  
### Tecnologías
| Herramienta | Versión |
| ------ | ------ |
| Base de datos | MySQL 8|
| PHP | 7.3+ |
| Apache | 2.4.46 |

### Notas
- Tener habilitado mod_rewrite
- Puerto por defecto MySQL: 3306
