const formatCurrency = num => parseInt(num).toLocaleString('vi-VN');

// Khởi tạo giỏ hàng mẫu nếu chưa có dữ liệu
const initCart = () => {
    let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
    if (!cart.length) {
        cart = [
            { name: "ỚT CHUÔNG XANH", price: 70000, quantity: 5 },
            { name: "ỚT CHUÔNG TÍM", price: 70000, quantity: 5 }
        ];
        localStorage.setItem('cart_items', JSON.stringify(cart));
    }
};

// Hiển thị danh sách sản phẩm trong giỏ hàng
const renderCart = () => {
    const cartContainer = document.querySelector('#cart');
    const items = JSON.parse(localStorage.getItem('cart_items')) || [];
    let total = 0;
    cartContainer.innerHTML = '';

    items.map((item, index) => {
        const subtotal = item.price * item.quantity;
        total += subtotal;

        cartContainer.innerHTML += `
            <div class="product">
                <img src="../anh/${item.name.includes("XANH") ? "otchuongxanh.jpg" : "otchuongdo.jpg"}" />
                <span>${item.name}</span>
                <span>Đơn giá: ${formatCurrency(item.price)}đ</span>
                <input type="number" class="quantity" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value)" />
                <span>= ${formatCurrency(subtotal)}đ</span>
                <button class="remove-btn" onclick="removeItem(${index})">X</button>
            </div>
        `;
    });

    document.querySelector('#total').innerText = formatCurrency(total);
    localStorage.setItem('cart_total', total);
};

// Cập nhật số lượng sản phẩm
const updateQuantity = (index, newQty) => {
    let items = JSON.parse(localStorage.getItem('cart_items')) || [];
    items[index].quantity = parseInt(newQty);
    localStorage.setItem('cart_items', JSON.stringify(items));
    renderCart();
};

// Xóa sản phẩm khỏi giỏ hàng
const removeItem = (index) => {
    let items = JSON.parse(localStorage.getItem('cart_items')) || [];
    items.splice(index, 1);
    localStorage.setItem('cart_items', JSON.stringify(items));
    renderCart();
};

// Chuyển sang trang thanh toán
const goToCheckout = () => {
    window.location.href = "../../index/ThanhToan.html";
};

// Khởi chạy giỏ hàng khi tải trang
window.onload = () => {
    initCart();
    renderCart();
};
