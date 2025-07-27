document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('a[data-page]');
    const main = document.getElementById('content');

    function loadPage(page, updateHistory = true) {
        const url = `./pages/${page}.php`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.text();
            })
            .then(html => {
                main.innerHTML = html;
                
                //pushstate => update history 
                if (updateHistory) {
                    history.pushState({page}, "", `#${page}`);
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

    // click
    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const page = link.dataset.page;
            if (page) {
                loadPage(page);
            }
        });
    });

    //back/forward
    window.addEventListener('popstate', (e) => {
        const page = e.state?.page || location.hash.replace('#', '') || 'home';
        loadPage(page, false);
    });

    // Load trang lan dau
    const initialPage = location.hash.replace('#', '') || 'home';
    loadPage(initialPage, false);
    
    // Push state cho trang hiện tại để xử lý popstate đúng 
    history.replaceState({page: initialPage}, "", location.hash || `#${initialPage}`);
});