(function(window, document, undefined) {

    const $win = window,
        $doc = document,
        $docbody = $win.document.body;

    const init = () => {

        let $menbtn = $doc.querySelector('.menu'),
            $socbtn = $doc.querySelector('.social'),
            $galItem = $doc.querySelectorAll('.gallery-item'),
            $thumb = $doc.querySelectorAll('.thumb'),
            $menItems = $doc.querySelectorAll('.main_menu>.menu-item>a'),
            $totop = $doc.querySelector('.totop'),
            winW = $win.innerWidth,
            winH = $win.innerHeight,
            scrtop,
            lastScrollTop;

        const toggleactive = (event) => {
            this.event.currentTarget.classList.contains('active') ? this.event.currentTarget.classList.remove('active') : this.event.currentTarget.classList.add('active');
        }

        const debounce = (func, delay) => {
            let thetimeout = null;
            return (...args) => {
                $win.clearTimeout(thetimeout);
                thetimeout = $win.setTimeout(() => {
                    func.apply(null, args);
                }, delay);
            };
        }

        const throttle = (func, delay) => {
            let lastCalled = 0;
            return (...args) => {
                let now = new Date().getTime();
                if (now - lastCalled < delay) {
                    return;
                }
                lastCalled = now;
                return func(...args);
            }
        }

        const smoothscroll = (arg) => {
            $docbody.scrollTo({
                top: arg,
                behavior: "smooth"
            });
        }

        const upordown = () => {
            scrtop = $docbody.scrollTop;
            if (scrtop > lastScrollTop && scrtop > 0) {
                $docbody.classList.add('goingdown');
                $docbody.classList.remove('showsoc');
            } else if (scrtop < lastScrollTop && scrtop > 0) {
                $docbody.classList.remove('goingdown');
                $docbody.classList.add('goingup');
            } else if (scrtop === 0) {
                $docbody.classList.remove('goingdown');
                $docbody.classList.remove('goingup');
            }
            lastScrollTop = scrtop;
        }

        const checkSizes = () => {
            winW = $win.innerWidth;
            winH = $win.innerHeight;
            console.log(winW);
        }

        const launchGallery = (mcID, mcInd) => {

            let whichGal = $doc.querySelector('#supergallery-overlay-' + mcID + ''),
                theGal = $doc.querySelector('#carousel-' + mcID + ''),
                $galCloseBtn = $doc.querySelector('.supergallery-closebtn'),
                whichSlide = new Number(mcInd);

            whichGal.classList.add('active');
            $docbody.classList.add('showgal');

            const glider = new Glide(theGal, {
                type: 'carousel',
                startAt: whichSlide,
                perView: 1
            }).mount();

            $galCloseBtn.addEventListener('click', () => {
                whichGal.classList.remove('active');
                $docbody.classList.remove('showgal');
                glider.destroy();
            });
        }

        $galItem.forEach(galItem => {
            galItem.addEventListener('click', (e) => {
                let galID = e.currentTarget.getAttribute('data-id'),
                    galSlide = e.currentTarget.getAttribute('data-num');
                launchGallery(galID, galSlide);
            });
        });

        $menItems.forEach(menItem => {
            menItem.addEventListener('click', (e) => {
                e.preventDefault();
                let el = e.target.getAttribute('href'),
                    elem = document.querySelector(el).offsetTop;
                smoothscroll(elem);
            });
        });

        $totop.addEventListener('click', smoothscroll.bind(0), false);

        $thumb.forEach(thumb => {
            thumb.addEventListener('contextmenu', (e) => { e.preventDefault(); });
        });

        $menbtn.addEventListener('click', toggleactive, false);
        $socbtn.addEventListener('click', toggleactive, false);
        $win.addEventListener('resize', debounce(checkSizes, 500));
        $docbody.addEventListener('scroll', debounce(upordown, 250));
    }

    $doc.onreadystatechange = () => {
        if ($doc.readyState === 'complete') {
            init();
        }
    }

})(window, document);