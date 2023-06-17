<style>
.action-buttons {
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.action-buttons button {
    margin-right: 5px;
}
</style>

<h1>Clientes</h1>
<div class="row">
    <div class="col-md-3">
        <input type="text" id="nome" class="form-control" placeholder="Nome Completo">
    </div>
    <div class="col-md-3">
        <input type="email" id="email" class="form-control" placeholder="E-mail">
    </div>
    <div class="col-md-3">
        <input type="password" id="senha" class="form-control" placeholder="Senha">
    </div>
    <div class="col-md-3">
        <button id="salvar" onclick="save()" class="btn btn-primary">Salvar</button>
    </div>
</div>
<hr>
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="tabela">
    </tbody>
</table>
<script>
load();
var clientes = [];

function load() {
    let table = document.getElementById('tabela');
    table.innerHTML = "";
    fetch('<?= BASE_URL ?>/backend/dados.php?table=usuarios')
        .then(response => response.json())
        .then(data => {
            console.log('Data:', data);
            // Clear previous rows
            while (table.rows.length > 1) {
                table.deleteRow(-1);
            }
            if (Array.isArray(data)) {
                clientes = data;
                data.forEach(element => {
                    let linha = table.insertRow();
                    linha.id = 'row-' + element[0];
                    linha.insertCell().innerHTML = element[0];
                    linha.insertCell().innerHTML = element[1];
                    linha.insertCell().innerHTML = element[2];
                    let editButton = '<button onclick="edit(' + element[0] +
                        ')" class="btn btn-primary">Editar</button>';
                    let removeButton = '<button onclick="remove(' + element[0] +
                        ')" class="btn btn-danger">Excluir</button>';
                    let cell = linha.insertCell();
                    cell.classList.add('action-buttons');
                    cell.innerHTML = editButton + ' ' + removeButton;
                    // linha.insertCell().innerHTML = editButton + ' ' + removeButton;
                });

            } else {
                console.error('Response data is not an array:', data);
            }
        })
        .catch(
            error => console.log(error)
        );
}

var clienteEditando = null;

function save() {
    let nome = document.getElementById('nome').value;
    let email = document.getElementById('email').value;
    let senha = document.getElementById('senha').value;
    fetch('<?= BASE_URL ?>/backend/save.php', {
        method: 'POST',
        body: JSON.stringify({
            nome: nome,
            email: email,
            senha: senha,
            id: clienteEditando
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(
        response => {
            console.log('Response:', response.body);
            response.json().then(
                data => {
                    clearFields();
                    clienteEditando = null;
                    clientes = [];
                    load();
                    console.log('Data:', data);
                    window.alert('Cliente salvo com sucesso!');
                }
            )
        }
    ).catch(
        error => {
            console.log(error);
            console.log('Error in POST request to save.php');
        }
    );
}

function clearFields() {
    document.getElementById('nome').value = "";
    document.getElementById('email').value = "";
    document.getElementById('senha').value = "";
}


function remove(id) {
    fetch(`<?= BASE_URL ?>/backend/remove.php?id=${id}`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(response.statusText);
            }
            return response.text();
        })
        .then(data => {
            // handle successful response
            window.alert('Cliente removido com sucesso!');
            load();
        })
        .catch(error => {
            // handle error
            console.log('Error:', error);
            window.alert('Erro ao remover cliente!');
        });

}

function edit(id) {
    let cliente = clientes.find(element => element[0] == id);
    document.getElementById('nome').value = cliente[1];
    document.getElementById('email').value = cliente[2];
    document.getElementById('senha').value = "";
    clienteEditando = cliente[0];

}
</script>