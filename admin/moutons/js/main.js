'use strict';
let maBergerie;


document.addEventListener('DOMContentLoaded',function(){

    maBergerie = new Bergerie();

    document.querySelector('#howMany').addEventListener('submit', function(e){
        e.preventDefault();
        let howManyField = document.querySelector('#howManyField');
        maBergerie.nbMoutons = howManyField.value;
        this.classList.add('hidden');
        
        maBergerie.generate();

        window.requestAnimationFrame(maBergerie.life.bind(maBergerie));
    });

   

    

});