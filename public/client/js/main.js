(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'html',
        transition: function (url) {
            window.location.href = url;
        }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height() / 2;

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display', 'flex');
        } else {
            $("#myBtn").css('display', 'none');
        }
    });

    $('#myBtn').on("click", function () {
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if ($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    } else {
        var posWrapHeader = 0;
    }


    if ($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top', 0);
    } else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top', 0);
        } else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
        }
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function () {
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for (var i = 0; i < arrowMainMenu.length; i++) {
        $(arrowMainMenu[i]).on('click', function () {
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function () {
        if ($(window).width() >= 992) {
            if ($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display', 'none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function () {
                if ($(this).css('display') == 'block') {
                    $(this).css('display', 'none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });

        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function () {
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity', '0');
    });

    $('.js-hide-modal-search').on('click', function () {
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity', '1');
    });

    $('.container-search-header').on('click', function (e) {
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({filter: filterValue});
        });

    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function () {
        $(this).on('click', function () {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click', function () {
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if ($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click', function () {
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if ($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });


    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click', function () {
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click', function () {
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click', function () {
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click', function () {
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function sumTotal() {
        const totalPrice = document.querySelectorAll('.total');
        const numProduct = document.querySelectorAll('.cartQuantity');

        let sum = 0;
        let quantity = 0;
        totalPrice.forEach(item => {
            const {total} = item.dataset;
            sum += Number(total);
        });
        numProduct.forEach(item => {
            quantity += Number(item.innerHTML);
        })
        $('.totalPrice1').html(`${numberWithCommas(sum)} VNĐ`);
        $('.one').html(`${numberWithCommas(sum + 13000)} VNĐ`);
        $('#totalPrice').val(sum);
        $('#totalQuantity').val(quantity);
        var discount = Number($('#discount').val());
        $('#saveChange').attr('value', 'false');
        if (discount > 0) {
            $('.totalPrice1').html(`${numberWithCommas(sum)}`);
            $('.delPrice').html(`${numberWithCommas(sum - sum * (discount / 100))} VNĐ`);
            $('.totalPrice3').html(`${numberWithCommas(sum - sum * (discount / 100) + 13000)} VNĐ`);
        }
    }

    $('#btnOnChange').on('click', function () {
        var check = $('#saveChange').val();
        var confirm = null;
        if (check == 'false') {
            confirm = window.confirm('Bạn lưu thay đổi gió hàng.Bạn có muốn tiếp tục không ?')
            if (confirm) {
                $('#form-check-out').submit();
            }
        } else {
            $('#form-check-out').submit();
        }
    });
    $('#btnCancel').on('click', function () {
        const input = document.createElement('input');
        input.setAttribute('name', 'cancelVoucher');
        input.value = 'true';
        input.type = 'hidden';
        $('#form').append(input);
        let ele = document.querySelectorAll('.halo');
        for (let i = 0; i < ele.length; i++) {
            let data1 = [];
            let quantity = 0;
            document.querySelectorAll(`.quantity${i + 1}`).forEach((item => {
                quantity += Number(item.value);
                data1.push(Number(item.value));
            }));
            document.querySelector(`.num-product${i + 1}`).value = JSON.stringify(data1);
        }
        $('#form').submit();
    });

    $('.btn-num-product-down').on('click', function () {

        var index = Number($(this).data('id'));
        if (index) {
            var ele = $('.price')[index - 1];
        }
        var numProduct = Number($(this).next().val());
        if (ele) {
            var {price} = ele.dataset;
        }
        $(this).next().val(numProduct - 1);

        if (numProduct > 0 && index) {
            let quantity = 0;
            let data1 = [];
            document.querySelectorAll(`.quantity${index}`).forEach((item => {
                quantity += Number(item.value);
                data1.push(Number(item.value));
            }));
            document.querySelector(`.num-product${index}`).value = JSON.stringify(data1);
            document.querySelectorAll('.total')[index - 1].innerText = `${numberWithCommas(Number(price) * quantity)} VNĐ`;
            document.querySelectorAll('.total')[index - 1].setAttribute('data-total', Number(price) * quantity);
            document.querySelectorAll('.cartQuantity')[index - 1].innerText = quantity;

        }
        sumTotal();
        ;
    });
    $('.btnSub').on('click', function () {
        let ele = document.querySelectorAll('.halo');
        for (let i = 0; i < ele.length; i++) {
            let data1 = [];
            let quantity = 0;
            document.querySelectorAll(`.quantity${i + 1}`).forEach((item => {
                quantity += Number(item.value);
                data1.push(item.value);
            }));
            document.querySelector(`.num-product${i + 1}`).value = JSON.stringify(data1);
        }
        $('#form').submit();
    });
    $('.one1').on('focus', function () {
        $(this).next().css('display', 'none');
    });
    $('.btn-num-product-up').on('click', function () {
            var index = Number($(this).data('id'));
            var numProduct = Number($(this).prev().val());
            if (index) {
                var ele = $('.price')[index - 1];
            }
            $(this).prev().val(numProduct + 1);
            if (ele) {
                var {price} = ele.dataset;
            }

            if (index && price) {
                let data = [];
                let quantity = 0;
                document.querySelectorAll(`.quantity${index}`).forEach((item => {
                    quantity += Number(item.value);
                    data.push(item.value);
                }));
                document.querySelector(`.num-product${index}`).value = JSON.stringify(data);
                document.querySelectorAll('.cartQuantity')[index - 1].innerText = quantity;
                document.querySelectorAll('.total')[index - 1].innerText = `${numberWithCommas(Number(price) * quantity)} VNĐ`;
                document.querySelectorAll('.total')[index - 1].setAttribute('data-total', Number(price) * quantity);

            }
            sumTotal();
        }
    )
    ;

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function () {
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function () {
            var index = item.index(this);
            var i = 0;
            for (i = 0; i <= index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function () {
            var index = item.index(this);
            rated = index;
            $(input).val(index + 1);
        });

        $(this).on('mouseleave', function () {
            var i = 0;
            for (i = 0; i <= rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/

    // if(number) {
    //     for (let i = 0; i <  number; i++) {
    //         $(`.js-show-modal`)[i].on('click', function (e) {
    //             e.preventDefault();
    //             console.log(i);
    //             $(`.js-modal`)[i].addClass(``);
    //         });
    //
    //         $(`.js-hide-modal`)[i].on('click', function () {
    //             $(`.js-modal`)[i].(`show-modal`);
    //         });
    //
    //     }
    // }


})(jQuery);
const btnModal = document.querySelectorAll('.js-show-modal');
const modal = document.querySelectorAll('.js-modal');
const btnHide = document.querySelectorAll('.js-hide-modal');
let temp = null;
btnModal.forEach((item, index) => {
    item.addEventListener('click', () => {
        modal[index].classList.add('show-modal');
        temp = index;
    })

})
for (let i = 0; i < btnHide.length; i++) {
    btnHide[i].addEventListener('click', () => {
            modal[temp].classList.remove('show-modal');
            temp = null;
        }
    )
}

