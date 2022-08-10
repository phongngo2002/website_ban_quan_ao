

let colors = [];
const btn = document.getElementById('btnAdd');
const color_name_z = document.getElementById('color_name');
const preview = document.getElementById('preview');
const tag_z = document.getElementById('tag_z');
const btnTag = document.getElementById('btnAddTag');
const previewTag = document.getElementById('previewTag');
const img = document.getElementById('img');
const previewMainImg = document.getElementById('previewMainImg');
const btnUploadMainImg = document.getElementById('btnAddMainImg');
const btnRemoveMainImg = document.getElementById('btnRemoveMainImg');
const imgs = document.getElementById('imgs');
const previewImgs = document.getElementById('previewImgs');
const btnAddSizes = document.getElementById('btnAddSizes');
const valueSize = document.getElementById('valueSize');
const previewSize = document.getElementById('previewSize');
const information = document.getElementById('dimensions');
const sizes  = document.getElementById('sizes');
let temp1 = null;
let temp2 = null;
let arrsizes = [];
let arrTags = [];

function addAndRender(data,option = 1){
    let string = JSON.stringify(data);
    if(option == 1){
        document.getElementById('colors').value = string;
    }
    else if(option == 2){
        document.getElementById('sizes').value = string;
    }
    else{
        document.getElementById('tag').value = string;
    }
}

function getInformation(){
    let long = document.getElementById('long').value;
    let width = document.getElementById('width').value;
    let height = document.getElementById('height').value;

    information.value = `${long}x${width}x${height}`+" cm";
}

function reset(data) {
    for (let i of data) {
        i.value = '';
    }
}

function render(data) {
    preview.innerHTML = '';
    temp1 = null;
    document.getElementById('title-ul').innerHTML = '';
    if (data.length > 0) {
        document.getElementById('title-ul').innerHTML = 'Danh sách màu đã thêm';
    } else {
        document.getElementById('title-ul').innerHTML = 'Bạn chưa thêm màu nào cho sản phẩm này';
    }
    for (let obj of data) {
        preview.innerHTML += `
<span ><i class="fa-solid fa-circle-xmark m-2 removeColor" data-id="${obj}"></i>${obj}</span>
                `;
    }

    temp1 = document.querySelectorAll('.removeColor');
    temp1.forEach(item => {
        const {id} = item.dataset;

        item.addEventListener('click', function () {
            colors = data.filter(item => item != id);
            render(colors);
        })

    });
    reset([color_name_z]);
    addAndRender(colors);
}

btn.addEventListener('click', function () {
    const obj = color_name_z.value;
    colors.push(obj);
    preview.innerHTML = '';
    render(colors);
});

function renderTagsOrSizes(data, element, input, option = false) {
    element.innerHTML = '';
    temp2 = null;
    if(!option){
        addAndRender(arrsizes,2);
    }else{
        addAndRender(arrTags,3);
    }

    if (data.length > 0) {
        for (let s of data) {
            element.innerHTML += `<span ><i class="fa-solid fa-circle-xmark m-2 close" data-id="${s}"></i>${s}</span>`;

        }
        temp2 = document.querySelectorAll('.close');
        temp2.forEach(item => {
            const {id} = item.dataset;
            item.addEventListener('click', () => {
                data = data.filter(item => item != id);
                if (!option) {
                    arrsizes = data;
                } else {
                    arrTags = data;
                }
                renderTagsOrSizes(data, element, input, option);
            });
        });
    } else {
        element.innerHTMl = '';
    }
    reset([input]);
}

btnTag.addEventListener('click', function () {
    const string = tag_z.value;
    const arrString = string.split(',');
    for (const arrStringElement of arrString) {
        arrTags.push(arrStringElement);
    }
    renderTagsOrSizes(arrTags, previewTag, tag_z, true);
});
btnAddSizes.addEventListener('click', function () {
    const string = valueSize.value;
    const arrString = string.split(',');
    for (const arrStringElement of arrString) {
        arrsizes.push(arrStringElement);
    }
    renderTagsOrSizes(arrsizes, previewSize, valueSize);
});
img.addEventListener('change', function (e) {
    const file = e.target.files[0];
    const src = URL.createObjectURL(file);
    previewMainImg.src = src;
    previewMainImg.style.display = 'block';
    btnUploadMainImg.style.display = 'none';
    btnRemoveMainImg.style.display = 'block';
});
btnRemoveMainImg.addEventListener('click', function () {
    const dt = new DataTransfer();
    img.files = dt.files;
    console.log(img.files);
    previewMainImg.src = '';
    previewMainImg.style.display = 'none';
    btnUploadMainImg.style.display = 'block';
    // btnRemoveMainImg.attributes('data-id',file.lat)
    btnRemoveMainImg.style.display = 'none';
});
document.getElementById('btnNone').addEventListener('click',function (){
    const dt = new DataTransfer();
    imgs.files = dt.files;
    previewImgs.innerHTML = '';
    count = 0;
    document.getElementById('btnNone').style.display = 'none';
    document.getElementById('imgLength').innerHTML = '';
});
let count = 0;
function renderPhotos(data,option = 1){
  if(option == 1){
      for (const file of data) {
          const src = URL.createObjectURL(file);
          previewImgs.innerHTML += `
         <div class="col-4 mb-2"><img src="${src}" style="width: 100%;" class="img-thumbnail m-auto"></div>
        `;
          count++;
      }
  }else{
      for (const file of JSON.parse(data)) {
          const src = file;
          const path = `http://127.0.0.1:8000/storage/images/products/${src}`;
          previewImgs.innerHTML += `
       <div class="col-4 mb-2"><img src="${path}" style="width: 100%;" class="img-thumbnail m-auto"></div>
        `;
          count++;
      }
  }
    document.getElementById('btnNone').style.display = 'block';
    document.getElementById('imgLength').innerHTML = `${count} ảnh được chọn`;
}

imgs.addEventListener('change', function (e) {
    const files = e.target.files;
    renderPhotos(files);
});


