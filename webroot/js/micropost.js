/*---------------------- Micropostオブジェクト -----------------------*/
var Micropost = function(){}
Micropost.elem = document.getElementById('js-micropost-text-form');
Micropost.registerUrl = document.getElementById('data-ajax-url-list').getAttribute('data-ajax-post-micropost-url');
Micropost.ShowUrl = document.getElementById('data-ajax-url-list').getAttribute('data-ajax-show-micropost-url');
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
    eachMicropostSpace.setAttribute('data-recipient',MicropostRow.user_name);

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
/*---------------------- Replayオブジェクト -----------------------*/
var Replay = function(){};
Replay.registerUrl = document.getElementById('data-ajax-url-list').getAttribute('data-ajax-post-replay-url');
Replay.prototype = {
  setUserNameLength : function(len){
    this.nameLength = len
  },
  getUserNameLength: function(){
    return this.nameLength;
  },
  showContent : function(elem){
    var eachMicropostSpace = document.createElement('div');
    eachMicropostSpace.className = 'each-micropost-space';
    eachMicropostSpace.setAttribute('data-user_id',elem.user_id);
    eachMicropostSpace.setAttribute('data-replay_id',elem.id);
    eachMicropostSpace.setAttribute('data-micropost-id',elem.micropost_id);
    eachMicropostSpace.setAttribute('data-recipient',elem.user_name);

    //ユーザ名
    var micropostUserInfo = document.createElement('div');
    micropostUserInfo.className = 'micropost-user-info';
    var micropostUserInfoP = document.createElement('p');
    var micropostUserInfoSpan = document.createElement('span');
    micropostUserInfoSpan.className = 'glyphicon glyphicon-user';
    micropostUserInfoSpan.setAttribute('aria-hidden',true);
    micropostUserInfoP.appendChild(micropostUserInfoSpan);
    micropostUserInfoP.appendChild(document.createTextNode(elem.user_name));

    micropostUserInfo.appendChild(micropostUserInfoP);

    //返信ツイート
    var micropostContent = document.createElement('div');
    micropostContent.className = 'micropost-content';
    var micropostContentP = document.createElement('p');
    micropostContentP.innerHTML = elem.content;

    micropostContent.appendChild(micropostContentP);

    eachMicropostSpace.appendChild(micropostUserInfo);
    eachMicropostSpace.appendChild(micropostContent);
    return eachMicropostSpace;
  }
};
/*--------------------------------------------------------------*/
(function(){

  var micropost = new Micropost();
  var replay = new Replay();

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


  //返信表示
  addListener(document.getElementById('ovarall-micropost-space'),'click',function(e){
    var event = e.target;
    var modal = document.getElementById('micropostContentModal');
    if(
      event.getAttribute('id') === 'ovarall-micropost-space'||
      event.className === 'micropost-replay-button fa fa-reply' ||
      modal.contains(event)
    ){
      return false;
    }

    var modalContentSpace = modal.getElementsByClassName('modal-content')[0];
    var modalMicropostSpace = modal.getElementsByClassName('modal-micropost-space')[0];
    var eachMicropostSpace = document.getElementsByClassName('each-micropost-space');
    var jsMicropostReplayContentSpace = modal.getElementsByClassName('js-micropost-replay')[0];
    var jsReplaySpace = modal.getElementsByClassName('js-micropost-replay')[0];

    for (var i = 0; i < eachMicropostSpace.length ; i++){
      if(eachMicropostSpace[i].contains(event)){
        eachMicropostSpace = eachMicropostSpace[i];
        break;
      }
    }
    var   micropostId = eachMicropostSpace.getAttribute('data-micropost-id'),
          recipient = eachMicropostSpace.getAttribute('data-recipient').split(' '),
          content = eachMicropostSpace.getElementsByClassName('micropost-content-space')[0].innerHTML,
          detailLink = Micropost.ShowUrl,
          html = '';

    for (var i = 0,len = recipient.length; i < len; i++){
    			 html += '<a href="' + detailLink + '?name=' + recipient[i] + '">' + recipient[i] + '</a> ';
    }
		modalMicropostSpace.setAttribute('data-micropost-id',micropostId);
    modal.getElementsByClassName('modal-content')[0].setAttribute('data-user-id',eachMicropostSpace.getAttribute('data-user-id'));


    jsMicropostReplayContentSpace.innerHTML = html
    jsMicropostReplayContentSpace.focus();

    jsReplaySpace.style.height = '50px';
    jsReplaySpace.style.overflowY = 'scroll';

		replay.setUserNameLength(jsReplaySpace.textContent.length);
    modalMicropostSpace.innerHTML = content;

    $.ajax({
      type  : 'POST',
      datatype  : 'JSON',
      data : {'micropost_id' : micropostId},
      url : Micropost.ShowUrl
    }).done(function(response){
      var replayContent;
      while(true){
          var modalEachMicropostSpace = modalContentSpace.getElementsByClassName('each-micropost-space');
          if(modalEachMicropostSpace.length === 0){
            break;
          }
          removeElement(modalContentSpace,modalEachMicropostSpace[0]);
      }
      for(var i = 0; i < response.ReplayRowset.length ; i++){
        replayContent = replay.showContent(response.ReplayRowset[i]);
        modalContentSpace.appendChild(replayContent);
      }
      $(modal).modal();
    }).fail(function(status){
      showAlert($this,'ツイートは0文字以上140文字以内で入力してください');
    });

  });

  //返信投稿
  addListener(document.getElementById('micropostContentModal'),'click',function(e){
    var event = e.target;
    if(event.className !== 'btn btn-warning submit-replay'){
      return;
    }

    var jsMicropostReplayForm = this.getElementsByClassName('js-micropost-replay')[0];
    var modalMicropostSpace = this.getElementsByClassName('modal-micropost-space')[0];
    var modalContent = this.getElementsByClassName('modal-content')[0];
    var data = {
      'Replay[content]' : jsMicropostReplayForm.innerHTML,
      'Replay[micropost_id]' : modalMicropostSpace.getAttribute('data-micropost-id'),
      'Replay[user_id]' : modalContent.getAttribute('data-user-id'),
      'Replay[other_user_id]' : document.getElementById('data-ajax-url-list').getAttribute('data-user-id')
    };
		$.ajax({
			'type'		: 'POST',
			'url'		: Replay.registerUrl,
			'data' 		: data,
			'dataType'	:'json'
		}).done(function(data){
      var alert = document.createElement('div');
      alert.className = 'alert alert-info';
      alert.setAttribute('role','alert');
      alert.textContent = '返信を投稿しました';
      var row = document.getElementsByClassName('row')[0];
      row.insertBefore(alert, row.firstChild);

      setTimeout(function(){
        removeElement(row,alert);
      },2000);
		}).fail(function(status){
        alert('返信の投稿に失敗しました')
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
