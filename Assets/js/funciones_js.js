/*$('#num_emp').keyup(function(){

	let id = $('#num_emp').val();

	$.ajax({
		url:'./Model/Emp_Consulta.php',
		type: 'POST',
		data: {id},
		success: function(response){
			let string = JSON.parse(response);
			let plantilla = ' ';

			string.forEach(emple =>{
				plantilla +='<li>${emple.nombre}</li>'           
			});
			//$('#empleado').html(plantilla);
			document.getElementById("empleado").value = plantilla;
			console.log(plantilla);
		}

	})


});*/


$(document).on('keyup', '#num_emp', function() {
  
		let id = $('#num_emp').val();

	$.ajax({
		url:'./Model/Emp_Consulta.php',
		type: 'POST',
		data: {id},
		success: function(response){
			let string = JSON.parse(response);
			let plantilla = ' ';

			string.forEach(emple =>{
				plantilla +='<li>${emple.nombre}</li>'           
			});
			//$('#empleado').html(plantilla);
			document.getElementById("empleado").value = plantilla;
			console.log(plantilla);
		}

	})
});
