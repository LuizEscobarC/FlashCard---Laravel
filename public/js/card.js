const cardFront = document.querySelector('div .card_front');
const cardBack = document.querySelector('div .card_back');
if (cardFront) {
    cardFront.addEventListener('click', (e) => {
        cardFront.style.transform = 'rotateY(180deg)';
        cardBack.style.transform = 'rotateY(0deg)';
        cardFront.style.zIndex = 0;
        cardBack.style.zIndex = 1;
    });
}
if (cardBack) {
    cardBack.addEventListener('click', (e) => {
        cardBack.style.transform = 'rotateY(-180deg)';
        cardFront.style.transform = 'rotateY(0deg)';
        cardBack.style.zIndex = 0;
        cardFront.style.zIndex = 1;
    });
}

// FAZ APARECER MAIS CARDS PARA EDICIONAR
const formCreate = document.querySelector('.main_app_form_edit.create');
if (formCreate) {
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('plus')) {
            const form = document.querySelector('.main_app_form_edit').cloneNode(true);
            form[3].value = '';
            let random = Math.random();
            form.childNodes.forEach( function(nodeValue, keyNode) {
                if (nodeValue.nodeName === 'LABEL') {
                    nodeValue.setAttribute('for', random);
                }
            });
            form[3].setAttribute('id', random);
            document.querySelector('.main_form_edit').appendChild(form);
            window.scrollTo(null, 1000000)
        }
    })
}

// FAZ APARECER MAIS CARDS PARA EDICIONAR
const formEdit = document.querySelector('.main_app_form_edit.edit');
if (formEdit) {
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('plus')) {
            const form = document.querySelector('.main_app_form_edit').cloneNode(true);
            form[4].value = '';
            document.querySelector('.main_form_edit').appendChild(form);
            window.scrollTo(null, 1000000)
        }
    })
}


