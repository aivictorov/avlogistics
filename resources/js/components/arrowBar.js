export function arrowBarInit() {
    const arrowBar = document.querySelector('.arrow-bar__arrow');

    arrowBar.style.backgroundPosition = "0 -48px";
    setTimeout(function () {
        arrowBar.style.backgroundPosition = "0 -96px";
        setTimeout(function () {
            arrowBar.style.backgroundPosition = "0 -48px";
            setTimeout(function () {
                arrowBar.style.backgroundPosition = "0 0";
                setTimeout(function () {
                    arrowBar.style.backgroundPosition = "0 -48px";
                    setTimeout(function () {
                        arrowBar.style.backgroundPosition = "0 -96px";
                        setTimeout(function () {
                            arrowBar.style.backgroundPosition = "0 -48px";
                            setTimeout(function () {
                                arrowBar.style.backgroundPosition = "0 0";
                            }, 100);
                        }, 150);
                    }, 100);
                }, 150);
            }, 100);
        }, 150);
    }, 100);
    setTimeout(arrowBarInit, 3000);
}
