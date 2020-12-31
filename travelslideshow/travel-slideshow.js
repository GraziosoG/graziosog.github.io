var img_src = new Array("agra_fort.jpg", "ajanta_ellora.jpeg", "akshardham_temple.jpg", "gateway_of_india.jpg", "hawa_mahal.jpeg", "mehrangarh_fort.jpg", "mysore_palace.jpeg", "qutub_minar.jpg", "sun_temple.jpg", "taj_mahal.jpeg", "victoria_memorial.jpg");
var curr = 0;
var state = 0; // 1 is end, 0 is start
var pic;
pic = setInterval(display, 3000); 

function endShow() {
    state = 1;
}

function startShow() {
    state = 0;
    clearInterval(pic);
    pic = setInterval(display, 3000); 
} 

function display() {
    if (state === 0) {
        curr += 1;
        if (curr > img_src.length-1) {
            curr = 0;
        }
        $("#slide")[0].src = img_src[curr];
        $("#slide")[0].alt = curr;
    }   
}