document.addEventListener('DOMContentLoaded', () => {
    const main = document.getElementById('content');

    // Xử lý thêm vào giỏ hàng
    function attachAddToCartFormHandler() {
        const form = document.getElementById('add-to-cart-form');
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                        } else {
                            alert(data.message || '❌ Lỗi không xác định');
                        }
                    })
                    .catch(err => {
                        console.error('Lỗi:', err);
                        alert('❌ Có lỗi khi gửi yêu cầu!');
                    });
            });
        }
    }

    // Xử lý xoá sản phẩm khỏi giỏ
    function attachRemoveFromCartHandlers() {
        document.querySelectorAll('.remove-item-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(form);
                const cartItem = form.closest('tr');

                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            cartItem.remove();

                            const totalElement = document.querySelector('h3');
                            if (totalElement && data.total) {
                                totalElement.textContent = 'Tổng cộng: ' + data.total;
                            }

                            if (document.querySelectorAll('table tr').length === 1) {
                                document.querySelector('table').remove();
                                const checkoutBtn = document.getElementById('checkout-btn');
                                if (checkoutBtn) checkoutBtn.remove();

                                const emptyText = document.createElement('p');
                                emptyText.id = 'empty';
                                emptyText.textContent = 'Giỏ hàng trống.';
                                document.getElementById('cart').appendChild(emptyText);
                            }
                        } else {
                            alert('❌ ' + data.message);
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('❌ Lỗi xoá sản phẩm');
                    });
            });
        });
    }

    // Xử lý click vào sản phẩm để xem chi tiết
    document.addEventListener('click', function (e) {
        const target = e.target.closest('a[data-detail]');
        if (target) {
            e.preventDefault();
            const id = target.dataset.detail;
            const url = `./pages/product-detail.php?id=${id}`;

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    main.innerHTML = html;
                    attachAddToCartFormHandler();
                    history.pushState({ page: 'product-detail', id }, "", `#product-detail&id=${id}`);
                })
                .catch(error => {
                    main.innerHTML = `<p>Lỗi tải chi tiết: ${error.message}</p>`;
                });
        }
    });

    // Load các trang như home, product, cart,...
    function loadPage(page, updateHistory = true) {
        const url = `./pages/${page}.php`;

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                return response.text();
            })
            .then(html => {
                main.innerHTML = html;

                // ✅ Gắn lại sự kiện tuỳ theo trang
                if (page === 'cart') attachRemoveFromCartHandlers();
                if (page === 'product-detail') attachAddToCartFormHandler();

                if (updateHistory) {
                    history.pushState({ page }, "", `#${page}`);
                }
            })
            .catch(error => {
                console.error('Lỗi tải trang:', error);
                main.innerHTML = `<div style="color:red; padding:20px;">
                    <h3>Không thể tải trang</h3>
                    <p>Lỗi: ${error.message}</p>
                    <a href="#home" data-page="home">Về trang chủ</a>
                </div>`;
            });
    }

    // Gắn sự kiện cho các link chuyển trang
    const links = document.querySelectorAll('a[data-page]');
    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const page = link.dataset.page;
            if (page) loadPage(page);
        });
    });

    // Xử lý nút Back/Forward của trình duyệt
    window.addEventListener('popstate', (e) => {
        const state = e.state;
        if (state?.page === 'product-detail') {
            const id = state.id;
            fetch(`./pages/product-detail.php?id=${id}`)
                .then(res => res.text())
                .then(html => {
                    main.innerHTML = html;
                    attachAddToCartFormHandler();
                });
        } else {
            const page = state?.page || location.hash.replace('#', '') || 'home';
            loadPage(page, false);
        }
    });

    // Load trang lần đầu tiên
    const initialPage = location.hash.replace('#', '') || 'home';
    loadPage(initialPage, false);
    history.replaceState({ page: initialPage }, "", location.hash || `#${initialPage}`);
});
