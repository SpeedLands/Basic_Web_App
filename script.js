const tips = [
  "Apaga las luces que no estás usando.",
  "Lleva tu propia bolsa reutilizable al supermercado.",
  "Evita plásticos de un solo uso como popotes y cubiertos.",
  "Recicla papel, cartón, vidrio y aluminio.",
  "Consume productos locales para reducir huella de carbono.",
  "Camina o usa bicicleta en trayectos cortos.",
  "Cierra la llave mientras te cepillas los dientes.",
  "Reutiliza frascos y envases de vidrio.",
  "Desconecta cargadores cuando no los uses.",
  "Evita dejar el coche encendido si no estás en movimiento."
];

function mostrarNuevoTip() {
  const randomIndex = Math.floor(Math.random() * tips.length);
  document.getElementById("eco-tip").textContent = tips[randomIndex];
}

// Mostrar uno al cargar
mostrarNuevoTip();
