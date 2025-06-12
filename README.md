# 💼 Estimador de Presupuesto - Gemini

Esta es una interfaz de usuario en HTML/CSS/JavaScript que permite a los usuarios solicitar presupuestos personalizados para eventos. El sistema recopila información del evento y la envía a un backend que genera una respuesta estimada de costos, presentada de manera clara al usuario.

## 🎯 Objetivo del Proyecto

El objetivo de este proyecto es desarrollar una herramienta web que permita a los usuarios generar presupuestos estimados para eventos de forma automatizada y dinámica. Utilizando una interfaz amigable y un backend con integración de inteligencia artificial, se busca facilitar la planificación financiera de eventos mediante respuestas claras y detalladas.

## 🧑‍🤝‍🧑 Integrantes y Roles

- **Ana Vargas** – 💼 *Líder del proyecto*  
  Coordina las actividades del equipo, asegura el cumplimiento de objetivos y gestiona la planificación general.

- **Raúl Alanís** – 📝 *Documentador*  
  Se encarga de la elaboración de documentación técnica, manuales de usuario y redacción de reportes.

- **Juan de Dios Pérez** – 🔧 *Integrador*  
  Responsable de ensamblar los distintos componentes del proyecto (frontend y backend) y asegurar su correcta funcionalidad.

- **Jesús Galindo** – 🎨 *Diseñador*  
  Encargado de la interfaz gráfica, diseño responsivo, experiencia de usuario y estilos visuales.

## 🔁 Flujo de Trabajo Usado

El equipo trabajó de forma colaborativa siguiendo un flujo de trabajo ágil basado en los siguientes pasos:

1. **Planeación**  
   Se definió el alcance del proyecto, se asignaron roles y se estableció un cronograma de tareas.

2. **Diseño**  
   Se desarrollaron bocetos iniciales de la interfaz y se establecieron lineamientos visuales.

3. **Desarrollo por módulos**  
   - *Frontend:* Creación de `index.html` con un formulario responsivo.
   - *Backend:* Desarrollo del archivo `consulta.php` para procesar solicitudes.
   - *JavaScript:* Lógica para enviar datos al servidor y mostrar la respuesta formateada.

4. **Integración**  
   El integrador conectó todas las partes del sistema, validando su funcionamiento conjunto.

5. **Documentación**  
   El documentador creó este archivo README.md, diagramas y materiales de apoyo para el usuario y desarrolladores.

6. **Pruebas y mejora continua**  
   Se realizaron pruebas funcionales y de usabilidad, corrigiendo errores y optimizando la experiencia de usuario.

---

## ✨ Características

* Formulario de entrada amigable y responsivo.
* Campos detallados para personalizar la solicitud de presupuesto.
* Conversión automática de la respuesta del backend (en texto estilo Markdown) a HTML bien estructurado.
* Estilos modernos y accesibles.
* Soporte para listas, negritas, y notas dentro del desglose de presupuesto.

## 📂 Estructura del Proyecto

```

/raíz del proyecto
├── index.html         # Interfaz de usuario principal
├── consulta.php       # Script PHP que procesa las solicitudes (debes crearlo tú)
└── README.md          # Este documento

```

## 🛠️ Requisitos

* Navegador moderno (Chrome, Firefox, Edge, etc.).
* Un servidor local o en producción con soporte PHP para procesar `consulta.php`.
* Conexión a Internet (opcional si tu PHP se conecta a una API externa).

## 🚀 Cómo Usar

1. Coloca el archivo `index.html` en tu servidor.
2. Crea un archivo `consulta.php` en el mismo directorio (debe recibir y procesar el JSON enviado por `fetch`).
3. Abre `index.html` en un navegador web.
4. Llena el formulario con los detalles del evento.
5. Haz clic en **"Consultar"**.
6. El presupuesto estimado aparecerá en pantalla, formateado y desglosado.

## 🧠 Cómo Funciona

* Al enviar el formulario, los datos se recopilan y se envían como JSON al backend mediante `fetch`.
* La respuesta esperada es un mensaje en texto plano estilo Markdown que contiene:

```

  <Monto total>

**Desglose Detallado de Costos:**

* Comida: \$XXXX
* Bebidas: \$XXXX
* Personal: \$XXXX
  ...

```
* El script JavaScript convierte ese mensaje a HTML amigable y lo muestra al usuario.

## 🖌️ Estilos Personalizados

* Tipografía legible y moderna.
* Entradas de formulario amplias y accesibles.
* Diseño centrado y adaptativo para dispositivos móviles.
* Resultados con tarjetas visuales y jerarquía de información clara.

## ⚠️ Notas

* El backend (`consulta.php`) está incluido en este archivo y **debes implementarlo tú** con una API key si se conecta a un modelo como Gemini.
* Asegúrate de manejar correctamente los tokens y respuestas si hay integración con servicios externos.

## 📸 Captura de Pantalla

> ![image](https://github.com/user-attachments/assets/76892e58-9fe7-4e07-a6ab-36837a0c07e9)

## 🧾 Licencia

Este proyecto es de código abierto. Puedes modificarlo y adaptarlo según tus necesidades.

