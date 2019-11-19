<?php

/*
Creado el : 10-11-2018
Creado por: Omega

Controlador que recibe las peticiones del usuario y ejecuta las acciones correspondientes sobre el modelo de datos SUBASTA_Model y las vistas.
*/

session_start();

include '../Models/USUARIO_Model.php';
include_once '../Models/SUBASTA_Model.php';
new PPromocionado_Model('','','','','','','','');
include '../Views/PPromocionado/PPromocionadoADD_View.php';
include '../Views/PPromocionado/PPromocionadoDELETE_View.php';
include '../Views/PPromocionado/PPromocionadoEDIT_View.php';
include '../Views/PPromocionado/PPromocionadoSEARCH_View.php';
include '../Views/PPromocionado/PPromocionadoSHOWALL_View.php';
include '../Views/PPromocionado/PPromocionadoSHOWCURRENT_View.php';
include '../Views/MESSAGE.php';




/* Funcion para coger los datos de los formularios*/
function get_data_form(){
	$action = $_REQUEST['action']; //coge el valor del action
 
	/** ID QUE IDENTIFICA LA SUBASTA **/
	if(isset($_REQUEST['idPartidoPromocionado'])){
		$idPartidoPromocionado = $_REQUEST['idPartidoPromocionado'];
	}else{
		if($_REQUEST['action'] == 'ADD'){	$id_subasta = 0; }//si viene del formulario de add
		else{ $id_subasta = NULL; }
	}

	/** LOGIN DEL SUBASTADOR QUE CREA LA SUBASTA **/
	if (isset($_REQUEST['nombre'])) { //si existe login
		$nombre = $_REQUEST['nombre']; 
	}
	else{
		$nombre = NULL;
	}

	/** NOMBRE DEL ARTICULO SUBASTADO **/
	if(isset($_REQUEST['fecha'])){ //si el nombre existe
		$fecha = $_REQUEST['fecha'];	} //la variable nombre guarda el valor que tiene en el formulario
	else{ //si el nombre no existe
		$fecha = NULL; //se inicializa la variable nombre a NULL
	}

	/** DESCRIPCION DEL ARTÍCULO**/
	if(isset($_POST['idParticipante1'])){
		$idParticipante1 = $_POST['idParticipante1']; 
	}else{
		$idParticipante1 = NULL;
	}


	/** FECHA INICIO SUBASTA **/
	if(isset($_REQUEST['idParticipante2'])){
		$idParticipante2 = $_REQUEST['idParticipante2']; 
	}else{
		$idParticipante2 = NULL;
	}

	/** FECHA FIN SUBASTA **/
	if(isset($_REQUEST['idParticipante3'])){
		$idParticipante3 = $_REQUEST['idParticipante3']; 
	}else{
		$idParticipante3 = NULL;
	}
	/** IMPORTE INICIAL DE LA SUBASTA **/
	if(isset($_REQUEST['idParticipante4'])){ //si importe_inicial existee
		$idParticipante4 = $_REQUEST['idParticipante4'];	} //la variable importe_inicial guarda el valor que tiene en el formulario
	else{ //si importe_inicial no existe
		$idParticipante4 = NULL;
    }
    
    if(isset($_REQUEST['numParticipantes'])){ //si importe_inicial existee
		$numParticipantes = $_REQUEST['numParticipantes'];	} //la variable importe_inicial guarda el valor que tiene en el formulario
	else{ //si importe_inicial no existe
		$numParticipantes = NULL;
	}


	$PPromocionado = new PPromocionado_Model( 

		$idPartidoPromocionado,
		$nombre,
		$fecha,
		$idParticipante1,
		$idParticipante2,
		$idParticipante3,
		$idParticipante4,
        $numParticipantes);


	return $PPromocionado;
}

	if(isset($_REQUEST['action'])){
		$action = $_REQUEST['action'];
	}
	else{
		$action = " ";
	}

	switch($action){
		case 'ADD': 
            if (!$_POST){ //si viene del showall (no es un post)
				$PPromocionado = new PPromocionado_Model('','','','','','','','');
				$form = new PPromocionado($PPromocionado); //Crea la vista ADD y muestra formulario para rellenar por la subasta
			}
			break;

		case 'DELETE':
			if (!$_POST){ //si viene del showall (no es un post)
				if(isset($_REQUEST['idPartidoPromocionado'])){
					$PPromocionado = new PPromocionado_Model($_REQUEST['idPartidoPromocionado'],'','','','','','','');
					$datos = $PPromocionado->RellenaDatos();
					new PPromocionado_DELETE($datos); //Crea la vista DELETE
				}else{
					header('Location: ../Controllers/PPromocionado_Controller.php');
				}
			}
			else{ //si viene del delete 
				
				if($_SESSION['rol'] == 'ADMIN'){
					$PPromocionado = get_data_form_admin();
					$retorno = $PPromocionado->DELETE();
					header('Location: ../Controllers/MESSAGE_Controller.php?mensaje='.$mensaje.'&origen=../Controllers/PPromocionado_Controller.php'); 
				}
				if($_SESSION['rol'] == 'DEPORTISTA'){
					$PPromocionado = get_data_form();
					$retorno = $PPromocionado->DELETE();
					header('Location: ../Controllers/MESSAGE_Controller.php?mensaje='.$mensaje.'&origen=../Controllers/PPromocionado_Controller.php'); 
				}
			}
			break;

		case 'EDIT':
			if(!$_POST){
				if(isset($_REQUEST['id_subasta'])){
					$PPromocionado = new PPromocionado_Model($_REQUEST['id_subasta'],'','','','','','','');
					$datos = $PPromocionado->RellenaDatos();
					
					new PPromocionado_EDIT($datos);
				}
				else{
					header('Location: ../Controllers/SUBASTA_Controller.php');
				}
			}
			else{
				
				if($_SESSION['rol'] == 'ADMIN'){
					$PPromocionado = get_data_form();
					$retorno = $PPromocionado->EDIT();
					if( (isset($retorno['idPartidoPromocionado'])) && (isset($retorno['mensaje']))){
						$mensaje = $retorno['mensaje'];

					}
					header('Location: ../Controllers/MESSAGE_Controller.php?mensaje='.$mensaje.'&origen=../Controllers/PPromocionado_Controller.php');
				}
				if($_SESSION['rol'] == 'DEPORTISTA'){
					$PPromocionado = get_data_form();
					$retorno = $PPromocionado->EDIT();
					if( (isset($retorno['id_subasta'])) && (isset($retorno['mensaje']))){
						$mensaje = $retorno['mensaje'];

					}
					header('Location: ../Controllers/MESSAGE_Controller.php?mensaje='.$mensaje.'&origen=../Controllers/PPromocionado_Controller.php');
				}
			}
			break;

		case 'SEARCH': //caso para realizar busquedas
			if(!$_POST){
				$PPromocionado = new  PPromocionado_Model('','','','','','','','');
				
				$datos = $PPromocionado->SHOWALL();

				$form = new PPromocionado_SEARCH($datos); //crea la vista del formulario de busqueda
			}
			else{
				
				if($_SESSION['rol'] == 'ADMIN'){
					$PPromocionado = get_data_form_admin();
					$datos_sub = $PPromocionado->SEARCH();
					$lista = array('id_subasta','login_sub','nombre_art','img_art','descrip_art','fecha_inicio','fecha_fin','tipo_subasta','importe_inicial','autorizada','usuario_autoriza','fecha_autorizacion','doc_subasta','subasta_borrada');
					$resultado = new SUBASTA_SHOWALL($lista, $datos_sub, $datos_doc);//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
				}

				if($_SESSION['rol'] == 'DEPORTISTA'){
					$PPromocionado = get_data_form();
					$datos = $PPromocionado->SEARCH_DEPORTISTA();
					$lista = array('idPartidoPromocionado','nombre','fecha','idParticipante1','idParticipante2','idParticipante3','idParticipante4','numParticipantes');
					$resultado = new SUBASTA_SHOWALL($lista, $datos);//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
				}

				if( ($_SESSION['rol'] <> 'ADMIN') && ($_SESSION['rol'] <> 'DEPORTISTA') ){
					$PPromocionado = get_data_form();
					$datos = $PPromocionado->SEARCH_DEPORTISTA();
					$lista = array('idPartidoPromocionado','nombre','fecha','idParticipante1','idParticipante2','idParticipante3','idParticipante4','numParticipantes');
					$resultado = new SUBASTA_SHOWALL($lista, $datos);//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
				}

			}
			break;
		
		case 'SHOWCURRENT': //para ver una participacion en detalle
			if(isset($_REQUEST['id_subasta'])){
				$PPromocionado = new PPromocionado_Model($_REQUEST['id_subasta'],'','','','','','','');
				$datos = $PPromocionado->RellenaDatos_PPromocionado();
				new PPromocionado_SHOWCURRENT($datos); 
				
			}
			break;
		
		break;
		default:
			$PPromocionado = new PPromocionado_Model('','','','','','','','');
			if($_SESSION['rol'] == 'ADMIN'){
				$datos = $PPromocionado->SHOWALL();
			}
			if ($_SESSION['rol'] == 'DEPORTISTA'){
				$datos = $PPromocionado->SHOWALL_SUB();
			}
			$lista = array('idPartidoPromocionado','nombre','fecha','idParticipante1','idParticipante2','idParticipante3','idParticipante4','numParticipantes');
			$resultado = new PPromocionado_SHOWALL($lista, $datos);
	}
?>