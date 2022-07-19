let colors = [];
const btn = document.getElementById('btnAdd');
const code_z = document.getElementById('code');
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
let temp1 = null;
let temp2 = null;
let arrsizes = [];
let arrTags = [];

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
        let code = `style="background-color: ${obj.code}"`;
        preview.innerHTML += `
                <li class="list-group-item">
  <input class="text-xl form-check-input me-1" ${code} type="checkbox">
                                                ${obj.color_name}
<i class="fa-solid fa-trash-can mt-2 text-danger removeColor" style="float: right;cursor: pointer" data-id="${obj.code}"></i>
                                            </li>
                `;
    }

    temp1 = document.querySelectorAll('.removeColor');
    temp1.forEach(item => {
        const {id} = item.dataset;

        item.addEventListener('click', function () {
            data = data.filter(item => item.code != id);
            render(data);
        })

    });
    reset([code_z, color_name_z]);
}

render([]);
btn.addEventListener('click', function () {
    const obj = {code: code_z.value, color_name: color_name_z.value};
    colors.push(obj);
    preview.innerHTML = '';
    render(colors);
});

function renderTagsOrSizes(data, element, input, option = false) {
    element.innerHTML = '';
    temp2 = null;
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
                    console.log(arrsizes);
                } else {
                    arrTags = data;
                    console.log(arrTags);
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
    // btnRemoveMainImg.attributes('data-id',file.lat)
    btnRemoveMainImg.style.display = 'block';
});
btnRemoveMainImg.addEventListener('click', function () {
    const dt = new DataTransfer();
    img.files = dt.files;
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
    document.getElementById('btnAddMainImgMore').style.display = 'block';
    document.getElementById('btnNone').style.display = 'none';
    document.getElementById('imgLength').innerHTML = '';
});
imgs.addEventListener('change', function (e) {
    const files = e.target.files;
    let count = 0;
    for (const file of files) {
        const src = URL.createObjectURL(file);
        previewImgs.innerHTML += `
         <img src="${src}" style="position: relative" class="img-thumbnail">

        `;
        count++;
    }
    document.getElementById('btnAddMainImgMore').style.display = 'none';
    document.getElementById('btnNone').style.display = 'block';
    document.getElementById('imgLength').innerHTML = `${count} ảnh được chọn`;
});
