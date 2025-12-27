<?php
$layoutVariant = $layoutVariant ?? 'default';
?>

<div id="sidebar-backdrop" class="backdrop d-none"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<?php if ($layoutVariant === 'payments'): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const body = document.body;
        const sidebar = document.getElementById('admin-sidebar');
        const toggler = document.getElementById('sidebar-toggler');
        const backdrop = document.getElementById('sidebar-backdrop');
        const darkToggle = document.getElementById('dark-mode-toggle');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
        const storedTheme = localStorage.getItem('adminTheme');

        const applyTheme = (mode) => {
            if (mode === 'dark') {
                body.classList.add('dark-mode');
                darkToggle?.classList.add('active');
            } else {
                body.classList.remove('dark-mode');
                darkToggle?.classList.remove('active');
            }
        };

        applyTheme(storedTheme || (prefersDark.matches ? 'dark' : 'light'));

        if (toggler) {
            toggler.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                backdrop.classList.toggle('d-none');
            });
        }

        const closeSidebar = () => {
            sidebar.classList.remove('active');
            backdrop.classList.add('d-none');
        };

        if (backdrop) {
            backdrop.addEventListener('click', closeSidebar);
        }
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });
        document.addEventListener('keydown', (evt) => {
            if (evt.key === 'Escape') {
                closeSidebar();
            }
        });

        if (darkToggle) {
            darkToggle.addEventListener('click', function() {
                body.classList.toggle('dark-mode');
                const mode = body.classList.contains('dark-mode') ? 'dark' : 'light';
                localStorage.setItem('adminTheme', mode);
                this.classList.toggle('active', mode === 'dark');
            });
        }

        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mousemove', (event) => {
                const rect = card.getBoundingClientRect();
                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });
            card.addEventListener('mouseleave', () => {
                card.style.removeProperty('--mouse-x');
                card.style.removeProperty('--mouse-y');
            });
        });

        if (window.AOS) {
            AOS.init({ duration: 650, once: true, offset: 80, easing: 'ease-out-quart' });
        }
    });
</script>
<?php elseif ($layoutVariant === 'properties'): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('admin-sidebar');
        const toggler = document.getElementById('sidebar-toggler');
        const backdrop = document.getElementById('sidebar-backdrop');
        const dropdown = document.querySelector('.topbar .dropdown');

        const toggleSidebar = () => {
            sidebar.classList.toggle('active');
            backdrop.classList.toggle('d-none');
        };

        if (toggler) {
            toggler.addEventListener('click', toggleSidebar);
        }

        const closeSidebar = () => {
            sidebar.classList.remove('active');
            backdrop.classList.add('d-none');
        };

        if (backdrop) {
            backdrop.addEventListener('click', closeSidebar);
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });

        if (dropdown) {
            dropdown.addEventListener('show.bs.dropdown', () => dropdown.classList.add('active'));
            dropdown.addEventListener('hide.bs.dropdown', () => dropdown.classList.remove('active'));
        }

        if (window.AOS) {
            AOS.init({ duration: 650, once: true, offset: 80, easing: 'ease-out-quart' });
        }
    });
</script>
<?php else: ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('admin-sidebar');
        const toggler = document.getElementById('sidebar-toggler');
        const backdrop = document.getElementById('sidebar-backdrop');
        const darkToggle = document.getElementById('dark-mode-toggle');
        
        if (toggler) {
            toggler.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                backdrop.classList.toggle('d-none');
            });
        }
        
        if (backdrop) {
            backdrop.addEventListener('click', function() {
                sidebar.classList.remove('active');
                backdrop.classList.add('d-none');
            });
        }

        if (darkToggle) {
            darkToggle.addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');
            });
        }

        if (window.AOS) {
            AOS.init({ duration: 700, once: true, offset: 80 });
        }
    });
</script>
<?php endif; ?>
</body>
</html>
