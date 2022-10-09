const btnAdicionarEndereco = document.querySelector('#adicionar-endereco');
const btnRemoverEndereco = document.querySelector('#remover-endereco');
const divEnderecos = document.querySelector('#enderecos');
const enderecos = document.querySelectorAll('.endereco');

let contador = enderecos.length;

function cloneEndereco() {
  contador += 1;

  const divEndereco = document.querySelector('.endereco');
  const elementClone = divEndereco.cloneNode(true);

  elementClone.querySelector('#rua').setAttribute('name', `enderecos[${contador}][rua]`);
  elementClone.querySelector('#numero').setAttribute('name', `enderecos[${contador}][numero]`);
  elementClone.querySelector('#bairro').setAttribute('name', `enderecos[${contador}][bairro]`);
  elementClone.querySelector('#cep').setAttribute('name', `enderecos[${contador}][cep]`);
  // elementClone.querySelector('#uf').setAttribute('name', `enderecos[${contador}][uf]`);
  // elementClone.querySelector('#municipio').setAttribute('name', `enderecos[${contador}][municipio]`);
  elementClone.querySelector('#complemento').setAttribute('name', `enderecos[${contador}][complemento]`);
  elementClone.querySelectorAll('input').forEach(input => input.value = '');
  elementClone.querySelector('#remover-endereco').classList.remove('d-none');
  
  divEndereco.before(elementClone);
}

function removeEndereco(event) {
  event.target.parentNode.remove();
}

btnAdicionarEndereco.addEventListener('click', cloneEndereco);
btnRemoverEndereco.addEventListener('click', removeEndereco);
