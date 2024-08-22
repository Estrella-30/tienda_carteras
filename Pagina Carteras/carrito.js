// Cargar el carrito de localStorage
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

// Mostrar los productos en el carrito
function mostrarCarrito() {
    const listaCarrito = document.getElementById('lista-carrito');
    const totalCarrito = document.getElementById('total-carrito');

    listaCarrito.innerHTML = '';

    let total = 0;

    carrito.forEach(item => {
        const productoElement = document.createElement('div');
        productoElement.classList.add('producto-carrito');
        productoElement.innerHTML = `
            <h3>${item.nombre}</h3>
            <p>Precio: $${item.precio}</p>
            <p>Cantidad: ${item.cantidad}</p>
            <button class="eliminar-producto" data-id="${item.id}">Eliminar</button>
        `;

        listaCarrito.appendChild(productoElement);

        total += item.precio * item.cantidad;
    });

    totalCarrito.textContent = total;

    // Eliminar productos del carrito
    document.querySelectorAll('.eliminar-producto').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            carrito = carrito.filter(item => item.id !== id);

            guardarCarrito();
            mostrarCarrito();
        });
    });
}

// Guardar el carrito en localStorage
function guardarCarrito() {
    localStorage.setItem('carrito', JSON.stringify(carrito));
}

// Finalizar compra
document.getElementById('finalizar-compra').addEventListener('click', () => {
    if (carrito.length === 0) {
        alert('El carrito está vacío');
        return;
    }

    alert('Compra finalizada con éxito');
    carrito = [];
    guardarCarrito();
    mostrarCarrito();
});

// Mostrar el carrito al cargar la página
mostrarCarrito();

