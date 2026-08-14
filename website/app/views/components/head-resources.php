<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'system-ui', 'sans-serif'],
                },
                colors: {
                    surface: '#F8FAFC',
                    primary: {
                        50: '#EFF6FF',
                        100: '#DBEAFE',
                        500: '#2563EB',
                        600: '#2563EB',
                        700: '#1D4ED8',
                    },
                    cta: {
                        500: '#2563EB',
                        600: '#1D4ED8',
                    },
                    ink: {
                        DEFAULT: '#334155',
                        50: '#F8FAFC',
                        100: '#F1F5F9',
                        200: '#E2E8F0',
                        300: '#CBD5E1',
                        400: '#94A3B8',
                        500: '#64748B',
                        600: '#475569',
                        700: '#334155',
                        800: '#1E293B',
                        900: '#0F172A',
                    },
                    accent: {
                        50: '#EFF6FF',
                        100: '#DBEAFE',
                        500: '#2563EB',
                        600: '#2563EB',
                        700: '#1D4ED8',
                    },
                },
                boxShadow: {
                    soft: '0 1px 2px 0 rgb(0 0 0 / 0.05)',
                    lift: '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)',
                    card: '0 1px 2px 0 rgb(0 0 0 / 0.05)',
                },
            },
        },
    };
</script>
<style type="text/tailwindcss">
    @layer base {
        body {
            @apply font-sans bg-slate-50 text-slate-700 antialiased overflow-x-hidden;
        }
    }

    @layer components {
        /* Card */
        .ds-card {
            @apply rounded-2xl border border-slate-200 bg-white shadow-sm;
        }

        /* Buttons */
        .ds-btn {
            @apply inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100;
        }

        .ds-btn-primary {
            @apply inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100 bg-blue-600 hover:bg-blue-700 text-white;
        }

        .ds-btn-success {
            @apply inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100 bg-green-600 hover:bg-green-700 text-white;
        }

        .ds-btn-danger {
            @apply inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl text-red-600 hover:text-red-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-100;
        }

        .ds-btn-secondary {
            @apply inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100 border border-slate-200 bg-white text-slate-700 hover:border-blue-600 hover:text-blue-600;
        }

        .ds-btn-outline {
            @apply inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100 border border-slate-200 bg-white text-slate-700 hover:border-blue-600 hover:text-blue-600;
        }

        /* Form */
        .ds-label {
            @apply block text-sm font-medium text-slate-700 mb-1.5;
        }

        .ds-input {
            @apply w-full rounded-xl border border-slate-200 bg-white text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 outline-none transition-all duration-200;
        }

        .ds-error {
            @apply text-sm text-red-600 mt-1;
        }

        .ds-success-text {
            @apply text-sm text-green-600 mt-1;
        }

        /* Banner */
        .ds-banner {
            @apply rounded-[20px];
        }

        /* Typography */
        .ds-heading-lg {
            @apply text-slate-900 font-bold;
        }

        .ds-heading-sm {
            @apply text-slate-900 font-semibold;
        }

        .ds-text-body {
            @apply text-slate-700;
        }

        .ds-text-muted {
            @apply text-slate-500;
        }

        .ds-price {
            @apply text-blue-600 font-semibold;
        }

        /* Icons */
        .ds-icon {
            @apply w-5 h-5 text-slate-500 transition-colors duration-200;
        }

        .ds-icon-brand {
            @apply w-5 h-5 text-blue-600;
        }

        .ds-icon-success {
            @apply w-5 h-5 text-green-600;
        }

        .ds-icon-danger {
            @apply w-5 h-5 text-red-600;
        }

        /* Navigation */
        .ds-nav-link {
            @apply text-sm font-medium text-slate-500 hover:text-blue-600 transition-all duration-200;
        }

        .ds-nav-link-active {
            @apply text-sm font-medium text-blue-600;
        }

        /* Header action icon button */
        .ds-header-action {
            @apply flex flex-col items-center justify-center px-2.5 py-2 text-slate-500 hover:text-blue-600 rounded-xl transition-all duration-200;
        }

        /* Empty state */
        .ds-empty-state {
            @apply bg-white border border-slate-200 rounded-2xl shadow-sm;
        }

        /* Skeleton — match product card dimensions */
        .ds-skeleton-card {
            @apply flex flex-col;
        }

        .ds-skeleton-card .aspect-square {
            min-height: 0;
        }

        /* Screen reader only */
        .sr-only {
            @apply absolute w-px h-px p-0 -m-px overflow-hidden whitespace-nowrap border-0;
            clip: rect(0, 0, 0, 0);
        }

        /* Drawer open — prevent horizontal overflow */
        body.ds-drawer-open {
            @apply overflow-hidden;
        }
    }
</style>
<script>
    (function() {
        /* Brief skeleton flash while images load — prevents layout shift */
        document.querySelectorAll('[data-product-grid]').forEach(function(wrap) {
            var layer = wrap.querySelector('[data-skeleton-layer]');
            var content = wrap.querySelector('[data-product-content]');
            if (!layer || !content) return;

            var imgs = content.querySelectorAll('img');
            if (!imgs.length) return;

            var pending = imgs.length;
            layer.classList.remove('hidden');

            function done() {
                pending--;
                if (pending <= 0) {
                    layer.classList.add('hidden');
                }
            }

            imgs.forEach(function(img) {
                if (img.complete) {
                    done();
                } else {
                    img.addEventListener('load', done, { once: true });
                    img.addEventListener('error', done, { once: true });
                }
            });

            setTimeout(function() {
                layer.classList.add('hidden');
            }, 3000);
        });
    })();
</script>
<link rel="stylesheet" href="/web-ban-hang/website/app/views/styles.css" />
