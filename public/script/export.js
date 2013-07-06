function import_content() {
	var req = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject( 'Microsoft.XMLHTTP' );
	// Открываем соединение
	var strUrl = /*document.getElementById('url').innerHTML*/'http://rabota.ngs70.ru/vacancy?rubric[]=50';
	req.open( 'GET', '/export/ngs/?url=' + strUrl, true );
	// Вешаем на объект запроса обработчик события readystatechange
	req.onreadystatechange = function () {
		// readyState — это состояние запроса. Если он равен 4 (запрос выполнен), то…
		if ( req.readyState == 4 ) {
			// Проверяем, успешно ли выполнена загрузка документа
			if ( req.status == 200 ) {
				// Если да, то парсим текст ответа в DOM
				var node = document.createElement( 'DIV' );
				node.innerHTML = req.responseText;
				// Вернёт текст первой ссылки
				var items = node.getElementsByClassName('ra-elements-list__item');
				for (var i = 0; i < items.length; i++) {
					var item = items[i];
					try {
						var str = item.getElementsByClassName('ra-elements-list__h')[0].innerHTML; 
						var tmpItems = item.getElementsByClassName('ra-elements-list__list')[0].getElementsByTagName('li'); 
						for (var j = 0; j < tmpItems.length; j++) {
							var tmpItem = tmpItems[j];
							str += '\r\n';
							str += tmpItem.innerHTML;
						}
						str += '\r\n';
						str += item.getElementsByClassName('ra-elements-list__h')[1].innerHTML; 
						str += '\r\n';
						str += item.getElementsByClassName('ra-elements-list__h')[1].nextSibling.nodeValue;
						str += '\r\n';
						str += item.getElementsByClassName('ra-elements-list__h')[2].innerHTML; 
						str += '\r\n';
						var tmpNode = item.getElementsByClassName('ra-elements-list__h')[2].nextSibling;
						if (tmpNode != null) {
							str += tmpNode.innerHTML;			
							while (tmpNode.className != 'ra-elements-list__h') {
								tmpNode = tmpNode.nextSibling;
								if (tmpNode != null) {
									str += tmpNode.nodeValue;	
								}						
							}
						}
	
						str += '\r\n';
						str += item.getElementsByClassName('ra-elements-list__h')[3].innerHTML; 
						str += '\r\n';
							
						tmpNode = item.getElementsByClassName('ra-elements-list__h')[3].nextSibling;
						if (tmpNode != null) {
							str += tmpNode.innerHTML;
							while (tmpNode.className != 'ra-elements-list__contacts') {
								tmpNode = tmpNode.nextSibling;
								if (tmpNode != null) {
									str += tmpNode.nodeValue;	
								}
							}
						}
						
						str += '\r\n';
						str += item.getElementsByClassName('ra-elements-list__contacts__title')[0].innerHTML; 
						str += '\r\n';
						str += item.getElementsByClassName('ra-elements-list__contacts__section')[0].innerHTML; 
						
						var nodeResalt = document.getElementsByClassName('addtext_' + i)[0];
						nodeResalt.innerHTML = str.trim();
						
						nodeResalt = document.getElementsByClassName('addpriceinput_' + i)[0];
						var strPrice = item.getElementsByClassName('ra-elements-list__pay')[0].innerHTML;
						nodeResalt.innerHTML = strPrice.trim();
						
						nodeResalt = document.getElementsByClassName('addinput_' + i)[0];
						var strTitle = item.getElementsByClassName('ra-elements-list__title__link')[0].getElementsByTagName('h3')[0].innerHTML;
						nodeResalt.innerHTML = strTitle.trim();	
					} catch(err) {
						alert(err);
					}
				}
			}
		}
	};
	// Отсылаем запрос
	req.send( null );
}