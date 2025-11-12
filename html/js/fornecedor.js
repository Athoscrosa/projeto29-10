import { Validate } from "./Validate.js";

const InsertButton = document.getElementById('insert');

$('#cpf_cnpj').inputmask({"mask": ["999.999.999-99", "99.999.999/9999-99"]});

$('#celular').inputmask({"mask": ["(69) 99999-9999"] });

InsertButton.addEventListener('click', async () => {
    const IsValid = Validate
        .SetId('form')
        .Validate();
});