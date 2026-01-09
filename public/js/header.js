'use strict';

document.addEventListener('DOMContentLoaded', () => {
    if (window.AOS) {
        AOS.init({ once: true, duration: 600, offset: 120 });
    }

    const loaderEl = document.getElementById('pageLoader');
    if (loaderEl) {
        const percentEl = loaderEl.querySelector('[data-loader-percent]');
        const barEl = loaderEl.querySelector('[data-loader-bar]');
        let progress = 0;
        const updateProgress = (value) => {
            progress = Math.min(100, value);
            if (barEl) {
                barEl.style.width = `${progress}%`;
            }
            if (percentEl) {
                percentEl.textContent = `${progress}%`;
            }
        };
        const idleCeiling = 90;
        const intervalId = window.setInterval(() => {
            if (progress >= idleCeiling) {
                return;
            }
            updateProgress(progress + 1);
        }, 20);
        const finalizeLoader = () => {
            window.clearInterval(intervalId);
            const stepToComplete = () => {
                if (progress >= 100) {
                    loaderEl.classList.add('is-hidden');
                    loaderEl.addEventListener('transitionend', () => {
                        loaderEl.remove();
                    }, { once: true });
                    return;
                }
                updateProgress(progress + 1);
                window.requestAnimationFrame(stepToComplete);
            };
            stepToComplete();
        };
        if (document.readyState === 'complete') {
            finalizeLoader();
        } else {
            window.addEventListener('load', finalizeLoader, { once: true });
        }
    }

    const megaToggleSelector = '[data-mega-toggle="true"]';
    const megaToggles = Array.from(document.querySelectorAll(megaToggleSelector));

    if (!megaToggles.length) {
        return;
    }

    const widthQuery = window.matchMedia('(min-width: 992px)');
    const finePointerQuery = window.matchMedia('(hover: hover) and (pointer: fine)');
    let currentOpenToggle = null;

    const megaSections = Array.from(
        new Set(
            megaToggles
                .map((toggle) => document.querySelector(toggle.getAttribute('data-mega-target')))
                .filter(Boolean)
        )
    );

    const isDesktop = () => widthQuery.matches && finePointerQuery.matches;

    const getMenuForToggle = (toggle) => {
        const selector = toggle.getAttribute('data-mega-target');
        return selector ? document.querySelector(selector) : null;
    };

    const setMenuHeight = (menu, expanded) => {
        if (!menu) {
            return;
        }
        if (isDesktop()) {
            menu.style.removeProperty('maxHeight');
            menu.style.removeProperty('overflow');
            return;
        }
        if (expanded) {
            menu.style.maxHeight = 'none';
            const targetHeight = menu.scrollHeight;
            menu.style.overflow = 'visible';
            menu.style.maxHeight = `${targetHeight}px`;
        } else {
            menu.style.overflow = 'hidden';
            menu.style.maxHeight = '0px';
        }
    };

    const openMega = (toggle) => {
        const menu = getMenuForToggle(toggle);
        if (!menu) {
            return;
        }
        if (currentOpenToggle && currentOpenToggle !== toggle) {
            closeMega(currentOpenToggle);
        }
        requestAnimationFrame(() => {
            toggle.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-hidden', 'false');
            menu.classList.add('active', 'show');
            toggle.closest('.has-megamenu')?.classList.add('mega-open');
            setMenuHeight(menu, true);
            currentOpenToggle = toggle;
        });
    };

    const closeMega = (toggle) => {
        const menu = getMenuForToggle(toggle);
        if (!menu) {
            return;
        }
        requestAnimationFrame(() => {
            toggle.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-hidden', 'true');
            menu.classList.remove('active', 'show');
            toggle.closest('.has-megamenu')?.classList.remove('mega-open');
            setMenuHeight(menu, false);
            if (currentOpenToggle === toggle) {
                currentOpenToggle = null;
            }
        });
    };

    const closeAllMegas = () => {
        megaToggles.forEach((toggle) => closeMega(toggle));
        currentOpenToggle = null;
    };

    const toggleMenu = (toggle) => {
        if (toggle.getAttribute('aria-expanded') === 'true') {
            closeMega(toggle);
        } else {
            openMega(toggle);
        }
    };

    const syncAllSections = () => {
        megaSections.forEach((section) => {
            const isActive = section.classList.contains('show');
            setMenuHeight(section, isActive);
        });
    };

    const handleBreakpointChange = () => {
        closeAllMegas();
        syncAllSections();
    };

    const watchMediaQuery = (mq) => {
        if (!mq) {
            return;
        }
        if (typeof mq.addEventListener === 'function') {
            mq.addEventListener('change', handleBreakpointChange);
        } else if (typeof mq.addListener === 'function') {
            mq.addListener(handleBreakpointChange);
        }
    };

    watchMediaQuery(widthQuery);
    watchMediaQuery(finePointerQuery);
    syncAllSections();

    megaToggles.forEach((toggle) => {
        toggle.addEventListener('click', (event) => {
            if (isDesktop()) {
                return;
            }
            event.preventDefault();
            toggleMenu(toggle);
        });

        toggle.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                toggleMenu(toggle);
            } else if (event.key === 'Escape') {
                closeMega(toggle);
            }
        });

        const parentItem = toggle.closest('.has-megamenu');
        if (!parentItem) {
            return;
        }

        parentItem.addEventListener('pointerenter', () => {
            if (!isDesktop()) {
                return;
            }
            openMega(toggle);
        });

        parentItem.addEventListener('pointerleave', () => {
            if (!isDesktop()) {
                return;
            }
            closeMega(toggle);
        });

        parentItem.addEventListener('focusout', (event) => {
            if (!isDesktop()) {
                return;
            }
            if (event.relatedTarget && parentItem.contains(event.relatedTarget)) {
                return;
            }
            closeMega(toggle);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape' || !currentOpenToggle) {
            return;
        }
        closeMega(currentOpenToggle);
        currentOpenToggle?.focus();
    });

    document.addEventListener('click', (event) => {
        if (!isDesktop() || !currentOpenToggle) {
            return;
        }
        if (event.target.closest('.has-megamenu')) {
            return;
        }
        closeAllMegas();
    });

    window.addEventListener('resize', () => {
        syncAllSections();
    });

    const offcanvasEl = document.getElementById('offcanvasNavbar');
    if (offcanvasEl) {
        offcanvasEl.addEventListener('hidden.bs.offcanvas', () => {
            closeAllMegas();
            syncAllSections();
        });
    }

    window.bookinghubMegaMenu = { openMega, closeMega, closeAllMegas };
});
