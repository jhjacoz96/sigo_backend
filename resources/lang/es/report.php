<?php

return [

	'ham' => [
		'matrix' => [
			'title' => 'Matriz de riesgo',
			'danger' => 'peligro',
			'risk_assessment' => 'Evaluación del riesgo',
			'level' => 'nivel',
			'legend' => [
				'legend' => 'Leyenda',
				'low' => 'Bajo',
				'medium' => 'Medio',
				'tall' => 'Alto',
				'very_high' => 'Muy Alto'
			],
			'probability' => [
				'probability' => 'probabilidad',
				'rare' => '1. Raro',
				'unlikely' => '2. Improbable',
				'possible' => '3. Posible',
				'Probable' => '4. Probable',
				'Almost_sure' => '5. Casi seguro'
			],
			'consequence' => [
				'consequence' => 'consecuencia',
				'sub' => 'CONSECUENCIA',
				'insignificant' => '1. Insignificante',
				'less' => '2. Menor',
				'moderate' => '3. Moderado',
				'higher' => '4. Mayor',
				'catastrophic' => '5. Catastrófico'
			]
		],
		'rain' => [
			'brainstorming' => 'LLuvia de ideas/ cuadrícula de selección',
			'title' => 'LLuvia de ideas'
		],
		'dao'=>[
			'title'=> 'Análisis DAFO',
			'strengths'=>'FORTALEZAS',
			'Weaknesses'=>'DEBILIDADES',
			'Opportunities'=>'OPORTUNIDADES',
			'Threats'=>'AMENAZAS',
			'INTERNAL'=>'INTERNAS',
			'swot_strategies'=>'Estrategias DAFO',
			'STRATEGY_F_O' =>'ESTRATEGIA F-O',			
			'STRATEGY_D_O'=>'ESTRATEGIA D-O',
			'STRATEGY_F_A'=>'ESTRATEGIA F-A',
			'STRATEGY_D_A'=>'ESTRATEGIA D-A',
			'SWOT_STRATEGIES' =>'ESTRATEGIAS DAFO'
		]

	],
	'pda' => [
		'title-head' => 'Informe de plan de acción',
		'title' => 'Plan de acción',
		'definition-of-problem' => [
			'title' => 'Definición del problema/integrantes',
			'field-situation_treated' => 'Situación a tratar',
			'field-objective' => 'Objetivo',
			'field-lider' => 'Líder (s)',
			'field-invited' => 'Invitado (s)',
		],
		'analysis_method'  => [
			'title' => 'Análisis',
			'ishikawa' => "Diagrama de ishikawa",
			'5why' => "Análisis de los 5 porque",
			'pareto' => "Pareto",
			'other' => "Otros métodos",
			'brainstorming' => 'Lluvia de ideas',
			'cause_resume' => "Resumen de causas seleccionadas",
		],
		'label' => [
			'title' => 'Título',
			'why' => '¿Por qué?',
			'root_cause' => 'Causa raíz',
			'nro' => 'Nro.',
			'identified_cause' => 'Causa identificada',
			'magnitude' => 'Magnitud medida',
			'method' => 'Método',
			'evidences' => 'Evidencias',
			'action' => 'Acciones Ejecutadas',
			'description' => 'Descripción',
			'deadline' => 'Fecha límite',
			'actual_date' => 'Fecha real',
			'responsible_of' => 'Responsable de ',
			'causes' => 'Causas',
			'total' => 'Total',
			'selection' => 'Selección'
		],
		'action' => [
			'title' => 'Acciones',
			'nro' => 'Nro.',
			'task' => 'Tarea',
			'responsible' => 'Responsable',
			'date_plan' => 'Fecha plan',
			'stage' => 'Etapa',
			'state' => 'Estado'
		],
		'statistics' => [
			'title-pda_general' => 'Estadísticas del plan de acción',
			'title-pda_responsable' => 'Estadísticas del plan de acción por participante',
			'stage' => [
				'title' => 'Etapa',
				'not_treated' => 'No tratado',
				'notified' => 'Notificado',
				'planned' => 'Planificado',
				'in_action' => 'En ejecución',
				'executed' => 'Ejecutado',
				'validated' => 'Validado'
			],
			'status' => [
				'title' => 'Estado',
				'Active' => 'Activo',
				'on_date' => 'En fecha',
				'in_no_date' => 'No en fecha',
				'history' => 'En historico'
			],

		],
		'resource-summary' => [
			'title' => 'Resumen de recursos',
			'task' => 'TAREA',
			'materials' => 'Materiales',
			'service' => 'Servicios',
			'cost' => 'Costos',
			'materials-alt' => 'MATERIALES',
			'service-alt' => 'SERVICIOS',
			'costo-alt' => 'COSTOS',
			'total' => 'TOTAL'
		]
	],
	'sieni' => [
		'title' => 'Informe de Evaluación',
		'col' => [
			'requirement' => 'Requisito',
			'evidence' => 'Evidencia',
			'note' => 'Observación',
			'oportunity' => 'Oportunidad de Mejora',
			'non-conformity' => 'No Conformidad',
			'dep' => 'Dep.',
			'eval' => 'Eval.',
			'classification' => 'Clasificación',
			'date_inconsistency' => 'Fecha de Incidencia'
		],
		'field-code' => 'Código',
		'info-doc' => [
			'title_preserve' => 'Requisitos: Conservar información documentada',
			'body_preserve' => 'A continuación se presentan los requisitos asociados a Conservar información documentada durante la evaluación concluida el día',
			'title_maintain' => 'Requisitos: Mantener información documentada',
			'body_maintain' => 'A continuación se presentan los requisitos asociados a Mantener información documentada durante la evaluación concluida el día',
		],
		'process' => [
			'process' => 'Proceso',
			'compliance-weight' => 'Cumplimiento ponderado',
			'effectiveness' => 'Efectividad',
			'evaluated' => 'Requisitos evaluados',
			'compliance' => 'Requisitos conformes',
			'non-conformity' => 'Requisitos no conformes'
		],
		'global-result' => [
			'structure' => 'Estructura evaluada',
			'goal' => 'Meta',
			'result' => 'Resultado',
			'conformity' => 'Conformidad'
		],
		'result' => [
			'organization' => 'Organización',
			'module' => 'Módulo',
			'date' => 'Fecha',
			'result-global' => 'Resultado Global',
			'conformable' => 'Conformidades',
			'notes' => 'Observaciones',
			'oportunity' => 'Oportunidad de mejora',
			'non-conformity' => 'No conformidades',
			'takers' => 'Tomador (es)',
			'sources' => 'Unidades Informantes',
		],
		'signs' => [
			'takers' => 'Firma (s) tomador (es)',
			'sources' => 'Firma (s) unidad (es) informante (s)',
		]

	],
	'nc' => [
		'title_rp_p' => 'Responsables y Plazos',
		'title' => "Gestor de No Conformidades",
		'title_treatment' => 'Tratamiento de no Conformidad',
		'title_nc' => 'Registro de no conformidad',
		'field-code' => 'No Conformidad: Código',
		'field-date_issue' => 'Fecha',
		'field-company_name' => 'Organización',
		'field-created_by' => 'Creado por',
		'field-title' => 'NC',
		'status' => [
			'register' => 'Registro',
			'validation' => 'Validación',
			'analisys' => 'Análisis',
			'action-plan' => 'Plan de acción',
			'verification' => 'Verificación',
			'execution' => 'Ejecución',
			'effectiveness' => 'Eficacia',
			'approval' => 'Aprobación',
		],
		'label' => [
			'title' => 'Título',
			'why' => '¿Por qué?',
			'root_cause' => 'Causa raíz',
			'nro' => 'Nro.',
			'identified_cause' => 'Causa identificada',
			'magnitude' => 'Magnitud medida',
			'method' => 'Método',
			'evidences' => 'Evidencias',
			'nc' => 'No conformidad',
			'action' => 'Acciones Ejecutadas',
			'description' => 'Descripción',
			'deadline' => 'Fecha límite',
			'actual_date' => 'Fecha real',
			'responsible_of' => 'Responsable de '
		],
		'section'  => [
			'action-plan-execution' => "Plan de acción",
			'action-plan' => "Plan de acción",
			'effectiveness' => "Eficacia",
			'ishikawa' => "Diagrama de Ishikawa",
			'5why' => "Análisis de los 5 porque",
			'pareto' => "Pareto",
			'other' => "Otros métodos",
			'cause_resume' => "Resumen de causas seleccionadas",
		],
		'action-plan' => [
			'title' => "Plan de acción",
			'what' => '¿Qué se planificó hacer?',
			'how' => '¿Cómo se planificó hacer?',
			'when' => '¿Cúando se planificó hacer?',
			'where' => '¿Dónde se planificó hacer? / ¿Dónde aplicaba?',
			'resource' => '¿Qué recursos se necesitaban?',
			'who-execute' => '¿Quiénes ejecutaron?',
			'who-valid' => '¿Quiénes evaluaron?',
			'comply' => '¿Se cumplió el plan?',
			'yes' => 'Sí',
			'no' => 'No',
			'comment' => 'Comentarios',
			'effectiveness' => "¿Las acciones ejecutadas fueron eficaces?",
			'evidence' => "Evidencias",
			'causes' => "Causas asociadas a la acción"
		],
		'ejecucion-plan' => [
			'title' => "Ejecucion del plan de acción",
			'title_section' => "Ejecucion",
			'how' => '¿Cómo se va a hacer?',
			'when' => '¿Cúando se va a  hacer?',
			'where' => '¿Dónde se va a  hacer?',
			'resource' => '¿Qué recursos se necesitan?',
			'who-execute' => '¿Quién ejecuta?',
			'who-valid' => '¿Quien valida?',
			'comply' => '¿Se cumplió el plan?',
			'yes' => 'Sí',
			'no' => 'No',
			'comment' => 'Comentarios',
			'effectiveness' => "¿Se ejecutó la acción planificada?",
			'evidence' => "Evidencias",
			'causes' => "Causas a atender en esta acción"
		]



	],
	'gd' => [
		'title' => 'Gestor de Información Documentada',
		'date' => 'Fecha',
		'resource' => [
			'title' => 'Documento',
			'created_by' => 'Elaborado por',
			'section' => [
				'summary_state' => 'Informe de Documentos por Estados',
				'graphic' => 'Resumen de Documentos',
				'list' => 'Listado de Documentos',
			],
			'list' => [
				'col-name' => 'Nombre',
				'col-path' => 'Ubicación',
				'col-status' => 'Estado',
				'col-approval' => 'Aprobador',
				'col-review' => 'Fecha revisión',
				'col-link' => 'Enlace',
			],
			'status' => [
				'valid' => 'Vigente',
				'to-expire' => 'Por Vencer',
				'expire' => 'No Vigente'
			]
		],
		'process' => [
			'title' => 'Caracterización de los procesos',
			'section' => [
				'process-maps' => 'Mapa de procesos',
				'characters' => 'Caracterización de los procesos',
				'document-information' => 'Información documentada'
			],
			'process-maps' => [
				'process' => 'Procesos',
				'process-maps' => 'Mapa de procesos',
				'process-strategy' => 'Procesos estratégicos',
				'process-support' => 'Procesos de apoyo',
				'source-in' => 'Fuentes de entrada',
				'process-in' => 'Entradas del proceso',
				'process-box' => 'PROCESO',
				'process-out' => 'Salidas del proceso',
				'receiver-out' => 'Receptores de salida',

			],
			'characters' => [
				'process' => 'Proceso',
				'process-name' => 'Nombre del proceso',
				'document' => 'Documento',
				'owner' => 'Dueño del proceso',
				'version' => 'Versión',
				'objective' => 'Objetivo',
				'last-updated' => 'Última modificación',
				'scope' => 'Alcance',
				'status' => 'Estado',
				'status-active' => 'Activo',
				'status-inactive' => 'Inctivo',
			],
			'document-information' => [
				'view' => 'Ver'
			],
			'public-statement' => 'GID Informe de Declaración Publica'

		]
	],
	'organization' => 'Organización',
	'copyright' => 'Derechos Reservados',
	'page' => 'Página'

];
