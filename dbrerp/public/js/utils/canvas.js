class Canvas {
    #paint;
    #canvas;
    #context;
    #clickX = new Array();
    #clickY = new Array();
    #clickDrag = new Array();

    constructor(frame_id, canvas_id) {
        let canvas_div = document.getElementById(frame_id);
        this.#canvas = document.createElement('canvas');
        // this.#canvas.setAttribute('style', 'width:100%;height:100%;');

        // this.#canvas.setAttribute('width', 1516);
        // this.#canvas.setAttribute('height', 165);
        this.#canvas.setAttribute('id', canvas_id);
        this.#canvas.setAttribute('class', 'canvas');
        canvas_div.appendChild(this.#canvas);
        if (typeof G_vmlCanvasManager != 'undefined') {
            this.#canvas = G_vmlCanvasManager.initElement(this.#canvas);
        }
        this.#context = this.#canvas.getContext("2d");

        this.attachEvent(canvas_id)
    }

    getCanvasSize() {
        return this.#canvas.getAttribute('height')
    }

    setCanvasSize(width, height) {
        this.#canvas.setAttribute('width', width);
        this.#canvas.setAttribute('height', height);
    }

    getClickX() {
        return [...this.#clickX]
    }
    setClickX(value) {
        this.#clickX = value;
    }

    getClickY() {
        return [...this.#clickY]
    }
    setClickY(value) {
        this.#clickY = value;
    }

    getClickDrag() {
        return [...this.#clickDrag]
    }
    setClickDrag(value) {
        this.#clickDrag = value;
    }

    setCanvasWidth(value) {
        this.#canvas.width = value;
    }

    setCanvasHeight(value) {
        this.#canvas.height = value;
    }

    addClick(x, y, dragging) {
        this.#clickX.push(x);
        this.#clickY.push(y);
        this.#clickDrag.push(dragging);

        // console.log(this.#clickX)
        // console.log(this.#clickY)
        // console.log(this.#clickDrag)
    }

    redraw() {
        this.#context.clearRect(0, 0, this.#context.canvas.width, this.#context.canvas.height); // Clears the canvas
        this.#context.strokeStyle = "#df4b26";
        this.#context.lineJoin = "round";
        this.#context.lineWidth = 2;

        for (var i=0; i < this.#clickX.length; i++) {
            this.#context.beginPath();
            if (this.#clickDrag[i] && i) {
                this.#context.moveTo(this.#clickX[i-1], this.#clickY[i-1]);
            } else {
                this.#context.moveTo(this.#clickX[i]-1, this.#clickY[i]);
            }
            this.#context.lineTo(this.#clickX[i], this.#clickY[i]);
            this.#context.closePath();
            this.#context.stroke();
        }
    }

    clearCanvas() {
        this.#clickX = [];
        this.#clickY = [];
        this.#clickDrag = [];
        this.#context.clearRect(0, 0, this.#canvas.width, this.#canvas.height); //clear canvas
    }

    attachEvent() {
        // PC
        this.#canvas.addEventListener('mousedown', (e)=>{
            let offset = $(e.target).offset()
            let mouseX = e.pageX - this.offsetLeft;
            let mouseY = e.pageY - this.offsetTop;

            this.#paint = true;
            this.addClick(e.pageX - offset.left, e.pageY - offset.top);
            this.redraw();
        });

        this.#canvas.addEventListener('mousemove', (e)=>{
            if (this.#paint) {
                let offset = $(e.target).offset()
                this.addClick(e.pageX - offset.left, e.pageY - offset.top, true);
                this.redraw();
            }
        });

        // 모바일
        this.#canvas.addEventListener('touchstart', (e)=>{
            let offset = $(e.target).offset()
            let mouseX = e.pageX - this.offsetLeft;
            let mouseY = e.pageY - this.offsetTop;

            this.#paint = true;
            this.addClick(e.pageX - offset.left, e.pageY - offset.top);
            this.redraw();
        });

        this.#canvas.addEventListener('touchmove', (e)=>{
            if (this.#paint) {
                const touch = e.touches[0];
                const mouseEvent = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                const offset = $(e.target).offset()
                this.addClick(mouseEvent.pageX - offset.left, mouseEvent.pageY - offset.top, true);
                this.redraw();
            }
        });

        this.#canvas.addEventListener('mouseup', (e)=>{
            this.#paint = false;
        });

        this.#canvas.addEventListener('mouseleave', (e)=>{
            this.#paint = false;
        });
    }
}
