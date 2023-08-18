var links = document.querySelectorAll(".side__link");
 
links.forEach(link => {
    link.addEventListener('click', () =>{
        document.querySelector('.active')?.classList.remove('active');
        link.classList.add('active');
    });
});