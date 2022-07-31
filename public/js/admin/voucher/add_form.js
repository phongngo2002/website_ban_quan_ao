

const inputs = document.querySelectorAll('.input');
console.log(inputs);
const previews = document.querySelectorAll('.preview');
let start_time = "??/??/????";
let end_time = "??/??/????";
console.log(previews);
function reset(element,string){
    element.innerHTML = string;
}
document.getElementById('btnReset').addEventListener('click',()=>{
    inputs.forEach(item => {
        item.value = '';
    });
    renderDate('??/??/????','??/??/????');
    previews[0].innerHTML = 'Tiêu đề';
    previews[1].innerHTML = 'Mô tả';
    previews[2].innerHTML = 'Mã code';
}) ;
function renderDate(start,end){
    previews[3].innerHTML = `Thời hạn: ${start} - ${end}`;
}
function renderDesc(discount){
    previews[1].innerHTML = `Thẻ giảm giá ${discount}% cho mọi sản phẩm`;
}
renderDate(start_time,end_time);
inputs[0].addEventListener('change',()=>{
    if(!inputs[0].value){
        reset(previews[2],'Code: ????');
        return;
    }
    previews[2].innerHTML = `Code: ${inputs[0].value}`;
});
inputs[1].addEventListener('change',()=>{
    if(!inputs[1].value){
        reset(previews[1],'????');
        return;
    }
    renderDesc(inputs[1].value);
});

inputs[2].addEventListener('change',()=>{
    if(!inputs[2].value){
        reset(previews[0],'????');
        return;
    }
    previews[0].innerHTML = inputs[2].value;
});
inputs[3].addEventListener('change',()=>{
    if(!inputs[3].value && !inputs[4].value){
        reset(previews[3],'Thời hạn: ??/??/???? - ??/??/????');
        return;
    }
    const date = new Date(inputs[3].value);
    start_time = `${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()}`;
    renderDate(start_time,end_time);
});
inputs[4].addEventListener('change',()=>{
    if(!inputs[3].value && !inputs[4].value){
        reset(previews[3],'Thời hạn: ??/??/???? - ??/??/????');
        return;
    }
    const date = new Date(inputs[4].value);
    end_time = `${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()}`;
    renderDate(start_time,end_time);
});

