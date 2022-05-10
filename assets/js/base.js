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

        const upordown = () => {
            scrtop = $docbody.scrollTop;
            if (scrtop > lastScrollTop) {
                $docbody.classList.add('goingdown');
                $docbody.classList.remove('showsoc');
            } else if (scrtop < lastScrollTop || scrtop === 0) {
                $docbody.classList.remove('goingdown');
            }
            lastScrollTop = scrtop;
        }

        const checkSizes = () => {
            winW = $win.innerWidth;
            console.log(winW);
        }

        const launchGallery = (mcID, mcInd) => {

            let whichGal = $doc.querySelector('#supergallery-overlay-' + mcID + ''),
                theGal = $doc.querySelector('#carousel-' + mcID + ''),
                $galCloseBtn = $doc.querySelector('.controlbtn.closebtn'),
                whichSlide = new Number(mcInd) + 1;

            whichGal.classList.add('active');
            $docbody.classList.add('showgal');
            theGal.index = whichSlide;
            theGal.translateSlide(whichSlide);

            $galCloseBtn.addEventListener('click', () => {
                whichGal.classList.remove('active');
                theGal.index = 0;
                theGal.resetSlide(0);
                theGal.translateSlide(0);
                $docbody.classList.remove('showgal');
            });
        }

        $galItem.forEach(galItem => {
            galItem.addEventListener('click', (e) => {
                let galID = e.currentTarget.getAttribute('data-id'),
                    galSlide = e.currentTarget.getAttribute('data-num');

                launchGallery(galID, galSlide);
            });
        });

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