/*---------------------- Micropostオブジェクト -----------------------*/
var Micropost = function(){}
Micropost.elem = document.getElementById('js-micropost-text-form');
Micropost.registerUrl = document.getElementById('data-ajax-url-list').getAttribute('data-ajax-post-micropost-url');
Micropost.prototype = {
  openForm : function(elem){    //textarea生成
      hide(document.getElementById('js-micropost-text-form'));

      //formの作成
      var form = document.createElement('div');
      form.setAttribute('contenteditable',true);
      form.setAttribute('id','js-register-micropost-form');
      form.className = 'form-control js-micropost-textarea';
      form.style.maxWidth = '694px';
      //ボタンの作成
      var textButton = document.createTextNode('投稿');
      var button = document.createElement('button');
      button.className = 'btn btn-warning pull-right ';
      button.style.marginTop = '10px';

      button.setAttribute('id','micropost-register-bottom');

      button.appendChild(textButton);

      elem.appendChild(form);
      elem.appendChild(button);
  },
  closeForm : function(elem){   //入力フォームを閉じる
      if(elem.firstElementChild.className === 'alert alert-danger'){
        elem.removeChild(elem.firstElementChild);
      }
      removeElement(elem,document.getElementById('js-register-micropost-form'));
      removeElement(elem,document.getElementById('micropost-register-bottom'));
      show(document.getElementById('js-micropost-text-form'));
  },
  createContentSpace : function(MicropostRow){  //ツイートスペース作成

    var eachPaginateMicropostSpace = document.createElement('div');
    eachPaginateMicropostSpace.className = 'each-paginate-micropost-space';

    var eachMicropostSpace = document.createElement('div');
    eachMicropostSpace.className = 'each-micropost-space each-micropost-border';
    eachMicropostSpace.setAttribute('data-toggle','modal');
    eachMicropostSpace.setAttribute('data-micropost-id',MicropostRow.id);
    eachMicropostSpace.setAttribute('data-user-id',MicropostRow.user_id);

    var micropostContentSpace = document.createElement('div');
    micropostContentSpace.className = 'micropost-content-space';

    var micropostUserInfo = document.createElement('div');
    micropostUserInfo.className = 'micropost-user-info';
    var micropostUserInfoP = document.createElement('p');
    var micropostUserInfoSpan = document.createElement('span');
    micropostUserInfoSpan.className = 'glyphicon glyphicon-user';
    micropostUserInfoSpan.setAttribute('aria-hidden',true);
    var micropostUserInfoText = document.createTextNode(MicropostRow.user_name);

    var micropostContent = document.createElement('div');
    micropostContent.className = 'micropost-content';
    var micropostContentP = document.createElement('p');
    var micropostContentText = document.createTextNode(MicropostRow.content);

    micropostContentP.appendChild(micropostContentText);
    micropostContent.appendChild(micropostContentP);

    micropostUserInfoP.appendChild(micropostUserInfoSpan);
    micropostUserInfoP.appendChild(micropostUserInfoText);
    micropostUserInfo.appendChild(micropostUserInfoP);

    micropostContentSpace.appendChild(micropostUserInfo);
    micropostContentSpace.appendChild(micropostContent);

    eachMicropostSpace.appendChild(micropostContentSpace);

    eachPaginateMicropostSpace.appendChild(eachMicropostSpace);

    var ovarallMicropostSpace = document.getElementById('ovarall-micropost-space');
    ovarallMicropostSpace.insertBefore(eachPaginateMicropostSpace, ovarallMicropostSpace.firstChild);
  }

};
/*-----------------------------------------------------*/
(function(){

  var micropost = new Micropost();

  //ツイート入力画面の生成
  addListener(Micropost.elem,'click',function(e){
    micropost.openForm(e.target.parentNode);
  });

  //ツイート入力画面閉じる
  addListener(document,'click',function(e){
    var elements = objectConvertToArray(document.getElementById('js-micropost-form').children);
    serachChildren(elements,e.target);
    if(
      document.getElementById('js-register-micropost-form') !== null &&
      (
        e.target.getAttribute('id') !== 'js-micropost-form' &&
        elements.indexOf(e.target) === -1 &&
        !serachChildren(elements,e.target)
      )
    ){
      micropost.closeForm(document.getElementById('micropost-register-bottom').parentNode);
    }
  });

  //ツイート投稿
  addListener(document.getElementById('js-micopost-create-form'),'click',function(e){
    var $this = this;
    if($this.firstElementChild.className === 'alert alert-danger'){
      removeElement($this,$this.firstElementChild);
    }

    if(e.target.getAttribute('id') !== 'micropost-register-bottom'){
      return;
    }
    var content = document.getElementById('js-register-micropost-form').textContent;

    if(content.length === 0){
      showAlert($this,'ツイートを入力してください');
      return;
    }else if(content.length > 140){
      showAlert($this,'140文字以内で入力してください');
      return;
    }

    var micropostCreateForm = e.target;
    var data = {
        'content' : content,
        'user_id' : document.getElementById('data-ajax-url-list').getAttribute('data-user-id')
    };
    micropost.closeForm(micropostCreateForm.parentNode);

    $.ajax({
      type  : 'POST',
      datatype  : 'JSON',
      data : data,
      url : Micropost.registerUrl
    }).done(function(response){
        micropost.createContentSpace(response.MicropostRow);
    }).fail(function(status){
      showAlert($this,'ツイートは0文字以上140文字以内で入力してください');
    });

  });

})();



function hide(elem){
  elem.style.display = 'none';
}

function showAlert(elem,content){
  var div = document.createElement('div');
  div.className = 'alert alert-danger';
  var text = document.createTextNode(content);
  div.appendChild(text);
  elem.insertBefore(div, elem.firstChild);
}

function show(elem){
  elem.style.display = '';
}

function removeElement(elem,child){
  elem.removeChild(child);
}

function isArray(obj) {
    return Object.prototype.toString.call(obj) === '[object NodeList]';
}

function objectConvertToArray(obj)
{
    return Object.keys(obj).map(function (key) {return obj[key]});
}

function serachChildren(children,target){
  var result = false;
  for(var i = 0 ; i < children.length ; i ++){
    var elements = objectConvertToArray(children[i].children);
    if(elements.indexOf(target) !== -1){
      result = true;
    }
  }

  return result;
}


function addListener(elem,event,listener){
  if(elem.addEventListener){
    elem.addEventListener(event,listener,false);
  }else if(elem.attachEvent){
    elem.attachEvent('on' + event , listener);
  }else{
    throw new Error('イベントリスナ未対応です。');
  }
}
