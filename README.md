# 💼 Estimador de Presupuesto - Gemini

Esta es una interfaz de usuario en HTML/CSS/JavaScript que permite a los usuarios solicitar presupuestos personalizados para eventos. El sistema recopila información del evento y la envía a un backend que genera una respuesta estimada de costos, presentada de manera clara al usuario.

## Objetivo del proyecto

## Integrantes y Roles

* Raul
* Juan de Dios
* Ana Vargas
* Jesus Eduardo

## ✨ Características

* Formulario de entrada amigable y responsivo.
* Campos detallados para personalizar la solicitud de presupuesto.
* Conversión automática de la respuesta del backend (en texto estilo Markdown) a HTML bien estructurado.
* Estilos modernos y accesibles.
* Soporte para listas, negritas, y notas dentro del desglose de presupuesto.

## 📂 Estructura del Proyecto

```
/raíz del proyecto
├── index.html         # Este archivo
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
  * Comida: $XXXX
  * Bebidas: $XXXX
  * Personal: $XXXX
  ...
  ```
* El script JavaScript convierte ese mensaje a HTML amigable y lo muestra al usuario.

## 🖌️ Estilos Personalizados

* Tipografía legible y moderna.
* Entradas de formulario amplias y accesibles.
* Diseño centrado y adaptativo para dispositivos móviles.
* Resultados con tarjetas visuales y jerarquía de información clara.

## ⚠️ Notas

* El backend (`consulta.php`) no está incluido en este archivo y **debes implementarlo tú**.
* Si se espera una integración con un modelo como Gemini o una API de IA, asegúrate de manejar correctamente los tokens y respuestas.

## 📸 Captura de Pantalla

> ![image](https://github.com/user-attachments/assets/76892e58-9fe7-4e07-a6ab-36837a0c07e9)


## 🧾 Licencia

Este proyecto es de código abierto. Puedes modificarlo y adaptarlo según tus necesidades.

