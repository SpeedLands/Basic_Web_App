<?php

$apiKey = // your api key; 

// Recibir datos del formulario 
$data = json_decode(file_get_contents('php://input'), true);

// 1. Definir la Instrucción de Sistema
// Esta parte le dice al modelo CÓMO debe actuar.
$system_instruction_text = "Eres un experto estimador de presupuestos de catering. Tu tarea es analizar los detalles de un evento y las preferencias de catering.
Comienza tu respuesta DIRECTAMENTE con el 'Presupuesto Estimado Total'. Esta debe ser una única línea que contenga solo el número del presupuesto en Pesos Mexicanos (MXN), sin ningún texto adicional, moneda o formato en esta línea.
Inmediatamente después de la línea del total, proporciona un salto de línea.
Luego, incluye una sección titulada exactamente así: '**Desglose Detallado de Costos:**'.
Bajo este título, detalla cada costo como un ítem de lista, comenzando cada ítem con un asterisco y un espacio ('* ').
Dentro de los ítems del desglose, utiliza negritas (encerrando el texto entre '**') para resaltar los conceptos clave y los subtotales.
Proporciona una estimación conservadora pero realista. Toda la respuesta debe estar en español. No incluyas introducciones ni conclusiones fuera de la estructura solicitada (total y desglose).";

// 2. Armar el prompt del usuario con los detalles específicos del evento
// Esta parte son los DATOS que el modelo debe procesar.
$user_prompt = "Por favor, genera un presupuesto basado en los siguientes detalles del evento:\n\n"; // Un encabezado amigable para el prompt del usuario
$user_prompt .= "Detalles del Evento:\n";
// Usamos el operador de fusión de null (??) para evitar errores si alguna clave no está presente
$user_prompt .= "Cómo supieron de nosotros: " . ($data['howDidYouHear'] ?? 'No especificado') . "\n";
$user_prompt .= "Nombre Completo: " . ($data['fullName'] ?? 'No especificado') . "\n";
$user_prompt .= "Número de Teléfono: " . ($data['phoneNumber'] ?? 'No especificado') . "\n";
$user_prompt .= "Dirección del Evento: " . ($data['eventAddress'] ?? 'No especificada') . "\n";
$user_prompt .= "Fecha del Evento: " . ($data['eventDate'] ?? 'No especificada') . "\n";
$user_prompt .= "Hora de Inicio: " . ($data['eventStartTime'] ?? 'No especificada') . "\n";
$user_prompt .= "Hora del Servicio de Comida: " . ($data['foodServiceTime'] ?? 'No especificada') . "\n";
$user_prompt .= "Número de Invitados: " . ($data['numberOfGuests'] ?? 0) . "\n";
$user_prompt .= "Preferencias de Cotización: " . (isset($data['quotationPreferences']) && is_array($data['quotationPreferences']) ? implode(', ', $data['quotationPreferences']) : 'No especificadas') . "\n";
$user_prompt .= "Otros Detalles: " . ($data['otherQuotationDetails'] ?? 'Ninguno') . "\n";
$user_prompt .= "Tipo de Evento: " . ($data['eventType'] ?? 'No especificado') . "\n";
$user_prompt .= "Mesa y Mantel: " . ($data['tableAndMantel'] ?? 'No especificado') . "\n";
$user_prompt .= "Personal de Servicio: " . ($data['servingStaff'] ?? 'No especificado') . "\n";
$user_prompt .= "Acceso para Servicio de Café: " . ($data['coffeeServiceAccess'] ?? 'No especificado') . "\n";
$user_prompt .= "Dificultad de Montaje: " . ($data['setupDifficulty'] ?? 'No especificada') . "\n";
$user_prompt .= "Tipo de Consumidores: " . (isset($data['consumerType']) && is_array($data['consumerType']) ? implode(', ', $data['consumerType']) : 'No especificado') . "\n";
$user_prompt .= "Restricciones Dietéticas: " . ($data['dietaryRestrictions'] ?? 'Ninguna') . "\n";
$user_prompt .= "Requisitos Adicionales: " . ($data['additionalRequirements'] ?? 'Ninguno') . "\n";
$user_prompt .= "Rango de Presupuesto (informativo para el cliente, no una restricción para ti): " . ($data['budgetRange'] ?? 'No especificado') . "\n\n";
// La instrucción de cómo responder ("Responde con...") ya está en la system_instruction.

// 3. Petición a Gemini con system_instruction
// Puedes usar gemini-1.5-flash, gemini-pro, etc.
$url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . $apiKey;

$payload = [
  'system_instruction' => [ // <-- AQUÍ ESTÁ LA CLAVE
    'parts' => [
      ['text' => $system_instruction_text]
    ]
  ],
  'contents' => [
    [
      'parts' => [
        ['text' => $user_prompt] // El prompt del usuario ahora solo contiene los detalles
      ]
    ]
  ],
  // Opcional: Puedes añadir generationConfig si necesitas controlar temperatura, max tokens, etc.
  // 'generationConfig' => [
  //   'temperature' => 0.7,
  //   'maxOutputTokens' => 2048,
  // ]
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ]
]);

$response = curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$curl_error = curl_error($curl);
curl_close($curl);

$responseText = 'Error al generar presupuesto.'; // Mensaje de error por defecto

if ($curl_error) {
    $responseText = 'Error en cURL: ' . $curl_error;
} elseif ($httpcode >= 200 && $httpcode < 300) {
    $json = json_decode($response, true);
    if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
        $responseText = $json['candidates'][0]['content']['parts'][0]['text'];
    } elseif (isset($json['error']['message'])) {
        // Capturar mensajes de error específicos de la API de Gemini
        $responseText = 'Error de API Gemini: ' . $json['error']['message'];
    } else {
        $responseText = "Respuesta inesperada de la API. Código: {$httpcode}. Respuesta: " . $response;
    }
} else {
    // Error HTTP (4xx, 5xx)
    $responseText = "Error HTTP {$httpcode}. Respuesta: " . $response;
    // Es útil loguear $response aquí para depuración
    error_log("Error HTTP {$httpcode} de Gemini API: " . $response);
}

// Devolver respuesta
header('Content-Type: application/json');
echo json_encode(['mensaje' => $responseText]);
?>
