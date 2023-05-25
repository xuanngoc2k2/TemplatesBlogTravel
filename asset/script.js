document.getElementById('place_next').onclick = function(){
    const widthItem = document.querySelector('.place').offsetWidth;
    document.getElementById('popularPlace').scrollLeft +=(widthItem);
}
document.getElementById('place_prev').onclick = function(){
    const widthItem = document.querySelector('.place').offsetWidth;
    document.getElementById('popularPlace').scrollLeft -=(widthItem);
}