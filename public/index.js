function deleteAction(id){
	var conf = confirm("Наистина ли искате да изтриете този продукт?");
	if(conf){
		$.post( location.href+"delete",{'id':id, '_token':$('#c_token').attr('content')}, function( data ) {
		  if(typeof data.success != "undefined"){
		  	$('.item-'+id).remove();
		  	
		  }
		});
	}
}

var pagination = {
	page:1,
	show:function(self){
		pagination.page++;
		$.get( "http://"+location.hostname+'/project/public/'+"paginate?page="+pagination.page+"&sort_price="+$('#sort_price').find(':selected').val(),
		 function( data ) {
		  if(data.data.length > 0){
		  	pagination.appendItems(data.data);
		  }
		  if(data.next_page_url == null){
		  		$(self).hide();
		  }
		});
	},
	appendItems:function (items){
	
	for(var i in items){
		
		var data = items[i];
		var item = $('.hide-item').clone()[0];
		$(item).find('.item_name').text(data.name);
		$(item).find('.item_name').text(data.description);
		$(item).find('.item_price').text("Цена:"+data.price+"лв.");
		$(item).find('.item_country').text("Произведено:"+data.country_object.name);
		$(item).find('.item_edit_btn').attr('href','edit/'+data.id);
		$(item).find('.item_delete_btn').attr('onclick','deleteAction('+data.id+')');
		$(item).removeClass('hide-item').addClass('item-'+data.id);
		$('.items').append(item);
		$(item).show();
	}
}
}

