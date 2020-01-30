<?php 
	require 'AF/AF.php';
	try {
		if(AF::session('admin')=='ok' || AF::session('admin')=='usuario' ){//ok administrador, usuario otro tipo
			$tipoPerfil=AF::session('admin');
			//echo $tipoPerfil;
			$miid=AF::session('id_usu');
			//echo $miid;
		}else{
			header('location:/index.php');
		}
	} catch (Exception $e) {
		
	}
	//date_default_timezone_set('UTC');
	//echo date("l");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Soporte Técnico</title>
	<?php AF::header(); ?>
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
	<script type="text/javascript" src="js/highcharts.js"></script>
	<!--<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>-->
	<style type="text/css">
		.success{
			background-color: #d4edda;
			color: #155724;
		}

		.alert{
			background-color: #f8d7da;
			color: #721c24;
		}
		.info{
			background-color: #cce5ff;
			color: #004085;
		}

		#popup div:hover{
			cursor: pointer;
		}

		#popup div{
			border-radius: 4px;
			-webkit-box-shadow: 7px 11px 28px -9px rgba(0,0,0,0.74);
			-moz-box-shadow: 7px 11px 28px -9px rgba(0,0,0,0.74);
			box-shadow: 7px 11px 28px -9px rgba(0,0,0,0.74);
		}
		.date{
			background-color: white !important;
			padding: 4px 10px;
			margin-right: 10px;
			border-radius: 3px;
		}
		.date:hover{
			cursor: pointer;
		}
		.btn-btn{
			background-color: red;
			padding: 8px 10px;
			color: white;
			border-radius: 3px;
		}

		.btn-btn:hover{
			cursor: pointer;
			transform: scale(1.1);
		}

		.row{
			display: flex;
		}

		.col-50{
			width: 50%;
		}

		@media (max-width: 600px) {
			.row {
				display: block;
			}
			.col-50{
				width: 100%;
				display: inline-block;
			}
		}

		.nuevasSolicitudes{
			color: #ca697a;
		}

		select{
			background-color: white;
			padding: 5px;
			font-size: 14px;
			border-radius: 4px;
			cursor: pointer;
		}

		select option{
			font-size: 14px;
		}

		.paginacion div{
			display: inline-block;
			padding: 10px 10px;
			background-color: red;
			font-size: 12px;
			vertical-align: top;
			color: white;
			border-radius: 4px;
		}
		.paginacion button{
			padding: 10px 10px;
			background-color: red;
			color: white;
			border-radius: 4px;
			cursor: pointer;
		}

		.paginacion button:hover{
			transform: scale(1.1);
		}

		.paginacion button b{
			font-size: 14px;
		}

		.lateral{
			width: 40px;
			top: 0;
			bottom: 0;
			left: 0;
			position: absolute;
			background-color: #242424;
		}

		.panel{
			left: 40px;
			top: 0;
			bottom: 0;
			position: absolute;
			right: 0;
		}

		.barra-superior{
			height: 40px;
			width: 100%;
			background-color: green;
			background-color: #242424;
		}

		.barra-superior div{
			font-size: 14px;
			padding: 10px 10px;
			color: #adadad; 
			text-align: center;
		}

		.texto{
			display: none;
			margin-left: 20px;
		}

		.body{
			overflow: auto;
			display: none;
			padding: 20px 20px;
			position: absolute;
			top: 40px;
			bottom: 0;
			right: 0;
			left: 0;
			background-color: #cecece;
			color: #5f5755;
		}

		.active{
			display: block;
		}

		.btn{
			width: 100%;
			height: 40px;
			background-color: transparent;
			border: none;
			font-size: 16px;
			/*border-color: #5f5755;
			border-bottom-style: solid;
			border-top-style: solid;
			border-width: 0.5px;
			border-right-style: none;
			border-left-style: none;*/

		}
		.btn:hover{
			cursor: pointer;
			background-color: #292929;
		}
		.btn b:hover{
			transform: scale(1.2);
		}
		.text-muted{
			color: #5f5755;
		}
		.text-active{
			color: #adadad;
			background-color: #292929;
			transform: scale(1.2);
		}

		.panel-animacion-on{
			animation-name: menu-on;
			animation-duration: 0.3s;
			animation-delay: 0.1s;
			animation-timing-function: ease-in;
		}

		.panel-animacion-off{
			animation-name: menu-off;
			animation-duration: 0.3s;
			animation-delay: 0.1s;
			animation-timing-function: ease-out;
		}

		.addBtn{
			color: #28a745;
			font-size: 26px;
		}

		.addBtn:hover{
			cursor: pointer;
			transform: scale(1.1);
		}

		.addUser{
			color: #28a745;
			font-size: 26px;
		}

		.addUser:hover{
			cursor: pointer;
			transform: scale(1.1);
		}
		.addUserPrueba{
			color: #28a745;
			font-size: 26px;
		}

		.addUserPrueba:hover{
			cursor: pointer;
			transform: scale(1.1);
		}

		.editUser{
			color: #007bff;
			font-size: 16px;
		}

		.editUser:hover{
			cursor: pointer;
			transform: scale(1.1);
		}

		.deleteUser{
			color: #dc3545;
			font-size: 16px;
		}

		.deleteUser:hover{
			cursor: pointer;
			transform: scale(1.1);
		}

		.axyz-fmk-mdl-cntnt-wrp{
			-moz-height: 500px !important;
		}

		table{
			text-align: center;
		}

		td,th{
			text-align: center !important;
		}

		@keyframes menu-on{
			0%{
				left: 40px;
			}
			100%{
				left: 250px;
			}
		}

		@keyframes menu-off{
			0%{
				left: 250px;
			}
			100%{
				left: 40px;
			}
		}

		
	</style>
	<script type="text/javascript">
		let pagina=1,cantidad=10;
		let menuToggle=0;
		function lahora(){
			dia=["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
			mes=["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
			     "Octubre", "Noviembre", "Diciembre"];
			window.setTimeout("lahora()", 1000);
			var f = new Date();
			fecha=f.toString();
			fecha=fecha.substring(16,24)+" - ";
			fecha+=dia[f.getDay()]+", "+f.getDate()+" de "+mes[f.getMonth()]+", "+f.getFullYear();
			$('.barra-superior').html('<div>'+fecha+'</div>');

		}

/*		console.group("Desarrollado por: ");
		console.table({Empresa: "Biobioapps Spa", Plataforma: "Soporte Biobioapps",Autores:"Jaime R. - Regnier N."});
		console.groupEnd();
*/
		var getBrowserInfo = function() {
			    var ua= navigator.userAgent, tem, 
			    M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
			    if(/trident/i.test(M[1])){
			        tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
			        return 'IE '+(tem[1] || '');
			    }
			    if(M[1]=== 'Chrome'){
			        tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
			        if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
			    }
			    M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
			    if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
			    return M.join(' ');
			};

		function comprobarModal(){
			//console.log()
			if(getBrowserInfo().includes('Firefox')){
				document.write("<style>.axyz-fmk-mdl-cntnt-wrp{height: 500px !important;}</style>");
			}
		}
		comprobarModal();


		$(function(){
			function toggle_active(clase, id, estaclase){
				$(clase).siblings().removeClass(estaclase);
				$(id).addClass(estaclase);
			}

			<?php
				if($tipoPerfil=='usuario'){?>
					$("#btn-solicitudes").on('click',function(e){
						toggle_active(".body","#panel-solicitudes", 'active');
						toggle_active(".btn", "#btn-solicitudes", "text-active");
						selectSolicitud.value="Todas";
						pagina=1;
						paginar();
						cargarSolicitudes(pagina, cantidad);
					});

					$("#btn-dashboard").on('click',function(e){
						toggle_active(".body","#panel-dashboard", 'active');
						toggle_active(".btn", "#btn-dashboard", "text-active");
						cargarDashboard();
					});

					$("#btn-usuarios").on('click',function(e){
						toggle_active(".body","#panel-usuarios", 'active');
						toggle_active(".btn", "#btn-usuarios", "text-active");
						cargarUsuarios();
					});
					$("#btn-usuariosPrueba").on('click',function(e){
						toggle_active(".body","#panel-usuariosPrueba", 'active');
						toggle_active(".btn", "#btn-usuariosPrueba", "text-active");
						mostrarTodoUser();
					});

					$("#btn-productos").on('click',function(e){
						toggle_active(".body","#panel-productos", 'active');
						toggle_active(".btn", "#btn-productos", "text-active");
						cargarProductos();
					});
					$("#panel-solicitudes").addClass("active");
					$("#btn-solicitudes").addClass("text-active");
				<?php } else{?>
					$("#panel-misSolicitudes").addClass("active");
					$("#btn-misSolicitudes").addClass("text-active");
				<?php } ?>

			$("#btn-toggle").on('click',function(e){
				if(menuToggle==0){
					$(this).html('<b class="fa fa-times"></b>');
					$('.panel').addClass("panel-animacion-on");
					setTimeout(function(){
						$(".lateral").css({'width':'250px'});
						$('.panel').css({'left':'250px'});
						$('.panel').removeClass("panel-animacion-on");
						$(".texto").map(function(index, element){
							element.style.display='inline-block';
						});
					},400);
					menuToggle=1;
				}else{
					$('.panel').addClass("panel-animacion-off");
					setTimeout(function(){
						$(".lateral").css({'width':'40px'});
						$('.panel').css({'left':'40px'});
						$('.panel').removeClass("panel-animacion-off");
						$(".texto").map(function(index, element){
							element.style.display='none';
						});
					},400);
					$(this).html('<b class="fa fa-bars"></b>');
					menuToggle=0;
				}
			});

			$("#btn-misSolicitudes").on('click',function(e){
				//console.log("boton missolicitudes");
				$("#btn-misSolicitudes b").removeClass("nuevasSolicitudes");
				toggle_active(".body","#panel-misSolicitudes", 'active');
				toggle_active(".btn", "#btn-misSolicitudes", "text-active");
				//selectSolicitud.value="Todas";
				selectMisSolicitudes.value="Todas";
				pagina=1;
				paginar();
				cargarMisSolicitudes(pagina, cantidad, <?php echo $miid; ?>, selectMisSolicitudes.value);
			});

			$("#btn-perfil").on('click',function(e){
				toggle_active(".body","#panel-perfil", 'active');
				toggle_active(".btn", "#btn-perfil", "text-active");
				cargarMiPerfil(<?php echo $miid ?>);
			});

			$("#btn-salir").on('click',function(e){
				toggle_active(".btn", "#btn-salir", "text-active");
				$.connect({
					'service':'Web',
					'method':'logout',
					'data':{'id':<?php echo $miid ?>},
					'ok':function(){
						location.reload();
					}
				});
			});

/*			$(".addUser").on('click', function(e){
				$([
					'<form>',
						'<div class="fieldset col10">',
							'<label>Nombre</label>',
							'<input type="text" name="nombre"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Apellido Paterno</label>',
							'<input type="text" name="apaterno"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Apellido Materno</label>',
							'<input type="text" name="amaterno"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Email</label>',
							'<input type="email" name="email"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Telefono</label>',
							'<input type="number" name="telefono"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Tipo Usuario</label>',
							'<select name="tusuario">',
								'<option>Administrador</option>',
								'<option>Desarrollo</option>',
								'<option>Soporte</option>',
							'</select>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Contraseña</label>',
							'<input type="password" name="password"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<input type="submit" value="Agregar Usuario"/>',
						'</div>',
					'</form>'
				].join('')).ui().modal({
					'width':500, 'title':'Nuevo Usuario'
				}).connect({
					'service':'Usuario',
					'method':'agregarUsuario',
					'ok':function(response){
						cargarUsuarios();
						$('.axyz-fmk-mdl-cvr').close();
						mensaje('El usuario ha sido agregado', "success");
						
					},
					'fail':function(response){
						mensaje(response, "alert");
					}
				});
			});*/

			$(".addUserPrueba").on('click', function(e){
				$([
					'<form>',
						'<div class="fieldset col10">',
							'<label>Nombre</label>',
							'<input type="text" name="nombre"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Apellido Paterno</label>',
							'<input type="text" name="apellidop"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Apellido Materno</label>',
							'<input type="text" name="apellidom"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Email</label>',
							'<input type="email" name="email"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Telefono</label>',
							'<input type="number" name="contacto"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Tipo Usuario</label>',
							'<select name="tipo">',
								'<option>Administrador</option>',
								'<option>Desarrollo</option>',
								'<option>Soporte</option>',
							'</select>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Contraseña</label>',
							'<input type="password" name="password"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<input type="submit" value="Agregar Usuario"/>',
						'</div>',
					'</form>'
				].join('')).ui().modal({
					'width':500, 'title':'Nuevo Usuario'
				}).connect({
					'service':'Prueba',
					'method':'pruebaAddUser',
					'ok':function(response){
						console.log(mostrarTodoUser());
						mostrarTodoUser();
						$('.axyz-fmk-mdl-cvr').close();
						mensaje('El usuario ha sido agregado', "success");
						
					},
					'fail':function(response){
						mensaje(response, "alert");
					}
				});
			});


			$("#addSolicitud").on('click', function(e){
				let usuario="<option value='0'>No asignado</option>";
				let producto="";
				$.connect({
					'service':'Producto',
					'method':'mostrarProductoUsuario',
					'ok':function(response){
						//console.log(response);
						response.usuarios.map(function(ele){

							usuario+="<option value="+ele.id+">"+ele.nombre+" "+ele.apellidop+" "+ele.apellidom+"</option>";

						});
						response.productos.map(function(ele){
							producto+="<option value="+ele.id+">"+ele.nombre+"</option>";
							console.log(producto);
						});
						//console.log(producto)
						//console.log(response);
						if(response.length!=0){
							$([
								'<form>',
									'<div class="fieldset col5">',
										'<label>Nombre Solicitante</label>',
										'<input type="text" name="nom_solicitante"/>',
									'</div>',
									'<div class="fieldset col5">',
										'<label>Email Solicitante</label>',
										'<input type="email" name="mail_solicitante"/>',
									'</div>',
									'<div class="fieldset col10">',
										'<label>Producto</label>',
										'<select name="product">',
											producto,
										'</select>',
									'</div>',
									'<div class="fieldset col10">',
										'<label>Descripcion Solicitud</label>',
										'<textarea name="decrip_solicitud"></textarea>',
									'</div>',
									'<div class="fieldset col10">',
										'<label>Usuario Soporte</label>',
										'<select name="id_usu">',
											usuario,
										'</select>',
									'</div>',
									'<div class="fieldset col10">',
										'<input type="submit" value="Agregar Solicitud"/>',
									'</div>',
								'</form>'].join('')).ui().modal({
									'width':500,'title':'Nueva Solicitud'
								}).connect({
									'service':'Solicitud',
									'method':'agregarSolicitud',
									'ok':function(reponse){
										cargarSolicitudes(pagina, cantidad);
										//console.log(response);
										$('.axyz-fmk-mdl-cvr').close();
										mensaje("Se ha agregado una nueva solicitud", "info");
									},
									'fail':function(response){
										mensaje(response, "alert");
									}
								});
						}else{
							mensaje("Debe ingresar usuarios al sistema para poder crear solicitudes", "info");
						}
						
					}
				});

			});

			$("#addProducto").on('click', function(e){
				$([
					'<form>',
						'<div class="fieldset col10">',
							'<label>Nombre Producto</label>',
							'<input type="text" name="nom_pro"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Descripcion Producto</label>',
							'<textarea name="descrip_pro"></textarea>',
						'</div>',
						'<div class="fieldset col10">',
							'<input type="submit" value="Agregar Producto"/>',
						'</div>',
					'</form>',
					].join('')).ui().modal({
						'width':500, 'title':'Nuevo Producto'
					}).connect({
						'service':'Producto',
						'method':'agregarProducto',
						'ok':function(){
							cargarProductos();
							$('.axyz-fmk-mdl-cvr').close();
							mensaje("Se ha agregado un nuevo producto", "info");
						},'fail':function(response){
							mensaje(response, "alert");
						}
					});
			});

			function getData(service, method, desde, hasta){
				return new Promise(function(resolve, reject){
					$.connect({
						'service':service,
						'method':method,
						'data':{'desde':desde, 'hasta':hasta},
						'ok':function(response){
							resolve(response);
						},
						'fail':function(response){
							reject(response);
						}
					});
				});
			}

		/*	function setDateDashboard(){
				let hoy = new Date();
				let mes=(1+hoy.getMonth())<10?'0'+(1+hoy.getMonth()):(1+hoy.getMonth());
				let fin=`${hoy.getFullYear()}-${mes}-${hoy.getDate()}`;
				let inicio=`${hoy.getFullYear()}-${mes}-01`;
				//console.log(inicio, ' - ', fin);
				let desde=$("#fecha")[0].childNodes[0];
				let hasta=$("#fecha")[0].childNodes[1];
				desde.value=inicio;
				hasta.value=fin;
			}

			setDateDashboard();*/

			$("#btn-consultar").on('click', function(){
				cargarDashboard();
			});

			function cargarDashboard(){
				let desde=$("#fecha")[0].childNodes[0].value;
				let hasta=$("#fecha")[0].childNodes[1].value;
				if(desde=="" || hasta==""){
					mensaje("Las fechas no son correctas", "alert");
					return;
				}
				let date1=new Date($("#fecha")[0].childNodes[0].value);
				let date2=new Date($("#fecha")[0].childNodes[1].value);
				if(date1>date2){
					mensaje("Las fechas no son correctas", "alert");
					return;
				}
				desde=`${desde} 00:00:00`;
				hasta=`${hasta} 23:59:59`;
				//console.log(desde, hasta)
				getData('Dashboard', 'cantidadEstados', desde, hasta).then(function(data){
					//console.log(data);
					Highcharts.chart('grafico1',{
						chart:{
							type:'pie',
						     backgroundColor:'#cecece',
						},
						title:{
							text:'<h1 style="font-size:24px;color:#666666;">Solicitudes por estado</h1>'
						},
						subtitle:{
							text:'Total solicitudes: '+data.total
						},
						 tooltip: {
						  pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						credits:{
							enabled:false
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: false,
									format: '<b style="background-color: #666666;">{point.name}</b>: {point.percentage:.1f} %',
								},
								showInLegend:true
							}
						},
						series:[
							{name:'Porcentaje',colorByPoint:true, data: [{name: 'Solicitudes Resueltas',y: data.resueltas, color:"#597DBB"}, { name: 'Solicitudes Asignadas',y: data.asignado, color:'#D65B6E'}, {name: 'Solicitudes No Asignadas', y: data.noasignado, color:"#5DD65B",sliced: true,selected: true,}]
					        }]
						});
				}).catch(function(error){
					mensaje(error, "alert");
				});

				getData('Dashboard', 'graficoSolicitudProductos', desde, hasta).then(function(data){
					//console.log(data);
					let xAxis=[];
					let yAxis=[];
					let totalSolicitudes=0;
					data.map(function(ele){
						xAxis.push(ele.nombre);
						let vector={};
						vector.name=ele.nombre;
						vector.data=[];
						vector.data.push(ele.resuelta);
						vector.data.push(ele.asignado);
						vector.data.push(ele.noasignado);
						totalSolicitudes+=(ele.resuelta+ele.asignado+ele.noasignado);
						yAxis.push(vector);
					});
					Highcharts.chart('grafico2',{
						chart:{
							type:'column',
						     backgroundColor:'#cecece'
						},
						title:{
							text:'<h1 style="font-size:24px;color:#666666;">Solicitudes por producto</h1>'
						},
						subtitle:{
							text:'Total solicitudes: '+totalSolicitudes
						},
						 tooltip: {
						 	headerFormat: '<div style="text-align:center;margin-bottom:8px;"><span style="font-size:10px;font-weight:bold;">{point.key}</span></div><table>',
						 	pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						 	'<td style="padding:0"><b>{point.y:.0f} solicitudes</b></td></tr>',
						 	footerFormat: '</table>',
						 	shared: true,
						 	useHTML: true
						},
						xAxis:{
							categories:['Resueltas','Asignadas','No Asignadas']
						},
						yAxis:{
							title:{
								enabled:true,
								text:'Solicitudes'
							}
						},
						credits:{
							enabled:false
						},
						series:yAxis
						});
				}).catch(function(error){
					mensaje(error, "alert");
				});

				getData('Dashboard', 'cantidadEstadosUsuario', desde, hasta).then(function(data){
					//console.log(data);
					let xAxis=[];
					let yAxis=[];
					let totalSolicitudes=0;
					data.map(function(ele){
						xAxis.push(ele.nombre);
						let vector={};
						vector.name=ele.nombre;
						vector.data=[];
						vector.data.push(ele.resuelta);
						vector.data.push(ele.asignado);
						totalSolicitudes+=(ele.resuelta+ele.asignado);
						yAxis.push(vector);
					});
					Highcharts.chart('grafico3',{
						chart:{
							type:'column',
						     backgroundColor:'#cecece'
						},
						title:{
							text:'<h1 style="font-size:24px;color:#666666;">Solicitudes por usuario</h1>'
						},
						subtitle:{
							text:'Total solicitudes: '+totalSolicitudes
						},
						yAxis:{
							title:{
								enabled:true,
								text:'Solicitudes'
							}
						},
						tooltip: {
						 	headerFormat: '<div style="text-align:center;margin-bottom:8px;"><span style="font-size:10px;font-weight:bold;">{point.key}</span></div><table>',
						 	pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						 	'<td style="padding:0"><b>{point.y:.0f} solicitudes</b></td></tr>',
						 	footerFormat: '</table>',
						 	shared: true,
						 	useHTML: true
						},
						xAxis:{
							categories:['Resueltas','Asignadas']
						},
						credits:{
							enabled:false
						},
						series:yAxis
						});
				}).catch(function(error){
					mensaje(error, "alert");
				});

				getData('Dashboard', 'graficoComplejidad', desde, hasta).then(function(data){
					//console.log(data);
					Highcharts.chart('grafico4',{
						chart:{
							type:'pie',
						     backgroundColor:'#cecece'
						},
						title:{
							text:'<h1 style="font-size:24px;color:#666666;">Solicitudes Resueltas por complejidad</h1>'
						},
						subtitle:{
							text:'Total solicitudes: '+data.total
						},
						 tooltip: {
						  pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						credits:{
							enabled:false
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: false,
									format: '<b style="background-color: #666666;">{point.name}</b>: {point.percentage:.1f} %',
								},
								showInLegend:true
							}
						},
						series:[
							{name:'Porcentaje',colorByPoint:true, data: [{name: 'Complejidad Baja',y: data.baja, color:"#96E786"}, { name: 'Complejidad Media',y: data.media, color:'#E5E786'}, {name: 'Complejidad Alta', y: data.alta, color:"#E78686",sliced: true,selected: true,}]
					        }]
						});

				}).catch(function(error){
					mensaje(error, "alert");
				});

				getData('Dashboard','fechas', desde, hasta).then(function(data){
					//console.log('data', data);
					let fecha=[];
					let estados={};
					let total=0;
					estados.resueltas=[];
					estados.asignados=[];
					estados.noasignados=[];
					estados.totales=[];
					data.map(function(ele){
						fecha.push(ele.fecha_solicitud.substring(0, 10));
						estados.resueltas.push(ele.resueltas);
						estados.asignados.push(ele.asignado);
						estados.noasignados.push(ele.noasignado);
						estados.totales.push(ele.total);
						total++;
					});
					//console.log(fecha, estados);
					Highcharts.chart('grafico-xl', {
						   chart:{
							    type:'line',
						        backgroundColor:'#cecece',
						        zoomType: 'x'
						    },
						    title:{
							    text:'<h1 style="font-size:24px;color:#666666;">Cantidad de solicitudes/dia</h1>'
						    },
						    subtitle:{
							    text: total+" dias"
						    },
						    xAxis: {
						        categories: fecha
						    },
							yAxis:{
								title:{
									enabled:true,
									text:'Solicitudes'
								}
							},
						    tooltip: {
							 	headerFormat: '<div style="text-align:center;margin-bottom:8px;"><span style="font-size:10px;font-weight:bold;">Fecha: {point.key}</span></div><table>',
							 	pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							 	'<td style="padding:0"><b>{point.y:.0f} solicitudes</b></td></tr>',
							 	footerFormat: '</table>',
							 	shared: true,
							 	useHTML: true
							},
							credits:{
								enabled:false
							},
						    series: [{name: 'Resueltas',data: estados.resueltas }, {name: 'Asignadas',data: estados.asignados}, {name:'No Asignados', data: estados.noasignados}, {name: 'Totales',data: estados.totales }]
						});
				}).catch(function(error){
					mensaje(error, "alert");
				});

				getData('Dashboard','promedioSolucion', desde, hasta).then(function(data){
					//console.log('grafico click',data)
					let obj=[], array=[], xAxis=[], yAxis=[];let vector=[];
					let cantidad=0;
					if(data!=null){
						cantidad=data.length;
						data.map(function(ele){
							
							xAxis=ele.id;
							yAxis.push(ele.promedio)
							vector['name']=ele.id;
							vector['data']=ele.promedio;
							vector.push([ele.id, ele.promedio])
							obj.push(xAxis);
							
						});
					}
					
					//console.log('xAxis',vector)
					
					Highcharts.chart('grafico-xl2',{
						chart:{
							type:'column',
						     backgroundColor:'#cecece',
						     zoomType:'xy'
						},
						title:{
							text:'<h1 style="font-size:24px;color:#666666;">Tiempo de solución por solicitud resuelta</h1>'
						},
						subtitle:{
							text:'Total solicitudes: '+cantidad
						},
						plotOptions: {
					        series: {
					            cursor: 'pointer',
					            events: {
					                click: function (event) {
					                	//console.log(event.point.name)
					                	if(data!=null){
						                	data.map(function(ele){
						                		if(parseInt(event.point.name) ==ele.id){
						                			$([
						                				'<div class="fieldset col10">',
						                					'<table class="ui-table"><tbody><tr><td>id solicitud</td><td>'+ele.id+'</td></tr>',
						                					'<tr><td>Producto</td><td>'+ele.producto+'</td></tr>',
						                					'<tr><td>Responsable</td><td>'+ele.nombre+'</td></tr>',
						                					'<tr><td>Complejidad</td><td>'+ele.complejidad+'</td></tr>',
						                					'<tr><td>Descripcion Solicitud</td><td>'+ele.descripcion+'</td></tr>',
						                					'<tr><td>Descripcion Solucion</td><td>'+ele.detalle+'</td></tr>',
						                					'</tbody></table>',
						                				'</div>'
						                				].join('')).modal({
						                					'width':500, 'title':'Solicitud id: '+ele.id
						                				});
						                		}
						                	});
					                	}
					                	
					                }
					            }
					        }
					    },
						tooltip: {
						 	headerFormat: '<div style="text-align:center;margin-bottom:8px;"><span style="font-size:10px;font-weight:bold;">Id solicitud: {point.key}</span></div><table>',
						 	pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						 	'<td style="padding:0"><b>{point.y:.2f} Hrs.</b></td></tr>',
						 	footerFormat: '</table>',
						 	shared: true,
						 	useHTML: true
						},
						xAxis:{
							type:'category'
						},
						yAxis:{
							tickPositions: [0,7,15,20, 70],//horas
							title:{
								enabled:true,
								text:'Horas'
							},
							plotBands: 
						        [
						          { 
						            from: 0,
						            to: 7,
						            color: '#89FF79',
						            label: {
						              useHTML:true,
						              text: '<div style="z-index:1000;font-weight:bold;font-size:12px;">Solucion Rapida</div>',
						              style: {
						                color: '#1A9E00'
						              }
						            }
						          }, { 
						            from: 7,
						            to: 15,
						            color: '#EAFF66',
						            label: {
						            	useHTML:true,
						              text: '<div style="z-index:1000;font-weight:bold;font-size:12px;">Solucion Media</div>',
						              style: {
						                color: '#E3C100'
						              }
						            }
						          }, { 
						            from: 15,
						            to: 20,
						            color: '#FFA050',
						            label: {
						            	useHTML:true,
						              text: '<div style="z-index:1000;font-weight:bold;font-size:12px;">Solucion lenta</div>',
						              style: {
						                color: '#FF6C00'
						              }
						            }
						          },
						          { 
						            from: 20,
						            to: 70,
						            color: '#FF5353',
						            label: {
						            	useHTML:true,
						              text: '<div style="z-index:1000;font-weight:bold;font-size:12px;">Solucion Muy lenta</div>',
						              style: {
						                color: '#ff0000'
						              }
						            }
						          }
						        ]
						},
						credits:{
							enabled:false
						},
						series:[{name:'Solicitudes', data:vector, color :'#FF99E2'}]
						});
				}).catch(function(error){
					mensaje(error, "alert");
				});


			}

			

		});// fin $(function(){})

		function beep() {
    		var snd = new new Audio('data:audio/ogg;base64,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');
    		snd.play();
		}



		function paginar(){
			$(".paginacion div").empty();
			$(".paginacion div").append(pagina);
		} 

		let promesa = function(select, panel){
			if(select=="Todas"){
				select="";
			}
			if(panel=="solicitudes"){
				return new Promise(function (resolve, reject){
					$.connect({
						'service':'Solicitud',
						'method':'cantidadSolicitudTotal',
						'data':{'estado':select},
						'ok':function(response){
							resolve(response);
						},
						'fail':function(response){
							reject(response);
						}
					});
					//reject("Ocurrio error");
				});
			}else{
				return new Promise(function (resolve, reject){
					$.connect({
						'service':'Solicitud',
						'method':'cantidadSolicitudes',
						'data':{'id_usu':<?php echo $miid;?>, 'estado':select},
						'ok':function(response){
							resolve(response);
						},
						'fail':function(response){
							reject(response);
						}
					});
				});
			}			
		} 


		function navegar(dir, panel){
			let mover=false;
			if(panel=="solicitudes"){
				promesa(selectSolicitud.value, panel).then(function(data){
					//console.log('data', data, 'operacion', pagina*cantidad)
					if(data.cantidad>(pagina*cantidad)){
						if(dir==1){
							pagina++;
							mover=true;
							//console.log('pagina', pagina, 'dir', dir)
						}else{
							if(pagina>1){
								pagina--;
								mover=true;
							}
						}
					}else{
						if(dir==-1){
							if(pagina>1){
								pagina--;
								mover=true;
							}
						}
					}
					if(mover){
						paginar();
						cargarSolicitudes(pagina, cantidad, selectSolicitud.value);
					}
				}).catch(function(data){console.log(data)});
			}else{
				promesa(selectMisSolicitudes.value, panel).then(function(data){
					//console.log('data', data, 'operacion', pagina*cantidad)
					if(data.cantidad>(pagina*cantidad)){
						if(dir==1){
							pagina++;
							mover=true;
							//console.log('pagina', pagina, 'dir', dir)
						}else{
							if(pagina>1){
								pagina--;
								mover=true;
							}
						}
					}else{
						if(dir==-1){
							if(pagina>1){
								pagina--;
								mover=true;
							}
						}
					}
					if(mover){
						paginar();
						cargarMisSolicitudes(pagina, cantidad, <?php echo $miid; ?>,selectMisSolicitudes.value);
					}
				}).catch(function(data){console.log(data)});
			}
			
		}

		function editUser(id){
			$.connect({
				'service':'Usuario',
				'method':'mostrarUsuario',
				'data':{'id':id},
				'ok':function(response){
					if(response.length!=0){
						let option;
						response[0].tipo=="Administrador"?option="<option selected>Administrador</option><option>Desarrollo</option><option>Soporte</option>":response[0].tipo=="Soporte"?option="<option>Administrador</option><option>Desarrollo</option><option selected>Soporte</option>":option="<option>Administrador</option><option selected>Desarrollo</option><option>Soporte</option>"
						$([
						'<form>',
							'<div class="fieldset col10">',
								'<label>Nombre</label>',
								'<input type="text" name="nombre" value="'+response[0].nombre+'"/>',
								'<input type="hidden" name="id" value="'+id+'"/>',
							'</div>',
							'<div class="fieldset col10">',
								'<label>Apellido Paterno</label>',
								'<input type="text" name="apaterno" value="'+response[0].apellidop+'"/>',
							'</div>',
							'<div class="fieldset col10">',
								'<label>Apellido Materno</label>',
								'<input type="text" name="amaterno" value="'+response[0].apellidom+'"/>',
							'</div>',
							'<div class="fieldset col10">',
								'<label>Email</label>',
								'<input type="email" name="email" value="'+response[0].email+'"/>',
							'</div>',
							'<div class="fieldset col10">',
								'<label>Telefono</label>',
								'<input type="number" name="telefono" value="'+response[0].contacto+'"/>',
							'</div>',
							'<div class="fieldset col10">',
								'<label>Tipo Usuario</label>',
								'<select name="tusuario">',
									option,
								'</select>',
							'</div>',
							'<div class="fieldset col10">',
								'<input type="submit" value="Editar Usuario"/>',
							'</div>',
						'</form>'
						].join('')).ui().modal({
							'width':500, 'title':'Editar Usuario'
						}).connect({
							'service':'Usuario',
							'method':'editarUsuario',
							'ok':function(){
								$('.axyz-fmk-mdl-cvr').close();
								cargarUsuarios();
								mensaje('Los datos han sido actualizados', 'success');
							},
							'fail':function(response){
								mensaje(response, 'alert');
							}
						});
					}
				}
			});
		}

		function deleteUser(id){
			if(confirm("¿Está seguro de eliminar al usuario?")){
				$.connect({
					'service':'Usuario', 
					'method':'eliminarUsuario',
					'data':{'id':id},
					'ok':function(){
						cargarUsuarios();
						mensaje("Usuario eliminado", "info");
					},
					'fail':function(response){
						mensaje(response, "alert");
					}
				});
				//console.log("delete user");
			}
		}

		function cargarUserTipo($tipoUser){
			$.connect({
				'service':'Prueba',
				'method':'mostrarUsuariosTipo',
				'data':{'tipo':tipo},
				'ok':function(response){
					$('#tusuariosPrueba tbody').empty();
					if (response.length!=0){

						response.map(function(ele){
						$('#tusuariosPrueba tbody').append("<tr><td>"+ele.nombre+"</td><td>"+ele.apellidop+"</td><td>"+ele.apellidom+"</td><td>"+ele.email+"</td><td>"+ele.tipo+"</td></tr>");

						});
					}
				},
				'fail':function(response){
					mensaje(response,"ALERTA!")
				}


			});

		}

		function cargarUsuarios(){
			$.connect({
				'service':'Usuario',
				'method':'mostrarUsuarios',
				'ok':function(response){
					$("#tusuarios tbody").empty();
					if(response.length!=0){
						
						response.map(function(ele){
							$("#tusuarios tbody").append("<tr><td>"+ele.nombre+"</td><td>"+ele.apellidop+"</td><td>"+ele.apellidom+"</td><td>"+ele.email+"</td><td>"+ele.tipo+"</td><td><b class='fa fa-pencil-alt editUser' onclick='editUser("+ele.id+")'></b></td><td><b class='fa fa-minus-circle deleteUser' onclick='deleteUser("+ele.id+")'></b></td></tr>");
							//console.log(ele);
						});
					}
				},
				'fail':function(response){
					mensaje(response, "alert");
				}
			});
		}

/*		function cargarPruebaUser(){
			$.connect({
				'service':'Prueba',
				'method':'pruebaAddUser',
				'ok':function(response){
					$("#tusuarios tbody").empty();
					if(response.length!=0){
						
						response.map(function(ele){
							$("#tusuarios tbody").append("<tr><td>"+ele.nombre+"</td><td>"+ele.apellidop+"</td><td>"+ele.apellidom+"</td><td>"+ele.email+"</td><td>"+ele.tipo+"</td><td><b class='fa fa-pencil-alt editUser' onclick='editUser("+ele.id+")'></b></td><td><b class='fa fa-minus-circle deleteUser' onclick='deleteUser("+ele.id+")'></b></td></tr>");
							//console.log(ele);
						});
					}
				},
				'fail':function(response){
					mensaje(response, "alert");
				}
			});
		}*/

		function cargarMiPerfil(id){
			$.connect({
				'service':'Usuario',
				'method':'mostrarUsuario',
				'data':{'id':id},
				'ok':function(response){
					//console.log(response);
					$("#panel-perfil").empty();
					$("#panel-perfil").append(`<div style="text-align:center;font-size:14px;line-height:25px;margin-top:30px;font-weight:bold;"><table class='ui-table'><thead><tr><th colspan="2" style='font-size:16px;'>Datos Personales</th></tr></thead><tbody><tr><td style='width:50% !important;font-size:14px;'>Nombre:</td><td style='width:50% !important;font-size:14px;'> ${response[0].nombre} ${response[0].apellidop} ${response[0].apellidom}</td></tr><tr><td  style='font-size:14px;'>E-mail</td><td  style='font-size:14px;'>${response[0].email}</td></tr><tr><td  style='font-size:14px;'>Telefono</td><td  style='font-size:14px;'>${response[0].contacto}</td></tr><tr><td  style='font-size:14px;'>Perfil</td><td  style='font-size:14px;'>${response[0].tipo}</td></tr></tbody><tfoot><tr><td colspan="2"><button style='width:150px !important;padding:10px;font-size:12px;' onclick='updateDatos(${id}, "${response[0].email}", ${response[0].contacto})' class='btn-btn'>Actualizar Datos</button></td></tr><tr><td colspan="2"><button style='width:150px !important;padding:10px;font-size:12px;' onclick='updatePass(${id})' class='btn-btn'>Actualizar Contraseña</button></td></tr></tfoot></table></div>`);
				},
				'fail':function(response){
					mensaje(response, "alert");
				}
			});
		}

		function updateDatos(id, email, telefono){
			$([
				'<form>',
					'<div class="fieldset col10">',
						'<label>Email</label>',
						'<input type="email" name="email" value="'+email+'"/>',
						'<input type="hidden" name="id" value="'+id+'"/>',
					'</div>',
					'<div class="fieldset col10">',
						'<label>Telefono</label>',
						'<input type="number" name="telefono" value="'+telefono+'"/>',
					'</div>',
					'<div class="fieldset col10">',
						'<input type="submit" value="Actualizar Datos"/>',
					'</div>',
				'</form>'
				].join('')).ui().modal({
					'width':500, 'title':'Editar Usuario'
				}).connect({
					'service':'Usuario',
					'method':'editarPerfil',
					'ok':function(response){
						$('.axyz-fmk-mdl-cvr').close();
						mensaje(response, "success");
						cargarMiPerfil(id)
					},
					'fail':function(response){
						$('.axyz-fmk-mdl-cvr').close();
						mensaje(response, "alert");
					}
				});
		}


		function updatePass(id){
			$([
				'<form>',
					'<div class="fieldset col10">',
						'<label>Contraseña Actual</label>',
						'<input type="password" name="pass"/>',
						'<input type="hidden" name="id" value="'+id+'"/>',
					'</div>',
					'<div class="fieldset col10">',
						'<label>Nueva Contraseña</label>',
						'<input type="password" name="pass1"/>',
					'</div>',
					'<div class="fieldset col10">',
						'<label>Repetir Contraseña</label>',
						'<input type="password" name="pass2"/>',
					'</div>',
					'<div class="fieldset col10">',
						'<input type="submit" value="Actualizar Contraseña"/>',
					'</div>',
				'</form>'
				].join('')).ui().modal({
					'width':500, 'title':'Editar Usuario'
				}).connect({
					'service':'Usuario',
					'method':'cambiarPass',
					'ok':function(response){
						$('.axyz-fmk-mdl-cvr').close();
						mensaje(response, "success");
					},
					'fail':function(response){
						$('.axyz-fmk-mdl-cvr').close();
						mensaje(response, "alert");
					}
				});
			//console.log(id)
		}



		function deleteSolicitud(id){
			if(confirm("¿Esta seguro de eliminar la solicitud?")){
				$.connect({
					'service':'Solicitud',
					'method':'eliminarSolicitud',
					'data':{'id_sol':id},
					'ok':function(){
						cargarSolicitudes(pagina, cantidad);
						//console.log("delete solicitud");
						mensaje("La solicitud ha sido eliminada", "info");
					},
					'fail':function(response){
						mensaje(response, "alert");
					}
				});
			}
		}

		function editSolicitud(id){
			let usuario="";
			let producto="";
			$.connect({
				'service':'Solicitud',
				'method':'mostrarSolicitud',
				'data':{'id_sol':id},
				'ok':function(response){
					//console.log(response.solicitud[0]);
					let existe=true;
					response.usuarios.map(function(ele){
						if(ele.id==response.solicitud[0].id_usuario){
							usuario+="<option selected value='"+ele.id+"'>"+ele.nombre+" "+ele.apellidop+" "+ele.apellidom+"</option>";
						}else{
							usuario+="<option value='"+ele.id+"'>"+ele.nombre+" "+ele.apellidop+" "+ele.apellidom+"</option>";
						}
					});
					response.productos.map(function(ele){
						if(ele.id==response.solicitud[0].id_producto){
							producto+="<option selected value='"+ele.id+"'>"+ele.nombre+"</option>";
						}else{
							producto+="<option value='"+ele.id+"'>"+ele.nombre+"</option>";
						}
						

					});
					//console.log("option usuario: ", usuario);
					//console.log("option producto: ",producto);
					$([
						'<form>',
							'<div class="fieldset col5">',
								'<label>Nombre Solicitante</label>',
								'<input type="text" name="nom_solicitante" value="'+response.solicitud[0].nombre_solicitante+'"/>',
							'</div>',
							'<div class="fieldset col5">',
								'<label>Email Solicitante</label>',
								'<input type="email" name="mail_solicitante" value="'+response.solicitud[0].email_solicitante+'"/>',
							'</div>',
							'<div class="fieldset col10">',
								'<label>Producto</label>',
								'<select name="product">',
									producto,
								'</select>',
							'</div>',
							'<div class="fieldset col10">',
								'<label>Descripcion Solicitud</label>',
								'<textarea name="decrip_solicitud">'+ response.solicitud[0].descripcion_solicitud+'</textarea>',
							'</div>',
							'<div class="fieldset col10">',
								'<label>Usuario Soporte</label>',
								'<select name="id_usu">',
									usuario,
								'</select>',
							'</div>',
							'<input type="hidden" name="id_sol" value='+response.solicitud[0].id+'>',
							'<div class="fieldset col10">',
								'<input type="submit" value="Editar Solicitud"/>',
							'</div>',
						'</form>'
					].join('')).ui().modal({
						'width':500, 'title':'Editar Solicitud'
					}).connect({
						'service':'Solicitud',
						'method':'modificarSolicitud',
						'ok':function(){
							$('.axyz-fmk-mdl-cvr').close();
							cargarSolicitudes(pagina, cantidad, selectSolicitud.value);
							mensaje('Los datos han sido actualizados', "success");
						}, 
						'fail':function(response){
							mensaje(response, "success");
						}
					});
				},
				'fail':function(response){
					mensaje(response, "alert");
				}
			});
		}

		function cargarSolicitudes(pagina, cantidad, estado=""){
			//console.log("estado: ",estado)
			if(estado=="Todas"){
				estado="";
			}
			$.connect({
				'service':'Solicitud',
				'method':'mostrarSolicitudes',
				'data':{'pagina':pagina, 'cantidad':cantidad, 'estado':estado},
				'loader':false,
				'ok':function(response){
					$("#tsolicitudes tbody").empty();
					if(response.length!=0){
						//console.log(response);
						response.map(function(ele){
							$("#tsolicitudes tbody").append("<tr><td>"+ele.id+"</td><td>"+ele.fecha_solicitud+"</td><td>"+ele.estado_solicitud+"</td><td>"+ele.nombre_solicitante+"</td><td>"+ele.email_solicitante+"</td><td>"+ele.nombre_producto+"</td><td>"+ele.descripcion_solicitud+"</td><td>"+ele.fecha_solucion+"</td><td>"+ele.nombre+"</td><td>"+ele.complejidad+"</td><td>"+ele.descripcion_solucion+"</td><td><b class='fa fa-pencil-alt editUser' onclick='editSolicitud("+ele.id+")'></b></td><td><b class='fa fa-minus-circle deleteUser'  onclick='deleteSolicitud("+ele.id+")'></b></td></tr>");
						});
					}
				},
				'fail':function(response){
					mensaje(response, "alert");
				}
			});
		}

		function editUsuario(id){
			$.connect({
				'service':'Prueba',
				'method':'mostrarIDusuario',
				'data':{'id':id},
				'ok':function(response){
				console.log(response);
				let option;
						response.tipo=="Administrador"?option="<option selected>Administrador</option><option>Desarrollo</option><option>Soporte</option>":response.tipo=="Soporte"?option="<option>Administrador</option><option>Desarrollo</option><option selected>Soporte</option>":option="<option>Administrador</option><option selected>Desarrollo</option><option>Soporte</option>"					
					$([
						'<form>',
						'<input type="hidden" name="id" value="'+response.id+'"/>',
						'<div class="fieldset col10">',
						'<label>Nombre Usuario</label>',
						'<input type="text" name="nombreUsr" value="'+response.nombre+'"/>',
						'</div>',
						'<div class="fieldset col10">',
						'<label>Apellido Paterno</label>',
						'<input type="text" name="appa" value="'+response.apellidop+'"/>',
						'</div>',
						'<div class="fieldset col10">',
						'<label>Apellido Materno</label>',
						'<input type="text" name="apma" value="'+response.apellidom+'"/>',
						'</div>',
						'<div class="fieldset col10">',
						'<label>Correo Electronico</label>',
						'<input type="email" name="emailu" value="'+response.email+'"required/>',
						'</div>',						
						'<div class="fieldset col10">',
						'<label>Telefono</label>',
						'<input type="tel" name="tel" value="'+response.contacto+'" required/>',
						'</div>',
						'<div class="fieldset col10">',
						'<label>password</label>',
						'<input type="password" name="passusr" value="'+response.password+'" required/>',
						'</div>',
						'<div class="fieldset col10">',
						'<label>Tipo Cuenta</label>',
						'<select name"tiusuario">',
						option,
						'</select>',
						'</div>',
						].join('')).ui().modal({
							'width':500,'title':'Editar Usuario'
						}).connect({
							'service':'Prueba',
							'method':'editarUsuario',
							'ok':function(){
								$('.axyz-fmk-mdl-cvr').close();
								mostrarTodoUser();
								mensaje('Los datos han sido actualizados', "success");
							},
							'fail':function(){
								mensaje(response,"ALERTA editarUsuario");
							}

						})


				},
				'fail':function(){
					mensaje(response,"ALERTA mostrarIDusuario");
				}


			});

		}

		function delUsuario(id){
			if(confirm('¿Esta seguro que desea eliminar este usuario?')){
			$.connect({
				'service':'Prueba',
				'method': 'eliminarUser',
				'data':{'id':id},
				'ok':function(response){
				mostrarTodoUser();
				},
				'fail':function(response){
					mensaje(response,"ALERTA eliminarUser");
				}
			});

			}

		}

		function editProducto(id){
			$.connect({
				'service':'Producto',
				'method':'mostrarProductoID',
				'data':{'id_pro':id},
				'ok':function(response){
					console.log(response);
					$([
					'<form>',
						'<div class="fieldset col10">',
							'<label>Nombre Producto</label>',
							'<input type="text" name="nom_pro" value="'+response.nombre+'"/>',
						'</div>',
						'<div class="fieldset col10">',
							'<label>Descripcion Producto</label>',
							'<textarea name="descrip_pro" >'+response.descripcion+'</textarea>',
						'</div>',
						'<input type="hidden" name="id_pro" value="'+response.id+'">',
						'<div class="fieldset col10">',
							'<input type="submit" value="Editar Producto"/>',
						'</div>',
					'</form>',
					].join('')).ui().modal({
						'width':500, 'title':'Editar Producto'
					}).connect({
						'service':'Producto',
						'method':'modificarProducto',
						'ok':function(){
							$('.axyz-fmk-mdl-cvr').close();
							cargarProductos();
							mensaje('Los datos han sido actualizados', "success");
						},
						'fail':function(response){
							mensaje(response, "alert");
						}
					});
				},
				'fail':function(response){
					mensaje(response, "alert");
				}
			});
		}

		function deleteProducto(id){
			if(confirm('¿Esta seguro de eliminar el producto?')){
				$.connect({
					'service':'Producto',
					'method':'eliminarProducto',
					'data':{'id_pro':id},
					'ok':function(){
						cargarProductos();
					},'fail':function(response){
						mensaje(response, "alert");
					}
				});
			}
		}

		function mostrarTodoUser(){
			$.connect({
				'service':'Prueba',
				'method': 'mostrarTodoUser',
				'ok':function(response){
					console.log(response);
					$('#tusuariosPrueba tbody').empty();
					if(response.length!=0){
						response.map(function(ele){
							$("#tusuariosPrueba tbody").append("<tr><td>"+ele.nombre+"</td><td>"+ele.apellidop+"</td><td>"+ele.apellidom+"</td><td>"+ele.email+"</td><td>"+ele.tipo+"</td><td>"+ele.contacto+"</td><td><b class='fa fa-pencil-alt editUser' onclick='editUsuario("+ele.id+")'></b></td><td><b class='fa fa-minus-circle deleteUser'  onclick='delUsuario("+ele.id+")'></b></td></tr>");


						});
					}
				},
				'fail':function(response){
					mensaje(response,"ALERTA mostrarTodoUser!")
				}


			});
		}

		function cargarProductos(){
			$.connect({
				'service':'Producto',
				'method':'mostrarProductos',
				'ok':function(response){
					//console.log(response)
					$("#tproductos tbody").empty();
					if(response.length!=0){
						console.log(response);
						
						response.map(function(ele){
							$("#tproductos tbody").append("<tr><td>"+ele.id+"</td><td>"+ele.nombre+"</td><td>"+ele.descripcion+"</td><td><b class='fa fa-pencil-alt editUser' onclick='editProducto("+ele.id+")'></b></td><td><b class='fa fa-minus-circle deleteUser'  onclick='deleteProducto("+ele.id+")'></b></td></tr>");
						});
					}
				},
				'fail':function(response){
					mensaje(response, "alert");
				}
			});
		}

		function cargarMisSolicitudes(pagina, cantidad, id, estado){
			if(estado=="Todas"){
				estado="";
			}
			//console.log(estado);
			$.connect({
				'service':'Solicitud',
				'method':'filtrarSolicitudUsuario',
				'data':{'pagina':pagina, 'cantidad':cantidad, 'id_usu':id, 'estado':estado},
				'loader':false,
				'ok':function(response){
					console.log(response);
					$("#tmissolicitudes tbody").empty();
					if(response.length!=0){
						response.map(function(ele){
							console.log(ele);
							if(ele.estado_solicitud=="Resuelta"){
								$("#tmissolicitudes tbody").append("<tr><td>"+ele.id+"</td><td>"+ele.fecha_solicitud+"</td><td>"+ele.estado_solicitud+"</td><td>"+ele.nombre_solicitante+"</td><td>"+ele.email_solicitante+"</td><td>"+ele.nombre_producto+"</td><td>"+ele.descripcion_solicitud+"</td><td>"+ele.fecha_solucion+"</td><td>"+ele.nombre+"</td><td>"+ele.complejidad+"</td><td>"+ele.descripcion_solucion+"</td><td></td></tr>");
							}else{
								$("#tmissolicitudes tbody").append("<tr><td>"+ele.id+"</td><td>"+ele.fecha_solicitud+"</td><td>"+ele.estado_solicitud+"</td><td>"+ele.nombre_solicitante+"</td><td>"+ele.email_solicitante+"</td><td>"+ele.nombre_producto+"</td><td>"+ele.descripcion_solicitud+"</td><td>"+ele.fecha_solucion+"</td><td>"+ele.nombre+"</td><td>"+ele.complejidad+"</td><td>"+ele.descripcion_solucion+"</td><td><b class='fa fa-pencil-alt editUser' onclick='editMiSolicitud("+ele.id+")'></b></td></tr>");
							}
							
						});
					}

				},
				'fail':function(response){
					mensaje(response, "alert");
				}
			});
		}

		function editMiSolicitud(id){
			//console.log("editmisolicitud", id);
			$.connect({
				'service':'Solicitud',
				'method':'mostrarSolicitud',
				'data':{'id_sol':id},
				'ok':function(response){
					//console.log(response.solicitud[0]);
					let complejo="";
					if(response.solicitud[0].complejidad==""){
						complejo="<option>baja</option><option>media</option><option>alta</option>";
					}else{
						if(response.solicitud[0].complejidad=="baja"){
							complejo="<option selected>baja</option><option>media</option><option>alta</option>";
						}else if(response.solicitud[0].complejidad=="media"){
							complejo="<option>baja</option><option selected>media</option><option>alta</option>";
						}else{
							complejo="<option>baja</option><option>media</option><option selected>alta</option>";
						}
					}
					$([
						'<form>',
							'<div class="fieldset col10">',
								'<label>Complejidad</label>',
								'<select name="com_solucion">'+complejo+'</select>',
							'</div>',
							'<div class="fieldset col10">',
								'<label>Descripcion Solucion</label>',
								'<textarea name="descrip_solucion">'+response.solicitud[0].descripcion_solucion+'</textarea>',
							'</div>',
							'<div class="fieldset col10">',
								'<input type="submit" value="Ingresar Solucion">',
								'<input type="hidden" value='+id+' name="id_sol">',
							'</div>',
						'</form>'
					].join('')).ui().modal({
						'width':500, 'title':'Editar Mi Solicitud'
					}).connect({
						'service':'Solicitud',
						'method':'modificarSolicitudUsuario',
						'ok':function(response){
							$('.axyz-fmk-mdl-cvr').close();
							selectMisSolicitudes.value="Todas";
							cargarMisSolicitudes(pagina, cantidad, <?php echo $miid; ?>,selectMisSolicitudes.value );
							//primeraCantidad=true;
							mensaje('Los datos han sido actualizados', "success");
						},
						'fail':function(response){
							mensaje(response, "alert");
						}
					});
				}
			});

		}

		function deleteMiSolicitud(id){
			//console.log("deletemisolicitud", id);
		}



		function filtrarSolicitud(esto){
			pagina=1;
			paginar();
			if(esto.value=="Todas"){
				cargarSolicitudes(pagina, cantidad, "");
			}else{
				cargarSolicitudes(pagina, cantidad, esto.value);
			}
		}

		function filtrarMisSolicitudes(esto){
			pagina=1;
			paginar();
			cargarMisSolicitudes(pagina, cantidad, <?php echo $miid; ?>, esto.value);
			//console.log('filtrarMisSolicitudes', esto.value)
		}

		let cantidadInicial=0, primeraCantidad=true;

		function cantidadSolicitudes(id){
			$.connect({
				'service':'Solicitud',
				'method':'cantidadSolicitudes',
				'data':{'id_usu':id, 'estado':'Asignado'},
				'loader':false,
				'ok':function(response){
					//console.log("cantidad sol asignada", response.cantidad);
					if(primeraCantidad  || cantidadInicial>response.cantidad){
						primeraCantidad=false;
						cantidadInicial=response.cantidad;
					}
					if(cantidadInicial<response.cantidad){

						mensaje("Tiene ("+(response.cantidad-cantidadInicial)+") nuevas solicitudes asignadas!!!  ", "info");
						cantidadInicial=response.cantidad;
						
						cantidadInicial=0;
						primeraCantidad=true;
						$("#btn-misSolicitudes b").addClass("nuevasSolicitudes");

					}
				}
			});
		}
		
		function cerrarAlerta(){
			let div=document.getElementById("popup");
			setTimeout(function(){
				if(div.children[0]!= undefined){
					 div.children[0].remove();

				}
				}, 5000)

		}

		function mensaje(msj, clase){
			//console.log(clase);
			//let div=
			let div="<div class='"+clase+"' style='font-size:14px;margin-bottom:10px;padding:20px; 'onclick='this.remove()'>"+msj+"</div>";
			cerrarAlerta(); 
			$("#popup").append(div);
			/*$("#popup").animate({
    				height: [ "toggle", "swing" ]
				}, 4000, "linear", function(){
					$("#popup").animate({
						height: [ "toggle", "swing" ]
					}, 4000, 'linear', function(){
						console.log("Ghjk");
					});
				});	*/		
			}
		


		function main(){
			cargarMisSolicitudes(pagina, cantidad, <?php echo $miid;?>, selectMisSolicitudes.value);
			cantidadSolicitudes(<?php echo $miid;?>);
			<?php 
				if($tipoPerfil=='usuario'){?>
					cargarSolicitudes(pagina, cantidad, selectSolicitud.value);
			<?php } ?>
			window.setTimeout("main()", 60000);
		}	


	</script>
</head>
<body  style="background-color: #242424;" onload="lahora();main();">
	<div class="container">
		<div class="lateral">
			<button class="btn text-muted" btn="menu-toggle" id="btn-toggle">
				<b class="fa fa-bars"></b>
			</button>
			<?php
				if($tipoPerfil=='usuario'){?>
					<button class="btn text-muted text-active" btn="solicitudes" id="btn-solicitudes">
						<b class="fa fa-bell"></b>
						<div class="texto">Solicitudes</div>
					</button>
			<?php	} ?>
			<button class="btn text-muted" btn="missolicitudes" id="btn-misSolicitudes">
				<b class="fa fa-envelope"></b>
				<div class="texto">Mis Solicitudes</div>
			</button>
			<?php
				if($tipoPerfil=='usuario'){?>
					<button class="btn text-muted" btn="dashboard" id="btn-dashboard">
						<b class="fa fa-chart-line"></b>
						<div class="texto">Dashboard</div>
					</button>

					<button class="btn text-muted" btn="usuarios" id="btn-usuarios">
						<b class="fa fa-users"></b>
						<div class="texto">Usuarios</div>
					</button>

					<button class="btn text-muted" btn="usuariosPrueba" id="btn-usuariosPrueba">
						<b class="fa fa-users"></b>
						<div class="texto">UsuariosPrueba</div>
					</button>
	
					<button class="btn text-muted" btn="productos" id="btn-productos">
						<b class="fab fa-product-hunt" style="font-size: 20px !important;"></b>
						<div class="texto">Productos</div>
					</button>
			<?php	} ?>
			<button class="btn text-muted" btn="configuracion" onclick="window.open('./config.php','_blank');" target="_blank">
				<b class="fa fa-cogs"></b>
				<div class="texto">Soporte Express</div>
			</button>
			<button class="btn text-muted" btn="configuracion" onclick="window.open('./chat.php','_blank');" target="_blank">
				<b class="fa fa-comment"  style="font-size: 20px !important;"></b>
				<div class="texto">Chat</div>
			</button>
			<button class="btn text-muted" btn="perfil" style="position: absolute;bottom: 40px;left: 0;" id="btn-perfil">
				<b class="fa fa-user"></b>
				<div class="texto">Perfil</div>
			</button>
			<button class="btn text-muted" btn="salir" style="position: absolute;bottom: 0;" id="btn-salir">
				<b class="fa fa-sign-out-alt"></b>
				<div class="texto">Salir</div>
			</button>

		</div>
		<div class="panel">
			<div class="barra-superior"></div>
			<div>
				<div></div>
				<?php
					if($tipoPerfil=='usuario'){?>
						<div class="body" id="panel-solicitudes">
							<div style="text-align: center;margin-bottom: 40px;">
								<label style="font-size: 14px;">Estado Solicitud:</label>
								<select onchange="filtrarSolicitud(this)" id="selectSolicitud">
									<option>Todas</option>
									<option>No asignado</option>
									<option>Asignado</option>
									<option>Resuelta</option>
								</select>
							</div>
							<table class="ui-table" id="tsolicitudes">
								<thead>
									<tr>
										<th># Solicitud</th>
										<th>F. Solicitud</th>
										<th>Estado Solicitud</th>
										<th>N. Solicitante</th>
										<th>Email Solicitante</th>
										<th>Producto</th>
										<th>D. Solicitud</th>
										<th>F. Solucion</th>
										<th>N. Responsable</th>
										<th>Complejidad</th>
										<th>D. Solucion</th>
										<th>Editar</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="11">
											
										</td>
										<td colspan="2"><b id="addSolicitud" class="fa fa-plus-circle addBtn"></b></td>
									</tr>
									
								</tfoot>
							</table>
							<div class="paginacion" style="text-align: center;">
								<button onclick="navegar(-1, 'solicitudes')"><b class="fas fa-arrow-left"></b></button>
								<div>1</div>
								<button onclick="navegar(1, 'solicitudes')"><b class="fas fa-arrow-right"></b></button>
							</div>
						</div>
				<?php	} ?>
				<div class="body" id="panel-misSolicitudes">
					<div style="text-align: center;margin-bottom: 40px;">
						<label style="font-size: 14px;">Estado Solicitud:</label>
						<select onchange="filtrarMisSolicitudes(this)" id="selectMisSolicitudes">
							<option>Todas</option>
							<option>Asignado</option>
							<option>Resuelta</option>
						</select>
					</div>
					<table class="ui-table" id="tmissolicitudes">
						<thead>
							<tr>
								<th># Solicitud</th>
								<th>F. Solicitud</th>
								<th>Estado Solicitud</th>
								<th>N. Solicitante</th>
								<th>Email Solicitante</th>
								<th>Producto</th>
								<th>D. Solicitud</th>
								<th>F. Solucion</th>
								<th>N. Responsable</th>
								<th>Complejidad</th>
								<th>D. Solucion</th>
								<th>Editar</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="13">
									
								</td>
							</tr>
							
						</tfoot>
					</table>
					<div class="paginacion" style="text-align: center;">
						<button onclick="navegar(-1, 'missolicitudes')"><b class="fas fa-arrow-left"></b></button>
						<div>1</div>
						<button onclick="navegar(1, 'missolicitudes')"><b class="fas fa-arrow-right"></b></button>
					</div>
				</div>
				<?php
					if($tipoPerfil=='usuario'){?>
						<div class="body" id="panel-dashboard">
							<div id="fecha" style="text-align: center;margin-bottom: 70px;"><input type="date" class="date"><input type="date" class="date"><button class="btn-btn" id="btn-consultar">Consultar</button></div>
							<div class='row' style="margin-bottom: 60px;">
								<!-- grafico de solicitudes por estado-->
								<div id="grafico1" class="col-50" style="height: 400px;"></div>
								<div id="grafico2" class="col-50" style="height: 400px;"></div>
							</div>
							<div class="row" style="margin-bottom: 60px;">
								<div id="grafico3" class="col-50" style="height: 400px;">asd</div>
								<div id="grafico4" class="col-50" style="height: 400px;">asd</div>
							</div>
							<div class="row" style="margin-bottom: 60px;">
								<div id="grafico-xl" style="height: 400px;width: 100%;"></div>
							</div>
							<div class="row" style="margin-bottom: 60px;">
								<div id="grafico-xl2" style="height: 400px;width: 100%;"></div>
							</div>
							
						</div>	
						
				<?php	} ?>
				<?php
					if($tipoPerfil=='usuario'){?>
						<div class="body" id="panel-usuarios">
							<table class="ui-table" id="tusuarios">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>A. Paterno</th>	
										<th>A. Materno</th>	
										<th>Email</th>
										<th>Tipo Usuario</th>
										<th>Editar</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>wef</td>
										<td>fsdf</td>
										<td>sdfsdf</td>
										<td>sdfsdf</td>
										<td>asdfas</td>
										<td><b class="fa fa-pencil-alt editUser"></b></td>
										<td><b class="fa fa-minus-circle deleteUser"></b></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="5"></td>
										<td colspan="2"><b class="fa fa-plus-circle addUser"></b></td>
									</tr>
								</tfoot>
							</table>
						</div>
				<?php	} ?>
							<div class="body" id="panel-usuariosPrueba">
							<table class="ui-table" id="tusuariosPrueba">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>A. Paterno</th>	
										<th>A. Materno</th>	
										<th>Email</th>
										<th>Tipo Usuario</th>
										<th>Contacto</th>
										<th>Editar</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>wef</td>
										<td>fsdf</td>
										<td>sdfsdf</td>
										<td>sdfsdf</td>
										<td>asdfas</td>
										<td>asdfas</td>
										<td><b class="fa fa-pencil-alt editUser"></b></td>
										<td><b class="fa fa-minus-circle deleteUser"></b></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="5"></td>
										<td colspan="2"><b class="fa fa-plus-circle addUserPrueba"></b></td>
									</tr>
								</tfoot>
							</table>
						</div>
				<?php
					if($tipoPerfil=='usuario'){?>
						<div class="body" id="panel-productos">
							<table id="tproductos" class="ui-table">
								<thead>
									<tr>
										<th>Id</th>
										<th>Nombre Producto</th>
										<th>Descripcion</th>
										<th>Editar</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
									<tr>
										<td colspan="4"></td>
										<td><b id="addProducto" class="fa fa-plus-circle addBtn"></b></td>
									</tr>
								</tfoot>
							</table>	

						</div>
				<?php	} ?>

						<div class="body" id="panel-perfil"></div>

			</div>	
		</div>
	</div>

	<div id="popup" style='z-index:1000;position:absolute;padding:10px 10px;color:white;bottom:0;border-radius: 4px;right:50px;'>
	</div>
</body>
</html>