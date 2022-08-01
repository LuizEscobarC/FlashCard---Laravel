// INICIO AJAX FETCH FUNCTION
async function ajax(method, url, contentType, data) {
    const callback = await fetch(url, {
        method: method,
        body: data
    })

    return callback.json();
}
// FIM AJAX FETCH FUNCTION

// INICIO FACAGE CREATE CARDS
async function getCards(method, url, contentType, data) {
    const response = await ajax(method, url, contentType, data);

    if (response.message) {
        alert(response.message);
        location.href = response.href;
    }
}
// FIM FACAGE CREATE CARDS

// INICIO FACAGE QUE CADASTRA UMA FOLDER
async function getFolder(method, url, contentType, data) {
    const response = await ajax(method, url, contentType, data);

    if (response.folderId) {
        createCards(response.folderId)
        return;
    }

    if (response.message) {
        alert(response.message);
    }
}
// FIM CADASTRA FOLDER

// INICIO DELETA FOLDER
async function deleteFolder(method, url, contentType, data) {
    const response = await ajax(method, url, contentType, data);

    if (response.message) {
        alert(response.message);
        if (response.href) {
            location.href = response.href;
        }
    }
}
// FIM DELETA FOLDER

// REGRA DE NEGÓCIO DOS CARDS
const createCards = async (folderId) => {
    if (typeof folderId !== 'number') {
        alert('Não foi possível cadastrar. Volte mais tarde!');
        throw new Error({'folder_id': folderId});
    }
    const newFormData = new FormData();
    const formCards = document.querySelectorAll('.main_app_form_edit');
    const url = formCards[0].getAttribute('action');
    const method = formCards[0].getAttribute('method');
    let i = 1;
    for (element of formCards) {
        ++i;
        let file = '';
        const formData = (new FormData(element));
        formData.append('folder_id', folderId);
        let elementFileInput = element[3];
        if (elementFileInput.files.length !== 0) {
            file = elementFileInput.files[0];
        } else {
            file = '';
        }
        newFormData.append((i * 1000), file);
        newFormData.append(i, (new URLSearchParams(formData)));
    }

    newFormData.append('_token', document.querySelector('input[name="_token"]').value)
    getCards(method, url, 'multipart/form-data', newFormData);
}
// FIM DA REGRA DE NEGÓCIO DOS CARDS

// REGRA DE NEGÓCIO DOS CARDS UPDATE
const updateCards = async () => {
    const newFormData = new FormData();
    const formCards = document.querySelectorAll('.main_app_form_edit.edit');
    const formFolder = new FormData(document.querySelector('.main_app_form.edit'));
    const url = formCards[0].getAttribute('action');
    const method = formCards[0].getAttribute('method');
    let i = 1;
    for (element of formCards) {
        const formData = (new FormData(element));
        let file = '';
        ++i;

        let elementFileInput = element[4];
        if (elementFileInput.files.length !== 0) {
            file = elementFileInput.files[0];
        } else {
            file = '';
        }
        newFormData.append((i * 1000), file);
        newFormData.append(i, (new URLSearchParams(formData)));
    }

    newFormData.append('folder', new URLSearchParams(formFolder).toString());
    newFormData.append('_token', document.querySelector('input[name="_token"]').value)
    getCards(method, url, 'multipart/form-data', newFormData);
}
// FIM DA REGRA DE NEGÓCIO DOS CARDS UPDATE


// INICIO CALL CREATE CARDS
const hasCreate = document.querySelector('.main_app_form_edit:not(.edit)');
if (hasCreate) {
    document.querySelector('#submit_button').addEventListener('click', (e) => {
        e.preventDefault();
        const folderForm = document.querySelector('.main_app_form');
        const url = folderForm.getAttribute('action');
        const method = folderForm.getAttribute('method');
        getFolder(method, url, 'application/json', new FormData(folderForm));
    })
}
// FIM CALL UPDATE CARDS

// INICIO CALL UPDATE CARDS
const hasUpdate = document.querySelector('.main_app_form_edit.edit');
if (hasUpdate) {
    document.querySelector('#submit_button').addEventListener('click', (e) => {
        e.preventDefault();
        updateCards();
    })
}
// FIM CALL UPDATE CARDS

// INICIO DELETE FOLDER BUTTON ACTION
const hasButtonFolder = document.querySelector('#delete_button');
if (hasButtonFolder) {
    const url = hasButtonFolder.getAttribute('href');
    hasButtonFolder.addEventListener('click', (e) => {
        e.preventDefault()
        const confirmDelete = confirm('Deseja mesmo apagar essa pasta inteira?');
        if (confirmDelete) {
            const data = {'_token': document.querySelector('input[name="_token"]').value};
            deleteFolder('post', url, '', new URLSearchParams(data));
        }
    })
}
// FIM DELETE FOLDER BUTTON ACTION
