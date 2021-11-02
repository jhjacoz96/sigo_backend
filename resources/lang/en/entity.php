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
        'action-edit' => "Organization Edit",
        'action-add' => "Organization Create",
        'action-reset' => "Organization Data Reset",
        'module-active' => "Active module",
        'toolbox-active' => "Active toolbox",
        'user_created_success' => 'User created successefully',
        'user_updated_success' => 'User uppdated successefully',
        'user_deleted_success' => 'User deleted successefully',
        'reset_data_success' => 'Reset data successefully',
        'reset_data_error' => 'An error has occurred resetting the organization data',
        'users_permissions_updated_success' => 'Permissions user uppdated successefully',
        'question-reset' => "Are you sure of resetting the organization's data?",
        'field' => [
            'name' => 'Name / Organization',
            'country' => 'Country',
            'code' => 'Code',
            'rut_rif_id' => 'Identification',
            'status' => 'Status',
            'max_user_toolbox' => 'Max. users for toolbox',
            'max_user_sieni' => 'Max. users for sieni',
            'address' => 'Address',
            'organization_type' => 'Organization Type',
            'logo' => 'Logo',
            'reset_frequency' => 'Reset Frequency'
        ]
    ],
    'proceso' => [
        'created_success' => 'Process created success',
        'updated_success' => 'Process updated success',
        'deleted_success' => 'Process deleted success',
        'imported_success' => 'File imported success',
        'exported_success' => 'File exported success',
        'deleted_failed_requisito' => 'Process removal has failed, has associated requirements',
    ],
    'evaluacion' => [
        'created_success' => 'Evaluation created success',
        'updated_success' => 'Evaluation updated success',
        'deleted_success' => 'Evaluation deleted success',
        'reseted_success' => 'Evaluation reseted success',
        'reseted_failed' => 'Evaluation reseted failed, it`s not education organization',
        'reseted_failed_frequency' => 'Evaluation reset failed, must indicate reset frequency'
    ],
    'menu_sieni' => [
        'capitulo' => 'Chap.',
        'apartado' => 'Parag.',
        'item' => 'Item',
    ],
    'modulo' => [
        'versions' => 'Versions',
        'version' => 'Version',
        'active' => 'Active',
        'title_menu' => 'MODULES'
    ],
    'toolbox' => [
        'permissions_users_exists' => 'The permission :permiso cannot be deleted, it is assigned to users of the organization.'

    ],
    'subversion-modulo' => [
        'title' => 'Module Subversion',
        'error_import' => 'Import file has failed'
    ],
    'capitulo' => [
        'version_modulo' => 'Module Version',
        'subversion_modulo' => 'Subversion',
    ],
    'apartado' => [
        'capitulo' => 'Chapter'
    ],
    'item' => [
        'apartado' => 'Paragraph'
    ],
    'requisito' => [
        'item' => 'Items'
    ],
    'sistemas-educativos' => [
        'title' => 'Education Systems',
    ],
    'bitacora' => [
        'event' => 'This entity has been :event',
        'created' => 'created',
        'updated' => 'updated',
        'deleted' => 'deleted',
        'old_values' => 'Old values',
        'new_values' => 'New values',
        'field' => 'Field',
        'subject_description' => 'Entity/Module',
        'subject_description_e' => 'Changed entity',
        'subject_description_m' => 'Changed module',
        'organization' => 'Organization',
        'changes' => 'Changes',
        'causer_description' => 'Associate user',
        'causer_name' => 'Name user',
        'login_success' => 'Login Successefully'
    ],
    'no-conformidad' => [
        'actividad_no_responsable'=> 'The activity has no resonsable assigned',
        'prelacion_aplicabilidad' => 'This requirement does not apply because the requirement :nro_req on which it depends is also not applicable' ,
        'prelacion_conformidad'=> 'This requirement is non-compliant because the requirement :nro_req on which it depends is also non-conforming'
    ],
    'recurso'=>[
        'error_folder_deleted'=>'The folder cannot be deleted, it is not empty'
    ],
    'permiso'=>[
        'authorized_failed_permission'=>'Unauthorized access',
        'authorized_permission'=> 'authorized access'
    ],
    'carpeta'=>[
        'folder_contains_items'=>'Cannot delete folder as it contains documents inside ',
     ]

];
