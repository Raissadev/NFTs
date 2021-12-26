(() => {

//Toggle for Mobile
let toggle = document.querySelectorAll('.toggle');
let asideNav = document.querySelector('.aside-nav');

for(i = 0; i < toggle.length; i++){
    toggle[i].addEventListener('click', openMenu);
}

function openMenu()
{
    if(asideNav.classList.contains('hide-dv-small')){
        asideNav.classList.remove('hide-dv-small');
    }else{
        asideNav.classList.add('hide-dv-small');
    }
}

/* Session Message */
setTimeout(function(){ 
    document.querySelector('.alert').remove();   
}, 3000);

})();

