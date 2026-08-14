<?php /** @var string $pageTitle */ ?>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://ireade.github.io/Toast.js/css/Toast.min.css">
<script src="https://ireade.github.io/Toast.js/js/Toast.min.js"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'system-ui', 'sans-serif'],
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
        .adm-card {
            @apply bg-white border border-slate-200 rounded-xl shadow-sm;
        }

        .adm-btn {
            @apply inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100;
        }

        .adm-btn-primary {
            @apply adm-btn bg-blue-600 hover:bg-blue-700 text-white;
        }

        .adm-btn-success {
            @apply adm-btn bg-green-600 hover:bg-green-700 text-white;
        }

        .adm-btn-danger {
            @apply adm-btn text-red-600 hover:text-red-700 hover:bg-red-50;
        }

        .adm-btn-secondary {
            @apply adm-btn border border-slate-200 bg-white text-slate-700 hover:border-blue-600 hover:text-blue-600;
        }

        .adm-input {
            @apply w-full rounded-xl border border-slate-200 bg-white text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 outline-none transition-all duration-200;
        }

        .adm-label {
            @apply block text-sm font-medium text-slate-700 mb-1.5;
        }

        .adm-nav-link {
            @apply flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 rounded-xl transition-all duration-200;
        }

        .adm-nav-link-active {
            @apply flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-100 rounded-xl;
        }

        .adm-table thead tr {
            @apply bg-slate-50 border-b border-slate-200;
        }

        .adm-table thead th {
            @apply px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider;
        }

        .adm-table tbody tr {
            @apply border-b border-slate-100 hover:bg-slate-50 transition-colors duration-200;
        }

        .adm-table tbody td {
            @apply px-4 sm:px-6 py-4 text-sm text-slate-700;
        }

        .adm-badge {
            @apply inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium;
        }

        .adm-badge-amber {
            @apply adm-badge bg-amber-50 text-amber-700 border border-amber-100;
        }

        .adm-badge-blue {
            @apply adm-badge bg-blue-50 text-blue-700 border border-blue-100;
        }

        .adm-badge-green {
            @apply adm-badge bg-green-50 text-green-700 border border-green-100;
        }

        .adm-badge-red {
            @apply adm-badge bg-red-50 text-red-700 border border-red-100;
        }

        .sr-only {
            @apply absolute w-px h-px p-0 -m-px overflow-hidden whitespace-nowrap border-0;
            clip: rect(0, 0, 0, 0);
        }

        body.adm-drawer-open {
            @apply overflow-hidden;
        }
    }
</style>
