class Bergerie
{

    constructor()
    {
        this.width= window.innerWidth;
        this.height = window.innerHeight;
        this.nbMoutons = 0;
        this.moutons = new Array();

        this.colisionTable = new Array();
    }

    generate()
    {
        let bergerieHtml = document.querySelector('#bergerie');
        bergerieHtml.innerHTML = '';

        if (this.nbMoutons > 0)
        {
            for (let i = 1; i <= this.nbMoutons;i++)
            {
                let size = this.getRandomIntInclusive(70, 150);
                let posX = this.getRandomIntInclusive(0, this.width - 50);
                let posY = this.getRandomIntInclusive(0, this.height - 50);

                let mouton = new Mouton(size, posX, posY, i);
                this.moutons.push(mouton);

                /** Generate HTML */
                let div = document.createElement('div');
                div.id = `${mouton.num}`;
                div.style.top = `${mouton.posY}px`;
                div.style.left = `${mouton.posX}px`;
                div.style.transform = `scale(${mouton.scale},1) rotate(${mouton.rotateDirection}deg)`;
                div.classList.add('mouton');

                let img = document.createElement('img');
                img.src = `img/${mouton.picture}`;
                img.style.width = `${mouton.size}px`;

                div.appendChild(img);
            
                bergerieHtml.appendChild(div);

                /** Update DOM object on mouton object */
                mouton.divHtml = div;
                mouton.imgHtml = img;
            }
        }
    }

    life()
    {
        let previousCollision = this.colisionTable;

        this.colisionTable = new Array();
        
        this.moutons.forEach((mouton,num) => {
            mouton.move(previousCollision);
            this.colisionTable.push([mouton.posX, mouton.posX + mouton.size, mouton.posY, Math.round(mouton.posY + (mouton.size * mouton.ratio))]);
        });

        window.requestAnimationFrame(this.life.bind(this));
    }

    getRandomX()
    {
        return this.getRandomIntInclusive(0,this.width-50);
    }
    getRandomY() {
        return this.getRandomIntInclusive(0, this.height-50);
    }
    getRandomSize() {
        return this.getRandomIntInclusive(70, 150);
    }

    getRandomIntInclusive(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

}