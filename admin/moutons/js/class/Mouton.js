class Mouton
{

    constructor(size, posX, posY, num)
    {
        this.size = size;
        this.posX = posX;
        this.posY = posY;
        this.num = num;
        this.numberMove = 0;
        this.direction = 1;
        this.scale = 1;
        this.rotateDirection = 0;
        this.play = null;
        this.sound = 1;
        this.picture = 'mouton.png';

        this.ratio = 0.77;

        this.divHtml = null;
        this.imgHtml = null;
    }

    playSound()
    {

        if (this.play != null && this.play.currentTime == this.play.duration)
        {
            this.play = null;
        }
        this.sound = this.getRandomIntInclusive(1, 5000);

        if (this.sound < 5 && this.play == null) {
            this.play = new Audio(`sound/${this.sound}.mp3`);
            this.play.loop = false;
            this.play.play();
        }
    }

    move(collisionTable)
    {
        this.playSound();

        /** On définie la direction dans lequel se déplacera le mouton */
        if (this.numberMove == 0)
        {
            this.imgHtml.src = 'img/mouton.png';
            this.direction = this.getRandomIntInclusive(-10, 10);
            this.numberMove = this.getRandomIntInclusive(30, 200);
            this.rotateDirection = 0;
            if (this.direction >= -3 && this.direction <= 3 && this.direction!=0)
            {
                this.imgHtml.src = 'img/mouton.gif';
            }
        }

        //If on a une collision on arrête le mouvement
        collisionTable.forEach(zone => {
            let tmpWidth = this.posX + this.size;
            let tmpHeight = Math.round((this.posY + this.size) / this.ratio);
            if (this.posX >= zone[0] && tmpWidth <= zone[1] && this.posY >= zone[2] && tmpHeight <= zone[3]) {
                console.log('Collision' + this.direction);
                this.direction = this.direction * -1;
                console.log('New direction' + this.direction);
            }
        });

        this.numberMove--;

       
        switch (this.direction)
        {
            case -3:
                this.scale = -1;
                this.rotateDirection = 0;
                this.posX++;
                break;
            case -2:
                this.posY++;
                this.posX++; 
                this.rotateDirection = -45;
                this.scale = -1;
                break;
            case -1:
                this.posY--;
                this.posX++; 
                this.rotateDirection = 45;
                this.scale = -1;
                break;
            case 1:
                this.posY++;
                this.posX--;
                this.rotateDirection = -45;
                this.scale = 1;
                break;
            case 2:
                this.posY--;
                this.posX--;
                this.rotateDirection = 45;
                this.scale = 1;
                break;
            case 3:
                this.scale = 1;
                this.rotateDirection = 0;
                this.posX--;
                break;           
        }

        this.divHtml.style.top = `${this.posY}px`;
        this.divHtml.style.left = `${this.posX}px`;
        this.divHtml.style.transform = `scale(${this.scale},1) rotate(${this.rotateDirection}deg)`;
       
    }

    getRandomIntInclusive(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

}