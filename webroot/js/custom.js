$(function(){

	
	$('.register').on('click', '.registerBtn', function(e){
		e.preventDefault();
		e.stopPropagation();
		if($('.passcode').val().trim().length == 8){
			$.post('saveRegister', $('.registerForm').serialize(), function(data){
				if(data.status == 'error'){
					$.notify(data.msg, "error");
				} else if(data.status == 'success'){
					$.notify(data.msg, "success");
					window.location.href = '/my_app/users/loginPreview';
				}
			}, 'json');
		}else {
			$.notify("Please provide a 8 chracter long passcode.", 'error');
		}
		
	});


	$('.loginDiv').on('click', '.lognbtn',function(e){
		e.preventDefault();
		e.stopPropagation();
		$.post('login', $('.loginForm').serialize(), function(data){
			if(data.status == 'success'){
				window.location.href = '/my_app/accounts/dashboard';
			} else {
				$.notify("Wrong credential!!", 'error');
			}
		}, 'json');
	});

	$('.searhTran').on('click', '.checkTran', function(e){
		e.preventDefault();
		// aler('ok');
		if($('.from_date').val() && !$('.to_date').val()){
			alert('Please select To date');
			return false;
		}

		if($('.from_date').val() && $('.to_date').val()){
			var g1 = new Date($('.from_date').val()); 
		    // (YYYY-MM-DD) 
		    var g2 = new Date($('.to_date').val()); 
		    if (g1.getTime() > g2.getTime()){
		    	alert('To date must be saller than from date.');
		    	return false;
		    }
		}
		$.post('/my_app/accounts-transactions/report', $('.reportForm').serialize(), function(data){
			$('.reportTbl').empty();
			$('.reportTbl').html(data);
		}, 'html')
	});


	$('.checkblnc').on('click',  function(e){
		e.preventDefault();
		$.post('/my_app/accounts/checkBalance', $('.chckblncForm').serialize(), function(data){
			if(data.status == 'success'){
				$('.blnc').val(data.msg + ' €')
			} else {
				$.notify(data.msg, 'error');
				$('.blnc').val(0);
			}
		}, 'json');
	},);
});