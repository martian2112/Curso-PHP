(function () {
    const menutoggle = document.querySelector('.menu-toggle')
    menutoggle.onclick = function (e){
        const body = document.querySelector('body')
        body.classList.toggle('hide-sidebar')
    }    
})()
