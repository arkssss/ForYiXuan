var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var selectSVG = function selectSVG(id) {
  var el = document.getElementById(id);
  return new SVGElement(el);
};

var createSVG = function createSVG(type) {
  var el = document.createElementNS('http://www.w3.org/2000/svg', type);
  return new SVGElement(el);
};

var SVGElement = function () {
  function SVGElement(element) {
    _classCallCheck(this, SVGElement);

    this.element = element;
  }

  _createClass(SVGElement, [{
    key: 'set',
    value: function set(attributeName, value) {
      this.element.setAttribute(attributeName, value);
    }
  }, {
    key: 'style',
    value: function style(property, value) {
      this.element.style[property] = value;
    }
  }]);

  return SVGElement;
}();

var colors = [{ main: '#FBDB4A', shades: ['#FAE073', '#FCE790', '#FADD65', '#E4C650'] }, { main: '#F3934A', shades: ['#F7B989', '#F9CDAA', '#DD8644', '#F39C59'] }, { main: '#EB547D', shades: ['#EE7293', '#F191AB', '#D64D72', '#C04567'] }, { main: '#9F6AA7', shades: ['#B084B6', '#C19FC7', '#916198', '#82588A'] }, { main: '#5476B3', shades: ['#6382B9', '#829BC7', '#4D6CA3', '#3E5782'] }, { main: '#2BB19B', shades: ['#4DBFAD', '#73CDBF', '#27A18D', '#1F8171'] }, { main: '#70B984', shades: ['#7FBE90', '#98CBA6', '#68A87A', '#5E976E'] }];
var svg = selectSVG('svg');
var text = document.getElementById('text');
var offscreenText = document.getElementById('offscreen-text');
var input = document.getElementById('input');
var width = window.innerWidth;
var height = window.innerHeight;
var textSize = 0;
var textCenter = 0;
var letters = [];
var prompt = ['s', 't', 'a', 'r', 't', ' ', 't', 'y', 'p', 'i', 'n', 'g'];
var runPrompt = true;

var resizePage = function resizePage() {
  width = window.innerWidth;
  height = window.innerHeight;
  svg.set('height', height);
  svg.set('width', width);
  svg.set('viewBox', '0 0 ' + width + ' ' + height);
  resizeLetters();
};

var resizeLetters = function resizeLetters() {
  textSize = width / (letters.length + 2);
  if (textSize > 100) textSize = 100;
  text.style.fontSize = textSize + 'px';
  text.style.height = textSize + 'px';
  text.style.lineHeight = textSize + 'px';
  offscreenText.style.fontSize = textSize + 'px';
  var textRect = text.getBoundingClientRect();
  textCenter = textRect.top + textRect.height / 2;
  positionLetters();
};

var positionLetters = function positionLetters() {
  letters.forEach(function (letter) {
    var timing = letter.shift ? 0.1 : 0;
    TweenLite.to(letter.onScreen, timing, { x: letter.offScreen.offsetLeft + 'px', ease: Power3.easeInOut });
    letter.shift = true;
  });
};

var animateLetterIn = function animateLetterIn(letter) {
  var yOffset = (0.5 + Math.random() * 0.5) * textSize;
  TweenLite.fromTo(letter, 0.4, { scale: 0 }, { scale: 1, ease: Back.easeOut });
  TweenLite.fromTo(letter, 0.4, { opacity: 0 }, { opacity: 1, ease: Power3.easeOut });
  TweenLite.to(letter, 0.2, { y: -yOffset, ease: Power3.easeInOut });
  TweenLite.to(letter, 0.2, { y: 0, ease: Power3.easeInOut, delay: 0.2 });
  var rotation = -50 + Math.random() * 100;
  TweenLite.to(letter, 0.2, { rotation: rotation, ease: Power3.easeInOut });
  TweenLite.to(letter, 0.2, { rotation: 0, ease: Power3.easeInOut, delay: 0.2 });
};

var addDecor = function addDecor(letter, color) {
  setTimeout(function () {
    var rect = letter.getBoundingClientRect();
    var x0 = letter.offsetLeft + letter.offsetWidth / 2;
    var y0 = textCenter - textSize * 0.5;
    var shade = color.shades[Math.floor(Math.random() * 4)];
    for (var i = 0; i < 8; i++) {
      addTri(x0, y0, shade);
    }for (var i = 0; i < 8; i++) {
      addCirc(x0, y0);
    }
  }, 150);
};

var addTri = function addTri(x0, y0, shade) {
  var tri = createSVG('polygon');
  var a = Math.random();
  var a2 = a + (-0.2 + Math.random() * 0.4);
  var r = textSize * 0.52;
  var r2 = r + textSize * Math.random() * 0.2;
  var x = x0 + r * Math.cos(2 * Math.PI * a);
  var y = y0 + r * Math.sin(2 * Math.PI * a);
  var x2 = x0 + r2 * Math.cos(2 * Math.PI * a2);
  var y2 = y0 + r2 * Math.sin(2 * Math.PI * a2);
  var triSize = textSize * 0.1;
  var scale = 0.3 + Math.random() * 0.7;
  var offset = triSize * scale;
  tri.set('points', '0,0 ' + triSize * 2 + ',0 ' + triSize + ',' + triSize * 2);
  tri.style('fill', shade);
  svg.element.appendChild(tri.element);
  TweenLite.fromTo(tri.element, 0.6, { rotation: Math.random() * 360, scale: scale, x: x - offset, y: y - offset, opacity: 1 }, { x: x2 - offset, y: y2 - offset, opacity: 0, ease: Power1.easeInOut, onComplete: function onComplete() {
      svg.element.removeChild(tri.element);
    } });
};

var addCirc = function addCirc(x0, y0) {
  var circ = createSVG('circle');
  var a = Math.random();
  var r = textSize * 0.52;
  var r2 = r + textSize;
  var x = x0 + r * Math.cos(2 * Math.PI * a);
  var y = y0 + r * Math.sin(2 * Math.PI * a);
  var x2 = x0 + r2 * Math.cos(2 * Math.PI * a);
  var y2 = y0 + r2 * Math.sin(2 * Math.PI * a);
  var circSize = textSize * 0.05 * Math.random();
  circ.set('r', circSize);
  circ.style('fill', '#eee');
  svg.element.appendChild(circ.element);
  TweenLite.fromTo(circ.element, 0.6, { x: x - circSize, y: y - circSize, opacity: 1 }, { x: x2 - circSize, y: y2 - circSize, opacity: 0, ease: Power1.easeInOut, onComplete: function onComplete() {
      svg.element.removeChild(circ.element);
    } });
};

var addLetter = function addLetter(char, i) {
  var letter = document.createElement('span');
  var oLetter = document.createElement('span');
  letter.innerHTML = char;
  oLetter.innerHTML = char;
  text.appendChild(letter);
  var color = colors[i % colors.length];
  letter.style.color = color.main;
  offscreenText.appendChild(oLetter);
  letters[i] = { offScreen: oLetter, onScreen: letter, char: char };
  animateLetterIn(letter);
  addDecor(oLetter, color);
};

var addLetters = function addLetters(value) {
  value.forEach(function (char, i) {
    if (letters[i] && letters[i].char !== char) {
      letters[i].onScreen.innerHTML = char;
      letters[i].offScreen.innerHTML = char;
      letters[i].char = char;
    }
    if (letters[i] === undefined) {
      addLetter(char, i);
    }
  });
};

var animateLetterOut = function animateLetterOut(letter, i) {
  TweenLite.to(letter.onScreen, 0.1, { scale: 0, opacity: 0, ease: Power2.easeIn, onComplete: function onComplete() {
      console.log('removing');
      console.log(letter);
      offscreenText.removeChild(letter.offScreen);
      text.removeChild(letter.onScreen);
      positionLetters();
    } });
  letters.splice(i, 1);
};

var removeLetters = function removeLetters(value) {
  for (var i = letters.length - 1; i >= 0; i--) {
    var letter = letters[i];
    if (value[i] === undefined) {
      animateLetterOut(letter, i);
    }
  }
};

var onInputChange = function onInputChange() {
  var value = input.value === '' ? [] : input.value.toLowerCase().split('');
  addLetters(value);
  removeLetters(value);
  resizeLetters();
};

var keyup = function keyup(e) {
  if (runPrompt) {
    input.value = '';
    runPrompt = false;
  };
  onInputChange();
};

var addPrompt = function addPrompt(i) {
  setTimeout(function () {
    if (runPrompt && prompt[i]) {
      input.value = input.value + prompt[i];
      onInputChange();
      addPrompt(i + 1);
    }
  }, 300);
};
var message = [

              ["10.25这天", ",我们相遇了"],
              ["就像一瓶清水滴进了一滴彩色颜料"],
              ["从那天起"],
              ["我的生活从Boring的白",",变成了斑斓的彩"],
              ["你是那么的好",",好到我时常在想"],
              ["我是不是一直活在梦里",""],
              ["或者我是不是上辈子做了什么拯救人们的事",""],
              ["亦或许只是单纯的上天对我的眷顾",""],
              ["才能让我遇到这么好的你",""],
              ["时间是漫长的也是短暂的",""],
              ["漫长的让我走过了很久","才遇到你"],
              ["短暂的然后我遇到你之后, 又将面临六个月的异地",""],
              ["这两个月的生活是那么的值得珍贵",""],
              ["似乎过去的点点滴滴还像昨天刚发一样记在我心里",""],
              ["和你在一起, 可以每天都有聊不完的事",",开不完的心",""],
              ["马上就要迎来六个月的异地生活",""],
              ["你说, 你有信心",",希望我也有",""],
              ["但是我想说",":我的信心肯定不会输给你, 哈哈哈",""],
              ["现在就开始期待六月底在机场见到你的那一刻了",""],
              ["想想画面都是多么的美好",""],
              ["我这个人,臭毛病很多, 但是有几个优点",""],
              ["其中之一就是",":能坚持"],
              ["好不容易遇到一个这么好的姑娘, 我才不可能放手",""],
              ["所以, 相信我和你",",也相信我们可以走很远很远",""],
              ["大方猪 感谢GOD让我遇到"," 小任狗",""],
              ["感谢遇见, 感谢你!!!",""],
              ["happy 2019 !!!!!"],
              ["岁月还长, 让大方猪 慢慢的照顾你!"]
            ]
var len = message.length;
var is_sub_array = false;
// 开始显示的函数
var star_showing = function star_showing(i){
    if(!i) str = message[i];
    setTimeout(function(){
      //判断长度的函数
      if(i < len){
        if(message[i].length > 1){
          input.value = "";
          show_sub_array(0, message[i], i);
        }else{
          input.value = message[i];
          onInputChange();
          star_showing(i+1);
        }
      }
    },800)

}
var show_sub_array = function show_sub_array(i, arr, j){
  var len2 = arr.length;
  is_sub_array = true;
  setTimeout(function(){
    if(i < len2){
      input.value = input.value + arr[i];
      onInputChange();
      show_sub_array(i+1, arr, j)
    }else{
      star_showing(j+1)
    }
    return ;
  }, 1000)
// }

}


resizePage();
window.addEventListener('resize', resizePage);
input.addEventListener('keyup', keyup);
input.focus();
// addPrompt(0);
star_showing(0)