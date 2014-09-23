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
    $(section.opts.section).css('display', 'none').removeClass('active');
    $(section.opts.section + '[data-id=' + hash + ']').css('display', 'block').addClass('active');
    $(section.opts.tabs).removeClass(section.opts.tabsActiveClass);
    $(section.opts.tabs + '[href=' + hash + ']').addClass(section.opts.tabsActiveClass);
    catalog.setHeight();
    catalog.setId();
  },

  tabsHandler: function() {
    $(section.opts.tabs).click(function() {
      var $this = $(this),
          hash = $this.attr('href');
      section.showSection(hash);
    });
  }

};

if ($('.js-section').length) section.init();

var add2basket = {

  opts: {
    buy: '.js-add2basket',
    modal: '.js-add2basket-modal',
    counter: '.js-add2basket-counter'
  },

  init: function() {
    add2basket.buyHandler();
    add2basket.modalCreate();
    add2basket.modalHandler();
  },

  buyHandler: function() {
    $(add2basket.opts.buy).click(function() {
      var $this = $(this),
          url = $this.attr('href'),
          id = $this.data('id');
      $.ajax({
        type: 'post',
        url: url,
        cached: false,
        success: function() {
          var count = parseInt($(add2basket.opts.counter).text())
            ? parseInt($(add2basket.opts.counter).text()) + 1 : 1;
          $(add2basket.opts.counter).text(count);
          add2basket.modalShow();
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

var catalog = {

  handlerPriceStatus: true,
  handlerProductionStatus: true,
  loader: {},
  pages: [],
  loading: [],
  priceFilter: [],
  productionFilter: [],
  sales: 0,
  productions: 0,
  search: 0,
  q: '',
  id: 0,
  zoom: 1,
  height: 0,
  elHeight: 0,

  init: function() {
    this.loader = $('.loader');
    $('.js-section').each(function() {
      var id = parseInt($(this).data('id').substr(2));
      catalog.pages[id] = 1;
      catalog.loading[id] = false;
      catalog.priceFilter[id] = 0;
      catalog.productionFilter[id] = 0;
    });
    if ($('[name=sales]').length) this.sales = 1;
    if ($('[name=productions]').length) this.productions = 1;
    if ($('[name=search]').length) this.search = 1;
    if (this.productions) this.productionFilter[0] = $('select.jsd-productionFilter').val();
    this.setId();
    this.setZoom();
    this.setElHeight();
    this.setHeight();
    this.handlerScroll();
    this.handlerPrice();
    this.handlerProduction();
  },

  handlerScroll: function() {
    $(window).scroll(function() {
      if (scrollY > catalog.height && !catalog.loading[catalog.id]) catalog.loadMore();
    });
  },

  handlerPrice: function() {
    $('.jsd-priceFilter').on('change', function() {
      if (catalog.handlerPriceStatus) {
        catalog.handlerPriceStatus = false;
        catalog.sortByPrice($(this).val());
        setTimeout(function() {
          catalog.handlerPriceStatus = true;
        },500);
      }
    });
  },

  handlerProduction: function() {
    $('.jsd-productionFilter').on('change', function() {
      if (catalog.handlerProductionStatus) {
        catalog.handlerProductionStatus = false;
        catalog.sortByProduction($(this).val());
        setTimeout(function() {
          catalog.handlerProductionStatus = true;
        },500);
      }
    });
  },

  setZoom: function() {
    var cookie = "; " + document.cookie, cookieParts = cookie.split("; clientZoom=");
    if (cookieParts.length == 2) this.zoom = cookieParts.pop().split(";").shift();
    else this.zoom = 1;
  },

  setElHeight: function() {
    this.elHeight = parseInt($('.product').css('height'));
  },

  setHeight: function() {
    this.height = parseInt($('.js-section.active .js-section-end').offset().top) - this.elHeight;
  },

  setId: function() {
    this.id = $('.js-section.active').data('id').substr(2);
  },

  loadMore: function() {
    if (this.search) this.q = $('[name=q]').val();
    this.loading[this.id] = true;
    this.showLoader();
    this.pages[this.id]++;
    $.ajax({
      url: '/catalog/load.php',
      type: 'post',
      cache: false,
      async: true,
      data: {
        ajax: true,
        page: catalog.pages[catalog.id],
        id: catalog.id,
        priceFilter: catalog.priceFilter[catalog.id],
        productionFilter: catalog.productionFilter[catalog.id],
        sales: catalog.sales,
        search: catalog.search,
        q: catalog.q
      },
      success: function(response) {
        if (response == 'noFound' && catalog.pages[catalog.id] == 1) {
          var str = '<span class="no-result mt">Товаров с выбранным производителем не найдено!</span>';
          catalog.addToSection(str);
        } else if (response != '') {
          var json = JSON.parse(response), str = '';
          for (var i = 0; i < json.length; i++) str += catalog.printNew(json[i]['URL'], json[i]['PREVIEW_PICTURE'], json[i]['NAME'], json[i]['PROPERTY_ARTICLE_VALUE'], json[i]['PRICE'], json[i]['ADD_URL']);
          catalog.addToSection(str);
          catalog.setHeight();
          catalog.loading[catalog.id] = false;
        }
        catalog.hideLoader();
      }
    });
  },

  printNew: function(url, img, name, art, price, add) {
    var str = '';
    str += '<div class="product"><div class="product__pic">'
        + '<a href="' + url + '"><img src="' + img + '" alt="' + name + '"></a></div>'
        + '<div class="product__title">' + name + '</div>'
        + '<div class="product__code">арт. ' + art + '</div>'
        + '<div class="product__details">'
        + '<div class="product__price">' + price + ' <i class="icon-rub"></i></div>'
        + '<div class="product__buy">'
        + '<a class="btn btn_small btn_green js-add2basket" href="' + add + '">В корзину</a>'
        + '</div></div></div>';
    return str;
  },

  hideLoader: function() {
    this.loader.css('display', 'none');
  },

  showLoader: function() {
    this.loader.css('display', 'block');
  },

  sortByPrice: function(priceFilter) {
    this.priceFilter[this.id] = priceFilter;
    this.sort();
  },

  sortByProduction: function(productionFilter) {
    this.productionFilter[this.id] = productionFilter;
    this.sort();
  },

  sort: function() {
    this.pages[this.id] = 0;
    this.clearSection();
    this.loadMore();
  },

  clearSection: function() {
    $('.js-section.active .d_tabproducts').html('');
  },

  addToSection: function(str) {
    $(str).appendTo($('.js-section.active .d_tabproducts'));
  }

};

$(function() {
  if ($('select').length) $('select').selectric();
});

if ($('.page_not').length) {
  $('.d_tabs').removeClass('d_tabs');
  $('.domtab').removeClass('domtab');
}

var basketPostponed = {

  opts: {
    tabs: '.x_tabs__links a',
    tabsContent: '.x_tabs__item'
  },

  tabs: {},

  init: function() {
    this.tabs = $(this.opts.tabs);
    if (!this.tabs.length) return;
  },

  showPostponed: function() {
    $(this.opts.tabs + ':eq(0)').removeClass('selected');
    $(this.opts.tabsContent + ':eq(0)').removeClass('selected');
    $(this.opts.tabs + ':eq(1)').addClass('selected');
    $(this.opts.tabsContent + ':eq(1)').addClass('selected');
  }

};

$(function() {
  basketPostponed.init();
});

var modalWindow = {

  body: {},
  zoom: 1,
  shadow: false,
  modals: [],
  modalsName: [],

  init: function(name, width, height) {
    if (this.modals[name]) return false;
    else {
      this.modals[name] = {
        name: name,
        width: width,
        height: height
      };
      this.modalsName.push(name);
    }
    this.body = $('body');
    this.zoom = getCookie('clientZoom');
    this.printStyle();
    if (!this.shadow) this.printShadow();
    this.printWindow(name);
    this.handler(name);
    this.handlerClose();
  },

  printStyle: function() {
    var style = '', zoom = this.zoom;
    if ($('#js-modal-style').length) $('#js-modal-style').remove();
    style += '<style type="text/css" id="js-modal-style">';
    style += '.modal-window-shadow { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); cursor: pointer; z-index: 900; }';
    style += '.modal-window { display: none; position: fixed; top: 50%; left: 50%; z-index: 999; transform-origin: left top; -webkit-transform-origin: left top; -ms-transform-origin: left top; transform: scale(' + zoom + '); -o-transform: scale(' + zoom + '); -webkit-transform: scale(' + zoom + '); -ms-transform: scale(' + zoom + '); -moz-transform: scale(' + zoom + '); }';
    style += '</style>';
    $(style).appendTo(this.body);
  },

  printShadow: function() {
    var shadow = '<div class="modal-window-shadow"></div>';
    this.shadow = $(shadow).appendTo(this.body);
  },

  printWindow: function(name) {
    var modal = '', html = $('#' + name).html(); $('#' + name).html('');
    modal += '<div class="modal-window" data-modal-name="' + name + '"></div>';
    $(modal).html(html).appendTo(this.body);
    this.setModalWindowCss(name);
  },

  setModalWindowCss: function(name) {
    $('[data-modal-name=' + name + ']').css({
      width: this.modals[name].width,
      height: this.modals[name].height,
      marginTop: '-' + ((this.modals[name].height * this.zoom) / 2) + 'px',
      marginLeft: '-' + ((this.modals[name].width * this.zoom) / 2) + 'px'
    });
  },

  handler: function(name) {
    $('[data-modal-button=' + name + ']').click(function() {
      modalWindow.modalShow(name);
    });
  },

  handlerClose: function() {
    this.shadow.click(function() {
      modalWindow.modalClose();
    });
    $('[data-modal-close]').click(function() {
      modalWindow.modalClose();
    });
  },

  modalShow: function(name) {
    this.shadow.css('display', 'block');
    $('[data-modal-name=' + name + ']').css('display', 'block');
  },

  modalClose: function() {
    this.shadow.css('display', 'none');
    $('[data-modal-name]').css('display', 'none');
  },

  modalResize: function(zoom) {
    this.zoom = zoom;
    this.printStyle();
    for (var i = 0; i < this.modalsName.length; i++)
      modalWindow.setModalWindowCss(this.modalsName[i]);
  }

};

$(function() {
  modalWindow.init('callback', 1140, 1030);
});

var form = {

  forms: [],

  init: function(name) {
    if (this.forms[name]) {
      console.log('Form with name: "' + name + '" exist.');
      return false;
    }
    var form = $('[name=' + name + ']');
    this.forms[name] = {
      name: name,
      form: form,
      action: form.attr('action'),
      method: form.attr('method'),
      data: {},
      err: form.find('[data-error]')
    };
    this.handler(name);
  },

  handler: function(name) {
    this.forms[name].form.find('[type=submit]').click(function() {
      form.forms[name].form.find('input, textarea').each(function() {
        var $this = $(this),
            input_name = $this.attr('name'),
            input_value = $this.val();
        form.forms[name].data[input_name] = input_value;
      });
      form.ajax(name);
      return false;
    });
  },

  ajax: function(name) {
    $.ajax({
      url: this.forms[name].action,
      type: this.forms[name].method,
      cache: false,
      data: this.forms[name].data,
      success: function(response) {
        if (response != '') form.forms[name].err.html(response);
        else {
          form.forms[name].err.html('<div class="goodtext">Заявка отправлена</div>');
          setTimeout(function() {
            form.forms[name].err.html('');
            setTimeout(function() {
              modalWindow.modalClose();
            }, 2000);
          }, 5000);
          form.forms[name].form.find('input[type=text], textarea').each(function() {
            $(this).val('');
          });
        }
      }
    });
  }

};

$(function() {
  form.init('callback');
});