(() => {

/* Forms register or request Wallet */

let buttonRequestWallet = document.querySelectorAll('.button-previous');
let buttonCreateWallet = document.querySelectorAll('.button-next');

for(i = 0; i < buttonCreateWallet.length; i++){
    buttonCreateWallet[i].addEventListener('click', formBoxCreateWallet);
}

for(i = 0; i < buttonRequestWallet.length; i++){
    buttonRequestWallet[i].addEventListener('click', formBoxRequestWallet);
}

function formBoxCreateWallet()
{
    let formRequestWallet = document.querySelector('.form-request-wallet');
    let formCreateWallet = document.querySelector('.form-create-wallet');

    if(formCreateWallet.classList.contains('hide')){
        formCreateWallet.classList.remove('hide');
        formRequestWallet.classList.add('hide');
    }else{
        formCreateWallet.classList.add('hide');
    }

}

function formBoxRequestWallet()
{
    let formRequestWallet = document.querySelector('.form-request-wallet');
    let formCreateWallet = document.querySelector('.form-create-wallet');

    if(formRequestWallet.classList.contains('hide')){
        formRequestWallet.classList.remove('hide');
        formCreateWallet.classList.add('hide');
    }else{
        formRequestWallet.classList.add('hide');
    }

}

})();

