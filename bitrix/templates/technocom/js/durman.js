var section = {

  opts: {
    section: '.js-section',
    tabs: '.js-tabs a',
    tabsActiveClass: 'd_activetab'
  },

  init: function() {
    if (window.location.hash) section.showSection(window.location.hash);
    section.tabsHandler();
  },

  showSection: function(hash) {
    $(section.opts.section).css('display', 'none');
    $(section.opts.section + '[data-id=' + hash + ']').css('display', 'block');
    $(section.opts.tabs).removeClass(section.opts.tabsActiveClass);
    $(section.opts.tabs + '[href=' + hash + ']').addClass(section.opts.tabsActiveClass);
  },

  tabsHandler: function() {
    $(section.opts.tabs).click(function() {
      var $this = $(this),
          hash = $this.attr('href');
      section.showSection(hash);
    });
  }

};

section.init();

var add2basket = {

  opts: {
    buy: '.js-add2basket',
    modal: '.js-add2basket-modal'
  },

  init: function() {
    add2basket.buyHandler();
    add2basket.modalCreate();
    add2basket.modalHandler();
  },

  buyHandler: function() {
    $(add2basket.opts.buy).click(function() {
      var url = $(this).attr('href');
      $.ajax({
        type: 'post',
        url: url,
        cached: false,
        success: function(t) {
          add2basket.modalShow();
          console.log(t);
          setTimeout(add2basket.modalHide, 1500);
        }
      });
      return false;
    });
  },

  modalCreate: function() {
    var modal = '';
    modal += '<div class="add2basket-modal js-add2basket-modal">';
    modal += '<div class="add2basket-modal__in">';
    modal += 'Товар успешно добавлен в корзину!';
    modal += '</div></div>';
    $(modal).appendTo($('body'));
  },

  modalHandler: function() {
    $(add2basket.opts.modal).click(add2basket.modalHide);
  },

  modalShow: function() {
    $(add2basket.opts.modal).css('display', 'block');
  },

  modalHide: function() {
    $(add2basket.opts.modal).css('display', 'none');
  }

};

add2basket.init();

var catalogScrolling = {

  opts: {
    catalog: ''
  },

  init: function() {
    catalogScrolling.handler();
  },

  handler: function() {
    $(window).scroll(function() {
        //@todo Вычислить позицию линии по каталогом $('.title-line blue')
        // Подгрузить каталог


//        console.log(document.body.scrollTop);
//        var $scroll = document.body.scrollTop;
//        var $i =getCookie('clientZoom');
//        console.log($i/$scroll);

//        console.log($('.title-line blue').position());
//        console.log($('.title-line blue').offset());




//        if($scroll > )
//        console.log($(window).scrollHeight);
//        console.log($(window).scrollTop);
//        console.log($(window).scrollHeight);
//        console.log($(window).scrollHeight);
    });
  }

};

catalogScrolling.init();

$(function() {
  if ($('select').length) $('select').selectric();
});

if ($('.page_not').length) {
  $('.d_tabs').removeClass('d_tabs');
  $('.domtab').removeClass('domtab');
}