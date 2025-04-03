<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Valider la commande - SUP'FOOD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4fbff] text-gray-800">

    <!-- HEADER -->
    <div class="px-4 pt-6 pb-2 flex items-center space-x-2">
        <button onclick="history.back()" class="text-2xl">⬅️</button>
        <h1 class="text-lg font-semibold">Valider la Commande</h1>
    </div>

    <form action="{{ route('commander.store') }}" method="POST" onsubmit="return prepareFormData();">
        @csrf
        <input type="hidden" name="cart_json" id="cartJsonInput">
        <input type="hidden" name="total_items" id="totalItemsInput">
        <input type="hidden" name="total_price" id="totalPriceInput">
        @auth
            <!-- Ajoutez ce champ caché pour l'user_id -->
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        @endauth
        <!-- Adresse -->
        <div class="bg-white m-4 p-4 rounded-2xl shadow space-y-2">
            <h2 class="font-semibold text-sm">Adresse de Livraison</h2>
            <div class="flex items-center bg-[#f0f8f7] p-2 rounded-xl border">
                <span class="mr-2">📍</span>
                <input type="text" name="delivery_address" id="deliveryAddress" value="Cafétéria de Sup'Management"
                    class="w-full bg-transparent outline-none text-sm" required />
                <span class="text-gray-400">➤</span>
            </div>
            <button type="button" onclick="detectLocation()"
                class="w-full bg-blue-600 text-white mt-2 py-2 rounded-full text-sm font-semibold">
                📍 Me Localiser
            </button>
        </div>

        <!-- Paiement -->
        <div class="bg-white mx-4 p-4 rounded-2xl shadow space-y-4">
            <h2 class="font-semibold text-sm mb-2">Paiement</h2>
            <div class="space-y-2">
                <label class="flex items-center justify-between bg-[#f3f9f8] p-3 rounded-xl text-sm">
                    <span class="flex items-center space-x-2">
                        <input type="radio" name="payment_method" value="Carte" checked>
                        <span>💳 Carte</span>
                    </span>
                </label>
                <label class="flex items-center justify-between bg-[#f3f9f8] p-3 rounded-xl text-sm">
                    <span class="flex items-center space-x-2">
                        <input type="radio" name="payment_method" value="Orange Money Mali">
                        <span>📱 Orange Money Mali</span>
                    </span>
                </label>
                <label class="flex items-center justify-between bg-[#f3f9f8] p-3 rounded-xl text-sm">
                    <span class="flex items-center space-x-2">
                        <input type="radio" name="payment_method" value="Espèce">
                        <span>💵 Espèce</span>
                    </span>
                </label>
            </div>
        </div>

        <!-- Résumé -->
        <div class="bg-white m-4 p-4 rounded-2xl shadow text-sm space-y-2">
            <h2 class="font-semibold">Résumé de la Commande</h2>
            <div id="productList" class="text-gray-700 space-y-1"></div>
            <div class="border-t mt-2 pt-2 space-y-1">
                <div class="flex justify-between">
                    <span>Nombre d'Articles</span>
                    <span id="itemCount">0</span>
                </div>
                <div class="flex justify-between">
                    <span>Total</span>
                    <span id="totalAmount">0 F CFA</span>
                </div>

                <hr class="border-blue-100">
                <div class="flex justify-between font-semibold text-orange-500 pt-1">
                    <span>Prix Total</span>
                    <span id="finalPrice">0 F CFA</span>
                </div>
            </div>
        </div>

        <!-- Bouton -->
        <div class="p-4 pb-6">
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-full text-base font-semibold">
                ✅ Confirmer la Commande
            </button>
        </div>
    </form>

    <!-- JS -->
    <script>
        function getCart() {
            return JSON.parse(localStorage.getItem('cart')) || [];
        }

        function detectLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    position => {
                        const lat = position.coords.latitude.toFixed(5);
                        const lon = position.coords.longitude.toFixed(5);
                        document.getElementById('deliveryAddress').value = `Latitude: ${lat}, Longitude: ${lon}`;
                    },
                    () => alert("Cette fonctionnalité n'est pas encore disponible")
                );
            } else {
                alert("La géolocalisation n'est pas prise en charge.");
            }
        }

        function updateSummary() {
            const cart = getCart();
            let total = 0;
            let itemCount = 0;
            const productList = document.getElementById('productList');
            productList.innerHTML = '';

            cart.forEach(product => {
                const subtotal = product.price * product.qty;
                total += subtotal;
                itemCount += product.qty;

                const div = document.createElement('div');
                div.classList = 'flex justify-between';
                div.innerHTML =
                    `<span>${product.qty} × ${product.name}</span><span>${subtotal.toLocaleString()} F CFA</span>`;
                productList.appendChild(div);
            });

            document.getElementById('itemCount').innerText = itemCount;
            document.getElementById('totalAmount').innerText = total.toLocaleString() + ' F CFA';
            document.getElementById('finalPrice').innerText = (total).toLocaleString() + ' F CFA';
        }

        function prepareFormData() {
            const cart = getCart();

            // Vérification que le panier n'est pas vide
            if (cart.length === 0) {
                alert("Votre panier est vide !");
                return false;
            }

            const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

            // Formatage des données pour l'envoi
            document.getElementById('cartJsonInput').value = JSON.stringify(cart);
            document.getElementById('totalItemsInput').value = totalItems;
            document.getElementById('totalPriceInput').value = totalPrice;

            // Vider le panier après la soumission
            localStorage.removeItem('cart');

            return true;
        }

        document.addEventListener('DOMContentLoaded', updateSummary);
    </script>
</body>

</html>
