<!DOCTYPE html>
<html>
<head>
    <!-- ... -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }

        .fade-enter {
            opacity: 0;
            transform: translateY(20px);
        }

        .fade-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 300ms, transform 300ms;
        }

        .fade-exit {
            opacity: 1;
        }

        .fade-exit-active {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 300ms, transform 300ms;
        }

        .page-transition {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #FF6B00;
            transform: scaleY(0);
            transform-origin: bottom;
            z-index: 1000;
        }
    </style>
</head>
<body x-data="{ pageLoading: false }">
    <div class="page-transition"></div>
    <main x-show="!pageLoading"
          x-transition:enter="fade-enter-active"
          x-transition:enter-start="fade-enter"
          x-transition:leave="fade-exit-active"
          x-transition:leave-end="fade-exit">
        @yield('content')
    </main>

    <script>
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && link.href.startsWith(window.location.origin)) {
                e.preventDefault();

                const tl = gsap.timeline();
                tl.to('.page-transition', {
                    scaleY: 1,
                    duration: 0.5,
                    ease: 'power4.inOut'
                }).to('.page-transition', {
                    scaleY: 0,
                    transformOrigin: 'top',
                    duration: 0.5,
                    ease: 'power4.inOut',
                    delay: 0.1,
                    onComplete: () => {
                        window.location = link.href;
                    }
                });
            }
        });
    </script>
</body>
</html>