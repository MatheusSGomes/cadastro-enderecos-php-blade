const btnAdicionarEndereco = document.querySelector('#adicionar-endereco');
const divEnderecos = document.querySelector('#enderecos');



const divEndereco = document.querySelector('.endereco');

const elementClone = divEndereco.cloneNode(true);

elementClone.querySelector('#rua').setAttribute('name', `endereco[2][rua]`);
elementClone.querySelector('#numero').setAttribute('name', `endereco[2][numero]`);
elementClone.querySelector('#bairro').setAttribute('name', `endereco[2][bairro]`);
elementClone.querySelector('#cep').setAttribute('name', `endereco[2][cep]`);
elementClone.querySelector('#uf').setAttribute('name', `endereco[2][uf]`);
elementClone.querySelector('#municipio').setAttribute('name', `endereco[2][municipio]`);
elementClone.querySelector('#complemento').setAttribute('name', `endereco[2][complemento]`);

elementClone.querySelectorAll('input').forEach(input => {
  input.value = '';
  console.log(input);
});


divEndereco.after(elementClone);



// function gerarEndereco() {
// }

// const h2 = document.createElement('h2');
// h2.classList.add('endereco');

btnAdicionarEndereco.addEventListener('click', (event) => {
  event.preventDefault();
  console.log(event.target);
});
