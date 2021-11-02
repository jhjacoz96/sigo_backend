<?php

return [

/*
|--------------------------------------------------------------------------
| Organizacion opciones de idioma
|--------------------------------------------------------------------------
|
| Todas las traducciones de los mensajes utilizados en el
| controlador de organizacion
|
*/


    'organizacion' => [
        'action-edit' => "Gestión de Organizaciones",
        'action-add' => "Creación de Organizaciones",
        'action-reset' => "Restablecer Datos de Organizacion Educativa",
        'module-active' => "Módulos activos",
        'toolbox-active' => "Herramientas activas",
        'user_created_success' => 'Usuario creado satisfactoriamente',
        'user_updated_success' => 'Usuario modificado satisfactoriamente',
        'user_deleted_success' => 'Usuario eliminado satisfactoriamente',
        'reset_data_success' => 'Se han restablecido los datos satisfactoriamente',
        'reset_data_error' => 'Ha ocurrido un error restableciendo los datos de la organización',
        'users_permissions_updated_success' => 'Permisos de usuario actualizados satisfactoriamente',
        'question-reset' => "¿Está usted seguro que desea restablecer los datos de esta organización?",
        'field' => [
            'name' => 'Nombre / Organización',
            'country' => 'País',
            'code' => 'Código',
            'rut_rif_id' => 'Identificación',
            'status' => 'Estado',
            'max_user_toolbox' => 'Límite de usuarios de herramientas',
            'max_user_sieni' => 'Límite de usuarios de SIENI',
            'address' => 'Dirección',
            'organization_type' => 'Tipo de Organización',
            'logo' => 'Logo',
            'reset_frequency' => 'Frecuencia de Reinicio (días)',

        ]
    ],
    'proceso' => [
        'created_success' => 'Proceso creado satisfactoriamente',
        'updated_success' => 'Proceso modificado satisfactoriamente',
        'deleted_success' => 'Proceso eliminado satisfactoriamente',
        'imported_success' => 'Archivo importado satisfactoriamente',
        'exported_success' => 'Archivo exportado satisfactoriamente',
        'deleted_failed_requisito' => 'Eliminación de procesos ha fallado, tiene requisitos asociados',
    ],
     'evaluacion' => [
        'created_success' => 'Evaluación creado satisfactoriamente',
        'updated_success' => 'Evaluación modificado satisfactoriamente',
        'deleted_success' => 'Evaluación eliminado satisfactoriamente',
        'reseted_success' => 'Evaluaciones reseteadas satisfactoriamente',
        'reseted_failed' => 'Reseteo de evaluación ha fallado, ésta organización no es educativa',
        'reseted_failed_frequency' => 'Reseteo de evaluación ha fallado, debe indicar frecuencia de reinicio',

    ],
    'menu_sieni' => [
        'capitulo' => 'Cap.',
        'apartado' => 'Apart.',
        'item' => 'Item',
    ],
    'modulo' => [
        'versions' => 'Versiones',
        'version' => 'Versión',
        'active' => 'Activo',
        'title_menu' => 'MÓDULOS'
    ],
    'toolbox' => [
        'permissions_users_exists' => 'No se puede actualizar los permisos en el toolbox. Los siguientes permisos: :permiso, estan asignados a usuarios de las organizaciones.'
    ],
    'subversion-modulo' => [
        'title' => 'Subversión de Módulos',
        'error_import' => 'Se detectaron errores durante la carga del archivo.'
    ],
    'capitulo' => [
        'version_modulo' => 'Versión del Módulo',
        'subversion_modulo' => 'Subversión',
    ],
    'apartado' => [
        'capitulo' => 'Capítulos'
    ],
    'item' => [
        'apartado' => 'Apartados'
    ],
    'requisito' => [
        'item' => 'Items'
    ],
    'sistemas-educativos' => [
        'title' => 'Organizaciones con Convenios Educativos',
    ],
    'bitacora' => [
        'event' => 'Esta entidad ha sido :event',
        'created' => 'creada',
        'updated' => 'modificada',
        'deleted' => 'borrada',
        'old_values' => 'Valor anterior',
        'new_values' => 'Valor nuevo',
        'field' => 'Campo',
        'subject_description' => 'Entidad/Módulo',
        'subject_description_e' => 'Entidad afectada',
        'subject_description_m' => 'Módulo afectado',
        'organization' => 'Organización',
        'changes' => 'Cambios',
        'causer_description' => 'Usuario asociado',
        'causer_name' => 'Nombre de usuario',
        'login_success' => 'Inicio de sesión satisfactorio'
    ],
    'no-conformidad'=>[
        'actividad_no_responsable'=>'La actividad no tiene resonsable asignado',
        'prelacion_aplicabilidad' => 'Este requisito no aplica debido a que depende del requisito :nro_req, el cual fue evaluado "No aplica"',
        'prelacion_conformidad' => 'Este requisito es no conforme debido a que el requisito :nro_req, del cual depende, es no conforme',
    ],
    'permiso'=>[
        'authorized_failed_permission'=>'Acceso no autorizado',
        'authorized_permission'=> 'Acceso autorizado'
    ],

    'carpeta'=>[
        'folder_contains_items'=>'No se puede eliminar la carpeta ya que  contiene documentos en su interior ',
     ]
];
