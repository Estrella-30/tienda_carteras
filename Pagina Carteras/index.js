document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', () => {
        alert('¡Producto agregado al carrito!');
    });
});
// Cargar el carrito de localStorage
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

// Actualizar la cantidad mostrada en el enlace del carrito
function actualizarCarrito() {
    const cantidadCarrito = carrito.reduce((total, item) => total + item.cantidad, 0);
    document.getElementById('cantidad-carrito').textContent = cantidadCarrito;
}

// Guardar el carrito en localStorage
function guardarCarrito() {
    localStorage.setItem('carrito', JSON.stringify(carrito));
}

// Agregar producto al carrito
document.querySelectorAll('.agregar-carrito').forEach(button => {
    button.addEventListener('click', () => {
        const productoElement = button.closest('.producto');
        const id = productoElement.getAttribute('data-id');
        const nombre = productoElement.querySelector('h3').textContent;
        const precio = productoElement.querySelector('p').textContent.replace('Precio: $', '');

        // Buscar si el producto ya está en el carrito
        const productoEnCarrito = carrito.find(item => item.id === id);

        if (productoEnCarrito) {
            productoEnCarrito.cantidad++;
        } else {
            carrito.push({ id, nombre, precio, cantidad: 1 });
        }

        guardarCarrito();
        actualizarCarrito();

        alert('Producto agregado al carrito');
    });
});

// Inicializar el carrito al cargar la página
actualizarCarrito();
