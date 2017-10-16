/*!
 * Scripts v1.0 
 * Scripts interação do site
 */
$(function(){
 


        //Altura da pagina
        var heightWindow = window.innerHeight;
        
    
        //definir tamanho full screen                    
            $('#header').css({'min-height': heightWindow +'px'});
            
         /**
         * Scroll contato                                                           
         **/ 
         $('.link_cadastre').on('click',function(e){
             e.preventDefault();
                $('html,body').animate({
                scrollTop: $('#compre').offset().top
            },1000);
        });

        $('.link_cadastre_mobile').on('click',function(e){
             e.preventDefault();
                $('html,body').animate({
                scrollTop: $('#compre').offset().top - 90
            },1000);
        });

        $('.navbar-nav li a').on('click',function(e){
             e.preventDefault();
             var link = $(this).attr('href');
                $('html,body').animate({
                scrollTop: $(link).offset().top
            },1000);
        });
 

        /**
         * Exibir menu mobile                        
         *                                                 
         **/ 
         $(".icon-menu").on('click',function(e){                   
              $(".nav").toggle();
        });

         /**
         * Accordion                        
         *                                                 
         **/ 
         $(".open-accordion").on('click',function(e){                   
              $('.detail').hide();
              $(this).parents('li').find('.detail').slideToggle(500);
        });

        
         /**
         * Mascara de telefone para nove digitos            
         *                                                 
         **/ 
        $('input[type=telefone]').mask("(99) 9999-9999?9").ready(function(event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if(phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        });

         /**
         * Mascara de cpf para nove digitos            
         *                                                 
         **/ 
        $('.maskCpf').mask("999.999.999-99");
        $('.maskCnpj').mask("99.999.999/9999-99");
        $('.maskCC').mask("9999 9999 9999 9999");
        $('.maskCvv').mask("999");
        $('.maskValidade').mask("99/9999");
         $('input[type="radio"]').click(function(){
            if ($(this).is(':checked'))
            {
             //   card = moip.creditCard.cardType("4320 3274 6239 6112"); 
              //  cardIs = card.brand; // MASTERCARD
             
                if($(this).val() == 'cnpj'){
                  $('#documento').mask("99.999.999/9999-99");
                  
                }else{
                   $('#documento').mask("999.999.999-99");
                  
                }
            
            }
        });

    
        /**
         * PARALLAX HOMEPAGE                        
         *                                                 
         **/       
         var ypos,image,posHeader,widthWindow,heightHeader;
            function paralax(){
                widthWindow = window.innerWidth;
                ypos = window.pageYOffset;
                posHeader = document.getElementById('curso').offsetTop;
                
               heightHeader = $('#header').height();
                image = document.getElementById('header');              
              //  image.style.top = ypos * .4 +'px';
       
                    if(widthWindow > 900){
                            if(ypos >= heightHeader){
                                $(".sidebar").css({'position':'fixed'});
                            }else{
                                $(".sidebar").css({'position':'absolute'});
                            }
                    }else{
                         $(".nav").hide();
                         if(ypos >= heightHeader){
                                $(".sidebar-phone").css({'position':'fixed'});
                            }else{
                                $(".sidebar-phone").css({'position':'relative'});
                            }
                    }
              
            }
           
           // window.addEventListener("scroll",paralax);





         /**
         * Save user e prosseguir     
         *                                                 
         **/ 

         var opts = {
		   "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
		};




  
        
});

function save_ebook(form){
   
      console.log($('input[name=email]').val());
    
     if($(form).find('input[name=email]').val() == ''){alert('O campo email \é obrigat\ório!');return false;}
     if($(form).find('input[name=telefone]').val() == ''){alert('O campo whatsapp \é obrigat\ório!');return false;}
     
      var opts = {
		   "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
		};
    
 $.ajax({
                url:"/interesse",
                type:'post',
                data: $(form).serialize() ,
                dataType:"json",  
				error :function( jqXhr ) {
				 
					 if( jqXhr.status === 422 ) {
						   $errors = jqXhr.responseJSON; 
						   errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';
						    $.each( $errors, function( key, value ) {
								errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
							});
							 errorsHtml += '</ul>';
							toastr.error(errorsHtml, "Erro ao se cadastrar!", opts);
					 }
                     
				},  
                success: function(data){       
                $('input[name=email]').val('');     
                $('input[name=whatsapp]').val('');   
                if($(document).width()>500){
                   bioEp.hidePopup();
                }
                                          
               $('#modalebook').modal('show');                                 
                }
            });    
    
    return false;
}


function save_interesse(form,item){
   
      console.log($('input[name='+item+']').val());
     if($(form).find('input[name='+item+']').val() == ''){alert('O campo ' + item + ' \é obrigat\ório!');return false;}

      var opts = {
		   "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
		};
    
 $.ajax({
                url:"/interesse",
                type:'post',
                data: $(form).serialize() ,
                dataType:"json",  
				error :function( jqXhr ) {
				 
					 if( jqXhr.status === 422 ) {
						   $errors = jqXhr.responseJSON; 
						   errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';
						    $.each( $errors, function( key, value ) {
								errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
							});
							 errorsHtml += '</ul>';
							toastr.error(errorsHtml, "Erro ao se cadastrar!", opts);
					 }
                     
				},  
                success: function(data){       
                $('input[name='+item+']').val('');                              
                   alert("Cadastrado com sucesso!");              
                }
            });    
    
    return false;
}



function ebook_interesse(form){
         
    if($(form).find('input[name=email]').val() == ''){alert('O campo email \é obrigat\ório!');return false;}
     if($(form).find('input[name=telefone]').val() == ''){alert('O campo whatsapp \é obrigat\ório!');return false;}

      var opts = {
		   "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
		};
    
 $.ajax({
                url:"/ebook",
                type:'post',
                data: $(form).serialize() ,
                dataType:"json",  
				error :function( jqXhr ) {
				 
					 if( jqXhr.status === 422 ) {
						   $errors = jqXhr.responseJSON; 
						   errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';
						    $.each( $errors, function( key, value ) {
								errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
							});
							 errorsHtml += '</ul>';
							toastr.error(errorsHtml, "Erro ao se cadastrar!", opts);
					 }
                     
				},  
                success: function(data){       
                 $('input[name=email]').val('');     
                $('input[name=whatsapp]').val('');      
                   if($(document).width()>500){
                   bioEp.hidePopup();
                }
                                           
                  $('#modalebook').modal('show');            
                }
            });    
    
    return false;
}


 function enviarEmail(item){
 
    var opts = {
		   "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
		};


 $.ajax({
                url:"/user/saveEsgotado",
                type:'post',
                data: $(item).serialize() ,
                dataType:"json",  
				error :function( jqXhr ) {
				 
					 if( jqXhr.status === 422 ) {
						   $errors = jqXhr.responseJSON; 
						   errorsHtml = '<ul style="margin:0;padding:0;list-style:none;">';
						    $.each( $errors, function( key, value ) {
								errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
							});
							 errorsHtml += '</ul>';
							toastr.error(errorsHtml, "Erro ao se cadastrar!", opts);
					 }
                     
				},  
                success: function(data){
                    ga('send', {
                        hitType: 'event',   
                        eventCategory: 'Envios do formulario',                   
                        eventAction: 'formulario',
                        eventLabel: data.email
                        });
console.log(data.email);
                   
                   alert("Cadastrado com sucesso!");              
                }
            });    

return false;
}