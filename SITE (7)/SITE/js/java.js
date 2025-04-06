const barra = document.querySelector('.barra');
const opcoes = document.querySelector('.opcoes');
const navbar = document.querySelector('.navbar')

function focoBarra(event){
    if(event.type === 'focus')
    {
        opcoes.classList.add('visible')
        navbar.classList.remove('fixed')
    }
    else if(event.type === 'blur')
    {
        if(window.scrollY > 50 )
        {
            opcoes.classList.remove('visible')
            navbar.classList.add('fixed')
        }
        else
        {

            opcoes.classList.remove('visible')
        }
        
    }

}

barra.addEventListener('focus', focoBarra)
barra.addEventListener('blur', focoBarra)

window.addEventListener('scroll', () =>{
    if (window.scrollY > 50 && !opcoes.classList.contains('visible')) {
        // Adiciona a classe "fixed" à barra de pesquisa
        navbar.classList.add('fixed');
    } else {
        // Remove a classe "fixed" quando voltar ao topo
        navbar.classList.remove('fixed');
    }
})
