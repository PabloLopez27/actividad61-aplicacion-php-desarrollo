¡Claro, Pablo! Aquí tienes el archivo README.md adaptado al 100% a tu proyecto de la UD Las Palmas, manteniendo la estructura profesional que me pasaste pero con todos tus datos actuales.

🟡 UD Las Palmas - Sistema de Gestión de Plantilla (DB)
Este repositorio contiene la configuración de la base de datos MariaDB para una aplicación web CRUD en Vanilla PHP dockerizada. La temática principal es la gestión de los jugadores y sus posiciones dentro de la plantilla oficial de la UD Las Palmas.

📊 Estructura de la Base de Datos
La base de datos se denomina pz_pablo (o el nombre que hayas configurado en tu config.php) y consta de dos tablas relacionadas.

Tabla: usuarios
Gestiona el acceso de los administradores al sistema de gestión deportiva.

usuario_id: Clave primaria autoincremental.

nombre_usuario: Identificador único (ej: pablo_admin).

contrasena: Almacena la contraseña hasheada mediante password_hash() (VARCHAR 255).

correo: Correo electrónico único del administrador.

creacion: Marca de tiempo automática de registro.

Tabla Principal: jugadores
Almacena la información técnica de la plantilla del primer equipo.

jugadores_id: Clave primaria (formato nombreTabla_id).

nombre_jugador: Nombre oficial del futbolista (ej: Alberto Moleiro).

dorsal_oficial: Número único asignado al jugador (Campo UNIQUE).

posicion_id: Clave foránea que vincula con las posiciones del campo.

posicion_campo: Descripción textual de la posición (Portero, Defensa, etc.).

nacionalidad: País de origen del jugador.

🔐 Seguridad y Credenciales
Siguiendo las directrices del proyecto, la configuración de seguridad es la siguiente:

Usuario Root: Acceso habilitado para cualquier host ('root'@'%').

Contraseña Root/Usuario: Formato PabloLopez@2026 (Sin tildes ni ñ).

Usuario de Aplicación: Formato usuarioPLo (siguiendo el estándar usuario + Inicial Nombre + Iniciales Apellidos).

Hashing: Las contraseñas se gestionan en PHP con password_hash() y se validan con password_verify(). Nunca se guarda texto plano en la BD.

🚀 Requisitos de la Aplicación (CRUD)
La aplicación conectada a esta base de datos cumple con los siguientes módulos funcionales:

Mantenimiento completo: Listado dinámico, altas de nuevos fichajes, bajas y modificación de datos existentes en la tabla jugadores.

Formularios avanzados: Inclusión de campos de texto para nombres, controles numéricos para dorsales y combos de opciones (select) para la selección de posiciones.

Validación de Negocio: Control de duplicados en el campo dorsal_oficial antes de realizar inserciones para evitar conflictos en la plantilla.

Estética Corporativa: Uso de Bootstrap 5 para el diseño responsivo, con tarjetas (cards) blancas, tipografía limpia y logotipos oficiales de la UD Las Palmas.

🛠️ Tecnologías Utilizadas
Backend: PHP 8.x (Vanilla).

Base de Datos: MariaDB 10.x.

Infraestructura: Docker & Docker Compose (Contenedores independientes para Web y DB).

Frontend: HTML5, CSS3, Bootstrap 5.

CI/CD: GitHub Actions para despliegue automatizado en AWS.